<template>
	<!-- Modal -->
	<div
		class="modal fade"
		id="modal_id"
		tabindex="-1"
		role="dialog"
		aria-labelledby="exampleModalLongTitle"
		aria-hidden="true"
	>
		<div class="modal-dialog animated--grow-in" role="document">
			<div class="modal-content p-2">
				<form @submit.prevent="save">
                    <div class="modal-header">
                        <h5
                            id="exampleModalLongTitle"
                            class="modal-title"
                            v-if="Object.keys(userEdit).length === 0"
                        >
                            Agregar Usuario
                        </h5>
                        <h5 v-else>Editar Usuario</h5>
                        <button
                            type="button"
                            class="close"
                            @click="close"
                            data-dismiss="modal"
                            aria-label="Close"
                        >
                            <span>&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <!-- Row para el id y tipo ID -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mt-1">
                                    <label for="slelect1">Tipo de identificacion</label>
                                    <select class="form-control" id="select1">
                                        <option>CC</option>
                                        <option>TI</option>
                                        <option>PS</option>
                                        <option>Cedula extrangera</option>
                                        <option>Otro</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div
                                    class="form-group"
                                    :class="{
                                        'form-group--error': $v.DNI.$error,
                                    }"
                                >
                                    <label for="DNI" class="col-form-label">Identificacion:</label>
                                    <input
                                        type="number"
                                        class="form-control"
                                        id="DNI"
                                        v-model.trim="$v.DNI.$model"
                                    />
                                </div>
                                <div class="error" v-if="!$v.DNI.required">
                                    Este campo es requerido
                                </div>
                                <div class="error" v-if="!$v.DNI.numeric">Numero incorrecto</div>
                                <div class="error" v-if="!$v.DNI.minLength">
                                    No pude tener menos de
                                    {{ $v.DNI.$params.minLength.min }}
                                    numeros.
                                </div>
                                <div class="error" v-if="!$v.DNI.maxLength">
                                    No puede tener mas de
                                    {{ $v.DNI.$params.maxLength.max }}
                                    numeros.
                                </div>
                            </div>
                        </div>

                        <!-- Row para el primer y segundo nombre -->
                        <div class="row">
                            <div class="col-md-6">
                                <div
                                    class="form-group"
                                    :class="{
                                        'form-group--error': $v.first_name.$error,
                                    }"
                                >
                                    <label for="nombre" class="col-form-label form__label">Nombre:</label>
                                    <input
                                        type="text"
                                        class="form-control form__input"
                                        id="nombre"
                                        v-model.trim="$v.first_name.$model"
                                    />
                                </div>
                                <div class="error" v-if="!$v.first_name.required">
                                    Este campo es requerido
                                </div>
                                <div class="error" v-if="!$v.first_name.minLength">
                                    No se puede tener menos de
                                    {{ $v.first_name.$params.minLength.min }} letras.
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="apellido" class="col-form-label">Apellido:</label>
                                    <input
                                        type="text"
                                        class="form-control"
                                        id="apellido"
                                        v-model="last_name"
                                    />
                                </div>
                            </div>
                        </div>

                        <!-- Row para el email -->
                        <div
                            class="form-group"
                            :class="{
                                'form-group--error': $v.email.$error,
                            }"
                        >
                            <label for="correo" class="col-form-label">Correo:</label>
                            <input
                                type="email"
                                class="form-control"
                                id="correo"
                                v-model.trim="$v.email.$model"
                            />
                        </div>
                        <div class="error" v-if="!$v.email.required">
                            Este campo es requerido
                        </div>
                        <div class="error" v-if="!$v.email.email">Email invalido</div>

                        <!-- Row para editar contraseña -->
                        <div class="form-group" v-if="Object.keys(userEdit).length !== 0">
                            <label for="needPass" class="col-form-label">Cambiar contraseña?</label>
                            <label class="switch">
                                <input type="checkbox" v-model="needPassword" />
                                <span class="slider round"></span>
                            </label>
                        </div>

                        <!-- Row para constraseña -->
                        <div class="row" v-if="needPassword">
                            <div class="col-md-6">
                                <div
                                    class="form-group"
                                    :class="{
                                        'form-group--error': $v.password.$error,
                                    }"
                                >
                                    <label for="password" class="col-form-label form__label"
                                        >Contraseña:</label
                                    >
                                    <input
                                        type="password"
                                        class="form-control form__input"
                                        id="password"
                                        v-model.trim="$v.password.$model"
                                    />
                                </div>
                                <div class="error" v-if="!$v.password.required">
                                    Este campo es requerido
                                </div>
                                <div class="error" v-if="!$v.password.minLength">
                                    No se puede tener menos de
                                    {{ $v.password.$params.minLength.min }}
                                    caracteres.
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div
                                    class="form-group"
                                    :class="{
                                        'form-group--error': $v.repeatPassword.$error,
                                    }"
                                >
                                    <label for="repeatPassword" class="col-form-label"
                                        >Confirmar contraseña:</label
                                    >
                                    <input
                                        type="password"
                                        class="form-control"
                                        id="repeatPassword"
                                        v-model.trim="$v.repeatPassword.$model"
                                    />
                                </div>
                                <div class="error" v-if="!$v.repeatPassword.sameAsPassword">
                                    Las contraaseñas deben ser iguales.
                                </div>
                            </div>
                        </div>

                        <!-- Row para el rol -->
                        <div class="form-group">
                            <label for="role">Rol</label>
                            <!-- Llamamos al multielect -->
                            <multiselect
                                v-model="role"
                                placeholder="Search"
                                label="name"
                                track-by="id"
                                :options="options"
                                :multiple="true"
                            ></multiselect>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button
                            type="button"
                            class="btn btn-secondary"
                            @click="close"
                            data-dismiss="modal"
                        >
                            Close
                        </button>
                        <button
                            v-if="Object.keys(userEdit).length === 0"
                            type="submit"
                            class="btn btn-primary"
                        >
                            Save changes
                        </button>
                        <button v-else type="submit" class="btn btn-primary">Edit</button>
                    </div>
				</form>
			</div>
		</div>
	</div>
</template>

<script>
import {
	required,
	minLength,
	maxLength,
	numeric,
	alpha,
	email,
	sameAs
} from "vuelidate/lib/validators";

import Multiselect from 'vue-multiselect';
import toastr from 'toastr';

export default {

	name: "ModalComponent",

	props: ["userEdit", "mode"],

	components: { Multiselect },

	data() {
		return {
			// Variables de usuario
			DNI: "",
			first_name: "",
			last_name: "",
			email: "",
			password: "",
			repeatPassword: "",
			role: [],

			//Opciones del multiselect
			options: [],

			//Variable que verifica que se quiere cambiar la contraseña
			needPassword: true,

		};
	},

	validations() {
		// Si no hay datos en userEdit queire decir que esta en modo edicion
		if (!this.needPassword) {
			return {
				DNI: {
					required,
					numeric,
					minLength: minLength(9),
					maxLength: maxLength(10)
				},
				first_name: {
					required,
					minLength: minLength(4)
				},
				last_name: {
					required,
					minLength: minLength(4)
				},
				email: {
					required,
					email
				},
			}
		} else {
			return {
				DNI: {
					required,
					numeric,
					minLength: minLength(9),
					maxLength: maxLength(10)
				},
				first_name: {
					required,
					minLength: minLength(4)
				},
				last_name: {
					required,
					minLength: minLength(4)
				},
				email: {
					required,
					email
				},
				password: {
					required,
					minLength: minLength(6)
				},
				repeatPassword: {
					sameAsPassword: sameAs("password")
				},
			}
		}
	},

	methods: {
		close() {
			$('#modal_id').modal('hide');
			this.user = [];
			this.$emit("close");
		},

		save() {
			if (this.mode == "edit") {
				this.update();
			} else {
				this.store();
			}
		},

		async store() {
			this.$v.$touch();

			if (this.$v.$invalid) {
				//Mensaje de validacion de formulario
				console.log("error");
				toastr.error("complete los campos requeridos");
			} else {
				//Paso la validacion del formulario
				try {
					var data = {
						DNI: this.DNI,
						first_name: this.first_name,
						last_name: this.last_name,
						email: this.email,
						password: this.password,
						role: this.role,
					};
					let response = await axios.post("/api/user", data);

					var success = response.data.success;
					var messages = response.data.message;
					// console.log(response.data);
					if (success == true) {
						console.log(messages);
						toastr.success(messages);
						this.close();
						this.$emit("actualizar", true);
					} else {
						// Mensaje de validacion
						Object.keys(messages).forEach(type => {
							console.log(type + " -> " + messages[type]);
							toastr.error(type + " -> " + messages[type]);
						});
					}
				} catch (error) {
					console.log(error);
				}
			}
		},

		async update() {
			this.$v.$touch();

			if (this.$v.$invalid) {
				//Mensaje de validacion de formulario
				console.log("error");
				toastr.error("Complete los campos requeridos");
			} else {
				//Paso la validacion del formulario
				try {
					var data = {
						DNI: this.DNI,
						first_name: this.first_name,
						last_name: this.last_name,
						email: this.email,
						password: this.password,
						role: this.role
					};
					let response = await axios.put("/api/user/" + this.id, data);

					var success = response.data.success;
					var messages = response.data.message;
					// console.log(response.data);
					if (success == true) {
						console.log(messages);
						toastr.success(messages);
						this.close();
						this.$emit("actualizar", true);
					} else {
						// Mensaje de validacion
						Object.keys(messages).forEach(type => {
							toastr.error(type + " -> " + messages[type]);
							console.log(type + " -> " + messages[type]);
						});
					}
				} catch (error) {
					console.log(error);
				}
			}
		},

		async getRoles() {
			try {
				let response = await axios.get("/api/roles");
				var success = response.data.success;
				var messages = response.data.message;
				// console.log(response.data);

				if (success == true) {
					// console.log(response.data.data);
					this.options = response.data.data;
					console.log(messages);
				} else {
					// Mensajes de error
					console.log(messages);
				}
			} catch (error) {
				console.log(error);
			}
		},
	},

	mounted() {
		$('#modal_id').modal({ backdrop: 'static', keyboard: false });
		if (Object.keys(this.userEdit).length === 0) {
			this.needPassword = true;
		} else {
			this.needPassword = false;
		}
		// Variables locales - en caso de que se vaya a editar
		this.id = this.userEdit.id;
		this.DNI = this.userEdit.DNI;
		this.first_name = this.userEdit.first_name;
		this.last_name = this.userEdit.last_name;
		this.email = this.userEdit.email;

		//Obtenemos los roles
		this.getRoles();
		this.role = this.userEdit.roles;
	}
};
</script>

<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>

<style lang="css" scoped>
/* Estilos para los errores de vuelidate */
.form-group--alert,
.form-group--error {
	animation-name: shakeError;
	animation-fill-mode: forwards;
	animation-duration: 0.6s;
	animation-timing-function: ease-in-out;
}

/* *,
*:before,
*:after {
   box-sizing: inherit;
} */

.form-group--error .form__label,
.form-group--error .form__label--inline {
	color: #f04124;
}

.form-group--error input,
.form-group--error textarea,
.form-group--error input:focus,
.form-group--error input:hover {
	border-color: #f79483;
}

.form-group--error + .form-group__message,
.form-group--error + .error {
	display: block;
	color: #f57f6c;
}

.form-group__message,
.error {
	font-size: 0.75rem;
	line-height: 1;
	display: none;
	margin-left: 14px;
	margin-top: -1.6875rem;
	margin-bottom: 0.9375rem;
}

.form-group {
	margin-bottom: 2rem;
}

.form-group__message,
.error {
	font-size: 0.75rem;
	line-height: 1;
	display: none;
	margin-left: 14px;
	margin-top: -1.6875rem;
	margin-bottom: 0.9375rem;
}

.form-group--alert,
.form-group--error {
	animation-name: shakeError;
	animation-fill-mode: forwards;
	animation-duration: 0.6s;
	animation-timing-function: ease-in-out;
}

.form-group--loading .form__input {
	border-image-slice: 1;
	animation: loading-frame 1s infinite;
}

@keyframes loading-frame {
	0% {
		border-color: #3acfd5;
	}
	50% {
		border-color: #3a4ed5;
	}
	100% {
		border-color: #3acfd5;
	}
}

@keyframes shakeError {
	0% {
		transform: translateX(0);
	}
	15% {
		transform: translateX(0.375rem);
	}
	30% {
		transform: translateX(-0.375rem);
	}
	45% {
		transform: translateX(0.375rem);
	}
	60% {
		transform: translateX(-0.375rem);
	}
	75% {
		transform: translateX(0.375rem);
	}
	90% {
		transform: translateX(-0.375rem);
	}
	100% {
		transform: translateX(0);
	}
}

/* Estilos para el modal */
/* .modal-mask {
	position: absolute;
	z-index: 9999;
	top: 0;
	left: 0;
	width: 100%;
	height: 100%;
	background-color: rgba(0, 0, 0, 0.5);
	display: table;
	transition: opacity 0.3s ease;
	overflow: auto;
}

.modal-wrapper {
	display: table-cell;
	vertical-align: middle;
}

.modal-content {
	width: 500px;
	margin: 0px auto;
	padding: 10px 10px;
	background-color: #fff;
	border-radius: 10px;
	box-shadow: 0 2px 8px rgba(0, 0, 0, 0.33);
	transition: all 0.3s ease;
	font-family: "Nunito", Helvetica, Arial, sans-serif;
}

.modal-header h3 {
	margin-top: 0;
	color: #42b983;
}

.modal-body {
	margin: 20px 0;
}

.modal-default-button {
	float: right;
} */

/*
 * The following styles are auto-applied to elements with
 * transition="modal" when their visibility is toggled
 * by Vue.js.
 *
 * You can easily play with the modal transition by editing
 * these styles.
 */

/* .modal-enter {
	opacity: 0;
}

.modal-leave-active {
	opacity: 0;
}

.modal-enter .modal-container,
.modal-leave-active .modal-container {
	-webkit-transform: scale(1.1);
	transform: scale(1.1);
} */

/* Estilos para el switch */
/* The switch - the box around the slider */
.switch {
	position: relative;
	display: inline-block;
	width: 45px;
	height: 19px;
}

/* Hide default HTML checkbox */
.switch input {
	opacity: 0;
	width: 0;
	height: 0;
}

/* The slider */
.slider {
	position: absolute;
	cursor: pointer;
	top: 0;
	left: 0;
	right: 0;
	bottom: 0;
	background-color: #ccc;
	-webkit-transition: 0.4s;
	transition: 0.4s;
}

.slider:before {
	position: absolute;
	content: "";
	height: 12px;
	width: 12px;
	left: 4px;
	bottom: 4px;
	background-color: white;
	-webkit-transition: 0.4s;
	transition: 0.4s;
}

input:checked + .slider {
	background-color: #2196f3;
}

input:focus + .slider {
	box-shadow: 0 0 1px #2196f3;
}

input:checked + .slider:before {
	-webkit-transform: translateX(26px);
	-ms-transform: translateX(26px);
	transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
	border-radius: 34px;
}

.slider.round:before {
	border-radius: 50%;
}
</style>
