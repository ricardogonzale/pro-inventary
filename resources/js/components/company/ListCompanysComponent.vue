<template>
    <v-data-table
        :headers="headers"
        :items="companys"
        sort-by="id"
        class="elevation-1"
    >
        <template v-slot:top>
            <v-toolbar flat>
                <h2>Compañias Registradas</h2>
            </v-toolbar>
            <v-toolbar flat>
                <v-dialog v-model="dialog" max-width="400px">
                    <template v-slot:activator="{ on, attrs }">
                        <v-btn
                            color="orange"
                            dark
                            small
                            rounded
                            class="mb-2"
                            v-bind="attrs"
                            v-on="on"
                            style="border-radius: 30px; text-transform: none"
                        >
                            Registrar Compañia
                        </v-btn>
                    </template>
                    <v-card>
                        <v-toolbar color="orange" dark
                            >{{ formTitle }}
                            <v-spacer></v-spacer>
                        </v-toolbar>

                        <v-card-text class="pt-8">
                            <v-form
                                ref="form"
                                method="POST"
                                @submit.prevent="save()"
                            >
                                <v-container>
                                    <v-row>
                                        <v-col cols="12" sm="12" md="12">
                                            <h6>INFORMACIÓN DE LA COMPAÑIA</h6>
                                            <br />
                                        </v-col>
                                        <v-col cols="12" sm="12" md="12">
                                            <v-text-field
                                                v-model="
                                                    editedItem.company_name
                                                "
                                                label="Nombre"
                                                :counter="255"
                                                required
                                                @input="
                                                    $v.editedItem.company_name.$touch()
                                                "
                                                @blur="
                                                    $v.editedItem.company_name.$touch()
                                                "
                                                :error-messages="
                                                    company_nameErrors
                                                "
                                                outlined
                                            ></v-text-field>
                                        </v-col>
                                        <v-col cols="12" sm="12" md="12">
                                            <v-text-field
                                                v-model="editedItem.email"
                                                label="Correo electrónico"
                                                required
                                                @input="
                                                    $v.editedItem.email.$touch()
                                                "
                                                @blur="
                                                    $v.editedItem.email.$touch()
                                                "
                                                :error-messages="emailErrors"
                                                outlined
                                            ></v-text-field>
                                        </v-col>
                                        <v-col cols="12" sm="12" md="12">
                                            <v-text-field
                                                v-model="editedItem.password"
                                                label="Contraseña"
                                                required
                                                @input="
                                                    $v.editedItem.password.$touch()
                                                "
                                                @blur="
                                                    $v.editedItem.password.$touch()
                                                "
                                                :error-messages="passwordErrors"
                                                outlined
                                            ></v-text-field>
                                        </v-col>
                                        <v-col cols="12" sm="6" md="6">
                                            <v-text-field
                                                v-model="editedItem.phone"
                                                label="Telefono"
                                                outlined
                                            ></v-text-field>
                                        </v-col>
                                    </v-row>
                                </v-container>
                            </v-form>
                        </v-card-text>

                        <v-card-actions>
                            <v-spacer></v-spacer>
                            <v-btn color="warning" small @click="close">
                                Cancel
                            </v-btn>
                            <v-btn color="warning" small @click="save">
                                Guardar
                            </v-btn>
                        </v-card-actions>
                    </v-card>
                </v-dialog>
                <v-dialog v-model="dialogDelete" max-width="300px">
                    <v-card>
                        <h3 class="py-4 text-center">
                            ¿Deseas Eliminar este registro?
                        </h3>
                        <v-card-actions>
                            <v-spacer></v-spacer>
                            <v-btn color="warning" small @click="closeDelete"
                                >Cancel</v-btn
                            >
                            <v-btn
                                color="warning"
                                small
                                @click="deleteItemConfirm"
                                >OK</v-btn
                            >
                            <v-spacer></v-spacer>
                        </v-card-actions>
                    </v-card>
                </v-dialog>
            </v-toolbar>
        </template>
        <template v-slot:[`item.actions`]="{ item }">
            <v-chip small color="warning" dark @click="editItem(item)">
                <v-icon small class="mr-2"> mdi-pencil </v-icon>
                Editar
            </v-chip>
            <v-chip small color="warning" dark @click="deleteItem(item)">
                <v-icon small class="mr-2"> mdi-delete </v-icon> Eliminar
            </v-chip>
        </template>
        <template v-slot:no-data>
            <v-btn color="warning" small @click="initialize"> Reset </v-btn>
        </template>
    </v-data-table>
</template>
<script>
import { validationMixin } from "vuelidate";
import {
    required,
    maxLength,
    minLength,
    email,
} from "vuelidate/lib/validators";

export default {
    mixins: [validationMixin],
    validations: {
        editedItem: {
            company_name: { required, maxLength: maxLength(255) },
            email: { required, email },
            password: { required, minLength: minLength(8) },
        },
    },
    data: () => ({
        dialog: false,
        dialogDelete: false,
        files: [],
        state: [],
        value: [],
        headers: [
            { text: "Id", value: "id_company" },
            {
                text: "Nombre",
                align: "start",
                value: "company_name",
            },
            { text: "Correo electrónico", value: "email" },
            { text: "Teléfono", value: "phone" },
            { text: "Active", value: "status" },
            { text: "Acciones", value: "actions", sortable: false },
        ],
        editedIndex: -1,
        editedItem: {
            id: null,
            company_name: "",
            email: "",
            password: "",
            phone: "",
        },
        defaultItem: {
            id: null,
            company_name: "",
            email: "",
            password: "",
            phone: "",
        },
    }),

    computed: {
        companys: {
            get() {
                return this.$store.state.company.companys;
            },
        },
        formTitle() {
            return this.editedIndex === -1
                ? "Nueva Compañia"
                : "Editar Compañia";
        },
        company_nameErrors() {
            const errors = [];
            if (!this.$v.editedItem.company_name.$dirty) return errors;
            !this.$v.editedItem.company_name.required &&
                errors.push("Este campo es obligatorio.");
            !this.$v.editedItem.company_name.maxLength &&
                errors.push("El campo no debe contener más 255 digitos.");
            return errors;
        },
        emailErrors() {
            const errors = [];
            if (!this.$v.editedItem.email.$dirty) return errors;
            !this.$v.editedItem.email.email &&
                errors.push("El formato del correo electrónico es invalido.");
            !this.$v.editedItem.email.required &&
                errors.push("E-mail es obligatorio");
            return errors;
        },
        passwordErrors() {
            const errors = [];
            if (!this.$v.editedItem.password.$dirty) return errors;
            !this.$v.editedItem.password.minLength &&
                errors.push(
                    "La contraseña no debe contener menos de 8 digitos"
                );
            !this.$v.editedItem.password.required &&
                errors.push("Este campo es obligatorio.");
            return errors;
        },
    },

    watch: {
        dialog(val) {
            val || this.close();
        },
        dialogDelete(val) {
            val || this.closeDelete();
        },
    },

    created() {
        this.initialize();
    },

    methods: {
        initialize() {
            this.companys = [];
        },

        editItem(item) {
            this.editedIndex = this.companys.indexOf(item);
            this.editedItem = Object.assign({}, item);
            this.dialog = true;
        },

        deleteItem(item) {
            console.log(item);
            this.editedIndex = this.companys.indexOf(item);
            this.editedItem = Object.assign({}, item);
            this.dialogDelete = true;
        },

        deleteItemConfirm() {
            this.companys.splice(this.editedIndex, 1);
            this.$store
                .dispatch("deleteCompany", this.editedItem)
                .then((res) => {
                    this.$store.dispatch("getCompanys");
                })
                .catch((error) => {
                    console.log(error.response.data);
                    this.registerRequestSent = false;
                });
            this.closeDelete();
        },

        close() {
            this.$v.$reset();
            this.dialog = false;
            this.$nextTick(() => {
                this.editedItem = Object.assign({}, this.defaultItem);
                this.editedIndex = -1;
            });
        },

        closeDelete() {
            this.dialogDelete = false;
            this.$nextTick(() => {
                this.editedItem = Object.assign({}, this.defaultItem);
                this.editedIndex = -1;
            });
        },
        save() {
            this.$v.$touch();
            if (this.$v.$invalid) {
                return;
            }
            let formData = new FormData();
            let rawData = { info: this.editedItem };
            console.log(this.editedItem);
            rawData = JSON.stringify(rawData);
            formData.append("data", rawData);

            if (this.editedIndex > -1) {
                this.$store
                    .dispatch("updateCompany", formData)
                    .then((res) => {
                        this.$store.dispatch("getCompanys");
                    })
                    .catch((error) => {
                        console.log(error.response.data);
                        this.registerRequestSent = false;
                    });
            } else {
                this.$store
                    .dispatch("registerCompany", formData)
                    .then((res) => {
                        this.$store.dispatch("getCompanys");
                    })
                    .catch((error) => {
                        console.log(error.response.data);
                        this.registerRequestSent = false;
                    });
            }
            this.close();
        },
    },
    mounted() {
        this.$store.dispatch("getCompanys");
    },
};
</script>
<style scoped>
.col,
.col-1,
.col-2,
.col-3,
.col-4,
.col-5,
.col-6,
.col-7,
.col-8,
.col-9,
.col-10,
.col-11,
.col-12,
.col-auto,
.col-lg,
.col-lg-1,
.col-lg-2,
.col-lg-3,
.col-lg-4,
.col-lg-5,
.col-lg-6,
.col-lg-7,
.col-lg-8,
.col-lg-9,
.col-lg-10,
.col-lg-11,
.col-lg-12,
.col-lg-auto,
.col-md,
.col-md-1,
.col-md-2,
.col-md-3,
.col-md-4,
.col-md-5,
.col-md-6,
.col-md-7,
.col-md-8,
.col-md-9,
.col-md-10,
.col-md-11,
.col-md-12,
.col-md-auto,
.col-sm,
.col-sm-1,
.col-sm-2,
.col-sm-3,
.col-sm-4,
.col-sm-5,
.col-sm-6,
.col-sm-7,
.col-sm-8,
.col-sm-9,
.col-sm-10,
.col-sm-11,
.col-sm-12,
.col-sm-auto,
.col-xl,
.col-xl-1,
.col-xl-2,
.col-xl-3,
.col-xl-4,
.col-xl-5,
.col-xl-6,
.col-xl-7,
.col-xl-8,
.col-xl-9,
.col-xl-10,
.col-xl-11,
.col-xl-12,
.col-xl-auto {
    width: 100%;
    padding: 0px 12px;
}
.v-dialog__content {
    position: absolute;
}
</style>
