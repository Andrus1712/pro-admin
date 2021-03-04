<template>
	<div>
		<div class="card mb-4">
			<div class="card-header d-flex justify-content-between">
				<ul class="nav nav-pills" id="pills-tab" role="tablist">
					<li class="nav-item">
						<a
							class="nav-link active"
							id="pills-home-tab"
							data-toggle="pill"
							href="#pills-table"
							role="tab"
							aria-controls="pills-table"
							aria-selected="true"
							>Tabla de Roles</a
						>
					</li>
					<li class="nav-item">
						<a
							class="nav-link"
							id="pills-permissions-tab"
							data-toggle="pill"
							href="#pills-permissions"
							role="tab"
							aria-controls="pills-permissions"
							aria-selected="false"
							>Permisos</a
						>
					</li>
				</ul>
				<a class="align-self-center btn btn-md btn-success shadow-sm">
					<span class="icon text-white-50">
						<i class="fas fa-plus fa-sm text-white-50"></i>
					</span>
					<span class="text">Agregar</span>
				</a>
			</div>
			<div class="card-body">
				<div class="tab-content" id="pills-tabContent">
					<div
						class="tab-pane fade show active"
						id="pills-table"
						role="tabpanel"
						aria-labelledby="pills-table-tab"
					>
						<!-- tabla  -->
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
										<th>Name</th>
										<th>Description</th>
										<th>created_at</th>
										<th class="text-center">Permissions</th>
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
									<tr v-for="role in roles" :key="role.id">
										<td scope="row">{{ role.id }}</td>
										<td>{{ role.readable_name }}</td>
										<td>{{ role.description }}</td>
										<td>{{ fecha(role.created_at) }}</td>
										<td>
											<span
												class="badge badge-secondary shadow-sm m-1"
												v-for="permission in role.permissions"
												:key="permission.id"
												>{{ permission.readable_name }}
											</span>
										</td>
										<td class="text-center">
											<div class="btn-group">
												<a
													v-if="$auth.can('edit.users')"
													class="btn btn-info btn-sm shadow-sm"
												>
													<i class="fas fa-pencil-alt"></i>
												</a>
												<a
													v-if="$auth.can('delete.users')"
													class="btn btn-danger btn-sm shadow-sm"
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
					<div
						class="tab-pane fade"
						id="pills-permissions"
						role="tabpanel"
						aria-labelledby="pills-permissions-tab"
					>
						<!-- Card para cada Rol -->
						<div
							class="card border-left-primary shadow mb-3"
							v-for="(role, index) in roles"
							:key="role.id"
						>
							<!-- Card Header - Accordion -->
							<a
								:href="'#collapseCard_' + index"
								class="d-block card-header py-3"
								data-toggle="collapse"
								role="button"
								aria-expanded="true"
								:aria-controls="'collapseCard_' + index"
							>
								<h6 class="m-0 font-weight-bold text-secondary">
									{{ role.readable_name }}
								</h6>
							</a>

							<div class="collapse" :id="'collapseCard_' + index" style="">
								<div class="card-body">
									<div class="mb-4">
										<h6 class="font-weight-bold">Permisos del sistema</h6>
										<p>Seleccione o quite los permisos a este usuario</p>
									</div>

									<!-- Permisos Principales -->
									<div class="d-flex justify-content-between m-2">
										<h6 class="font-weight-bold">Principales</h6>
										<span class="divider"></span>
									</div>
									<div class="row m-4">
										<label>Permitir asignar permisos</label>
										<div class="form-check form-check-inline">
											<div class="form-check">
												<input
													class="form-check-input"
													type="radio"
													name="admin_permissions"
													id="asignar.permisos"
													value="asignar.permisos"
													checked
												/>
												<label class="form-check-label" for="asignar.permisos"> Si </label>
											</div>
											<div class="form-check">
												<input
													class="form-check-input"
													type="radio"
													name="admin_permissions"
													id="no.asignar.permisos"
													value="no.asignar.permisos"
												/>
												<label class="form-check-label" for="no.asignar.permisos">
													No
												</label>
											</div>
										</div>
									</div>
									<div class="row m-4">
										<label class="col-form-label">Permitir entrar a la aplicación</label>
										<div class="form-check form-check-inline">
											<div class="form-check">
												<input
													class="form-check-input"
													type="radio"
													name="app_permissions"
													id="view.app"
													value="view.app"
													checked
												/>
												<label class="form-check-label" for="view.app"> Si </label>
											</div>
											<div class="form-check">
												<input
													class="form-check-input"
													type="radio"
													name="app_permissions"
													id="no.view.app"
													value="no.view.app"
												/>
												<label class="form-check-label" for="no.view.app"> No </label>
											</div>
										</div>
									</div>
									<div class="row m-4">
										<label>Permitir entrar a dashboard</label>
										<div class="form-check form-check-inline">
											<div class="form-check">
												<input
													class="form-check-input"
													type="radio"
													name="admin_permissions"
													id="view.admin"
													value="view.admin"
													checked
												/>
												<label class="form-check-label" for="view.admin"> Si </label>
											</div>
											<div class="form-check">
												<input
													class="form-check-input"
													type="radio"
													name="admin_permissions"
													id="no.view.admin"
													value="no.view.admin"
												/>
												<label class="form-check-label" for="no.view.admin"> No </label>
											</div>
										</div>
									</div>
									<!-- FIn permisos Principales -->

									<!-- Permisos de usuarios -->
									<div class="d-flex justify-content-between m-2">
										<h6 class="font-weight-bold">Usuarios</h6>
										<span class="divider"></span>
										<div class="form-check-inline">
											<input
												class="form-check-input"
												type="checkbox"
												id="inlineCheckbox3"
												value="option3"
											/>
											<label class="form-check-label" for="inlineCheckbox3"
												>Select All</label
											>
										</div>
									</div>
									<div class="row d-flex justify-content-between m-4">
										<div class="col-md-10 d-flex justify-content-around">
											<div class="form-check form-check-inline">
												<input
													class="form-check-input"
													type="checkbox"
													id="inlineCheckbox1"
													value="option1"
												/>
												<label class="form-check-label" for="inlineCheckbox1"
													>Listar Usuarios</label
												>
											</div>
											<div class="form-check form-check-inline">
												<input
													class="form-check-input"
													type="checkbox"
													id="inlineCheckbox2"
													value="option2"
												/>
												<label class="form-check-label" for="inlineCheckbox2"
													>Crear Usuarios</label
												>
											</div>
											<div class="form-check form-check-inline">
												<input
													class="form-check-input"
													type="checkbox"
													id="inlineCheckbox3"
													value="option3"
												/>
												<label class="form-check-label" for="inlineCheckbox3"
													>Editar usuarios</label
												>
											</div>
											<div class="form-check form-check-inline">
												<input
													class="form-check-input"
													type="checkbox"
													id="inlineCheckbox3"
													value="option3"
												/>
												<label class="form-check-label" for="inlineCheckbox3"
													>Eliminar usuarios</label
												>
											</div>
										</div>
									</div>
									<!-- Fin permisos de usuarios -->

									<!-- Permisos de Roles -->
									<div class="d-flex justify-content-between m-2">
										<h6 class="font-weight-bold">Roles</h6>
										<span class="divider"></span>
										<div class="form-check-inline">
											<input
												class="form-check-input"
												type="checkbox"
												id="inlineCheckbox3"
												value="option3"
											/>
											<label class="form-check-label" for="inlineCheckbox3"
												>Select All</label
											>
										</div>
									</div>
									<div class="row d-flex justify-content-between m-4">
										<div class="col-md-10 d-flex justify-content-around">
											<div class="form-check form-check-inline">
												<input
													class="form-check-input"
													type="checkbox"
													id="inlineCheckbox1"
													value="option1"
												/>
												<label class="form-check-label" for="inlineCheckbox1"
													>Listar roles</label
												>
											</div>
											<div class="form-check form-check-inline">
												<input
													class="form-check-input"
													type="checkbox"
													id="inlineCheckbox2"
													value="option2"
												/>
												<label class="form-check-label" for="inlineCheckbox2"
													>Crear roles</label
												>
											</div>
											<div class="form-check form-check-inline">
												<input
													class="form-check-input"
													type="checkbox"
													id="inlineCheckbox3"
													value="option3"
												/>
												<label class="form-check-label" for="inlineCheckbox3"
													>Editar roles</label
												>
											</div>
											<div class="form-check form-check-inline">
												<input
													class="form-check-input"
													type="checkbox"
													id="inlineCheckbox3"
													value="option3"
												/>
												<label class="form-check-label" for="inlineCheckbox3"
													>Eliminar roles</label
												>
											</div>
										</div>
									</div>
									<!-- Fin Permisos de Roles -->

									<hr />
									<div class="d-flex justify-content-end">
										<button class="btn btn-primary">Guardar</button>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
import $ from "jquery";
import dt from "datatables.net";

export default {
	name: 'Roles',

	data() {
		return {
			status: 0,
			roles: [],
		}
	},

	methods: {

		async loadRoles() {
			this.$emit("load", true);
			this.status = 0;
			this.roles = [];
			try {
				let response = await axios.get("/api/roles");
				this.roles = response.data.data;
				if (this.roles != null) {
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
		this.loadRoles();
	}
};
</script>

<style>
.divider {
	flex-grow: 1;
	border-bottom: 1px solid #e4e4e4;
	margin: 5px;

	/* border: 0;
	height: 1px;
	background: #333;
	background-image: linear-gradient(to right, #ccc, #333, #ccc); */
}
</style>
