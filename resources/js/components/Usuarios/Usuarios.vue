<template>
	<!-- Begin Page Content -->
	<div class="usuarios">
		<!-- Page Heading -->
		<!-- <h1 class="h3 mb-0 text-gray-800">Tabla de usuarios</h1> -->
		<!-- <button class="btn btn-primary" @click="loadUsuarios">Load User</button> -->
		<!-- DataTales Example -->
		<div class="card shadow mb-4">
			<div class="card-header py-3">
				<div class="row d-flex justify-content-between">
					<h6 class="m-2 font-weight-bold text-primary">Lista de usuarios</h6>
					<a
						v-if="$auth.can('create.users')"
						@click="add"
						class="d-sm-inline-block btn btn-md btn-success shadow-sm"
					>
						<span class="icon text-white-50">
							<i class="fas fa-plus fa-sm text-white-50"></i>
						</span>
						<span class="text">Agregar</span>
					</a>
				</div>
			</div>
			<div class="card-body">
				<div class="table-responsive-sm" v-if="status === 1">
					<table
						class="table table-hover"
						id="dataTable"
						width="100%"
						cellspacing="0"
					>
						<thead>
							<tr>
								<th>Id</th>
								<th>Identificacion</th>
								<th>Name</th>
								<th>Email</th>
								<th>created_at</th>
								<th>Verificado</th>
								<th class="text-center">Rol</th>
								<th class="text-center">Acción</th>
							</tr>
						</thead>
						<!-- <tfoot>
							<tr>
								<th>Id</th>
								<th>Identificacion</th>
								<th>Name</th>
								<th>Email</th>
								<th>created_at</th>
								<th>Verificado</th>
								<th class="text-center">Rol</th>
								<th class="text-center">Acción</th>
							</tr>
						</tfoot> -->
						<tbody>
							<tr v-for="usuario in usuarios" :key="usuario.id">
								<td scope="row">{{ usuario.id }}</td>
								<td>{{ usuario.DNI }}</td>
								<td>{{ usuario.first_name }} {{ usuario.last_name }}</td>
								<td>
									{{ usuario.email }}
								</td>
								<td>{{ fecha(usuario.created_at) }}</td>
								<td class="text-center">
									<span
										v-if="usuario.email_verified_at !== null"
										class="badge badge-pill badge-success shadow-sm"
										title="Email verificado"
										>Verificado<i class="fa fa-check"></i>
									</span>
									<span
										v-else
										title="Este email aun no ha sido verificado"
										class="badge badge-pill badge-danger shadow-sm"
										>Sin Verificar
										<i class="fa fa-exclamation-circle"></i>
									</span>
								</td>
								<td>
									<span
										class="badge badge-pill badge-primary shadow-sm"
										v-for="role in usuario.roles"
										:key="role.id"
										>{{ role.name }}
									</span>
								</td>
								<td class="text-center">
									<div class="btn-group" v-if="usuario.id != 1">
										<a href="#" class="btn btn-secondary btn-sm shadow-sm">
											<i class="fas fa-inbox"></i>
										</a>
										<a
											v-if="$auth.can('edit.users')"
											class="btn btn-info btn-sm shadow-sm"
											@click="edit(usuario)"
										>
											<i class="fas fa-pencil-alt"></i>
										</a>
										<a
											v-if="$auth.can('delete.users')"
											class="btn btn-danger btn-sm shadow-sm"
											@click="confirmDelete(usuario.id, usuario)"
										>
											<i class="fas fa-trash"></i>
										</a>
									</div>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
		<modal-component
			:userEdit="user"
			:mode="mode"
			v-if="showModal"
			@close="modal"
			@actualizar="loadUsuarios"
		></modal-component>
	</div>
	<!-- /.container-fluid -->
</template>

<script>
import $ from "jquery";
import dt from "datatables.net-bs4";
import Swal from 'sweetalert2';
import toastr from 'toastr';

import ModalComponent from "./ModalComponent.vue";

export default {
	name: "Usuarios",

	data() {
		return {
			usuarios: [],
			status: 0,
			showModal: false,
			user: [],
			mode: "",
		};
	},
	components: {
		ModalComponent,
	},

	methods: {
		modal() {
			this.showModal = false;
		},

		async loadUsuarios() {
			this.$emit("load", true);
			this.status = 0;
			this.usuarios = [];
			try {
				let response = await axios.get("/api/user");
				this.usuarios = response.data.data;
				if (this.usuarios != null) {
					$('#dataTable').DataTable().clear().destroy();
					this.loadTabla();
				}
			} catch (error) {
				console.log(error);
			}
		},

		loadTabla() {
			this.status = 1;

			this.$nextTick(() => {
				$('#dataTable').DataTable({
					"dom": "<'row '<'col-sm-12 col-md-6 inline'f><'col-sm-12 col-md-6 text-right'l>>" +
						"<'row'<'col-sm-12'rt>>" +
						"<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7 d-flex flex-row-reverse'p>>",
				});
			});
			this.$emit("load", false);
		},

		add() {
			this.user = [];
			this.mode = "create";
			this.showModal = true;
		},

		edit(user) {
			this.user = user;
			this.mode = "edit";
			this.showModal = true;
		},

		confirmDelete(id, usuario) {
			var title = "Esta seguro de eliminar el usuario: " + usuario.first_name + "?"
			Swal.fire({
				title: title,
				text: "No podrás revertir estos cambios",
				icon: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'Si, eliminar'
			}).then((result) => {
				if (result.isConfirmed) {
					this.eliminar(id);
				}
			})
		},

		async eliminar(id) {
			try {
				let response = await axios.delete("/api/user/" + id);
				var success = response.data.success;
				var message = response.data.message;
				if (success == true) {
					// await Swal.fire(
					// 	'Deleted!',
					// 	message,
					// 	'success'
					// );
					toastr.success(message);
					this.loadUsuarios();
				} else {
					// Swal.fire(
					// 	'Error!',
					// 	message,
					// 	'error'
					// );
					toastr.error(message);
				}
			} catch (error) {
				console.log(error);
			}
		},

		fecha(date) {
			var fecha = new Date(date);
			var options = {
				weekday: "long",
				year: "numeric",
				month: "long",
				day: "numeric",
			};
			return fecha.toLocaleDateString("es-ES", options);
		},
	},

	mounted() {
		this.loadUsuarios();
	},
};
</script>

<style lang="css" scoped>
</style>
