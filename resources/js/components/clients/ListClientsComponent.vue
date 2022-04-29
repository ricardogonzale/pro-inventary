<template>
    <v-data-table
        :headers="headers"
        :items="clients"
        sort-by="id"
        class="elevation-1"
    >
        <template v-slot:top>
            <v-toolbar flat>
                <h2>Clients</h2>
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
                            Create Client
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
                                            <h6>CLIENT INFORMATION</h6>
                                            <br />
                                        </v-col>
                                        <v-col cols="12" sm="12" md="12">
                                            <v-text-field
                                                v-model="editedItem.name"
                                                label="Name"
                                                :counter="255"
                                                required
                                                @input="
                                                    $v.editedItem.name.$touch()
                                                "
                                                @blur="
                                                    $v.editedItem.name.$touch()
                                                "
                                                :error-messages="nameErrors"
                                                outlined
                                            ></v-text-field>
                                        </v-col>
                                        <v-col cols="12" sm="12" md="12">
                                            <v-text-field
                                                v-model="editedItem.email"
                                                label="Email"
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
                                        <v-col cols="12" sm="6" md="6">
                                            <v-text-field
                                                v-model="editedItem.telephone"
                                                label="Telephone"
                                                outlined
                                            ></v-text-field>
                                        </v-col>
                                        <v-col cols="12" sm="6" md="6">
                                            <v-text-field
                                                v-model="editedItem.fax"
                                                label="Fax"
                                                outlined
                                            ></v-text-field>
                                        </v-col>
                                        <v-col cols="12" sm="6" md="6">
                                            <v-textarea
                                                outlined
                                                v-model="editedItem.address"
                                                label="Observations"
                                                placeholder="Observations"
                                                rows="2"
                                            ></v-textarea>
                                        </v-col>
                                        <v-col cols="12" sm="12" md="12">
                                            <v-file-input
                                                v-model="editedItem.img"
                                                color="deep-purple accent-4"
                                                counter
                                                label="Picture"
                                                prepend-icon=""
                                                placeholder="Load Picture"
                                                append-icon="mdi-cloud-upload-outline"
                                                outlined
                                                :show-size="1000"
                                            >
                                                <template
                                                    v-slot:selection="{
                                                        index,
                                                        text,
                                                    }"
                                                >
                                                    <v-chip
                                                        v-if="index < 2"
                                                        color="deep-purple accent-4"
                                                        dark
                                                        label
                                                        small
                                                    >
                                                        {{ text }}
                                                    </v-chip>

                                                    <span
                                                        v-else-if="index === 2"
                                                        class="text-overline grey--text text--darken-3 mx-2"
                                                    >
                                                        +
                                                        {{ files.length - 2 }}
                                                        File(s)
                                                    </span>
                                                </template>
                                            </v-file-input>
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
                                Save
                            </v-btn>
                        </v-card-actions>
                    </v-card>
                </v-dialog>
                <v-dialog v-model="dialogDelete" max-width="300px">
                    <v-card>
                        <h3 class="py-4 text-center">
                            ¿Do you want to delete this record?
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
                Edit
            </v-chip>
            <v-chip small color="warning" dark @click="deleteItem(item)">
                <v-icon small class="mr-2"> mdi-delete </v-icon> Delete
            </v-chip>
        </template>
        <template v-slot:no-data>
            <v-btn color="warning" small @click="initialize"> Reset </v-btn>
        </template>
    </v-data-table>
</template>
<script>
import axios from "axios";
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
            name: { required, maxLength: maxLength(255) },
            email: { required, email },
            telephone: { required },
        },
    },
    data: () => ({
        dialog: false,
        dialogDelete: false,
        files: [],
        state: [],
        value: [],
        headers: [
            { text: "Id", value: "id" },
            {
                text: "Name",
                align: "start",
                value: "name",
            },
            { text: "Email", value: "email" },
            { text: "Telephone", value: "telephone" },
            { text: "Status", value: "state" },
            { text: "Actions", value: "actions", sortable: false },
        ],
        editedIndex: -1,
        editedItem: {
            id: null,
            name: "",
            email: "",
            telephone: "",
            fax: "",
            address: "",
        },
        defaultItem: {
            id: null,
            name: "",
            email: "",
            telephone: "",
            fax: "",
            address: "",
            img: [],
        },
    }),

    computed: {
        clients: {
            get() {
                return this.$store.state.client.clients;
            },
        },
        formTitle() {
            return this.editedIndex === -1 ? "New Client" : "Edit Client";
        },
        nameErrors() {
            const errors = [];
            if (!this.$v.editedItem.name.$dirty) return errors;
            !this.$v.editedItem.name.required &&
                errors.push("This field is required.");
            !this.$v.editedItem.name.maxLength &&
                errors.push("The field must not contain more than 255 digits.");
            return errors;
        },
        emailErrors() {
            const errors = [];
            if (!this.$v.editedItem.email.$dirty) return errors;
            !this.$v.editedItem.email.email &&
                errors.push("The email format is invalid.");
            !this.$v.editedItem.email.required &&
                errors.push("E-mail is required.");
            return errors;
        },
        passwordErrors() {
            const errors = [];
            if (!this.$v.editedItem.password.$dirty) return errors;
            !this.$v.editedItem.password.minLength &&
                errors.push(
                    "The password must not contain less than 8 digits."
                );
            !this.$v.editedItem.password.required &&
                errors.push("This field is required.");
            return errors;
        },
        stateErrors() {
            const errors = [];
            if (!this.$v.editedItem.state.$dirty) return errors;
            !this.$v.editedItem.state.required &&
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
            this.clients = [];
        },

        editItem(item) {
            this.editedIndex = this.clients.indexOf(item);
            this.editedItem = Object.assign({}, item);
            this.dialog = true;
        },

        deleteItem(item) {
            console.log(item);
            this.editedIndex = this.clients.indexOf(item);
            this.editedItem = Object.assign({}, item);
            this.dialogDelete = true;
        },

        deleteItemConfirm() {
            this.clients.splice(this.editedIndex, 1);
            this.$store
                .dispatch("delete", this.editedItem)
                .then((res) => {
                    this.$store.dispatch("getClients");
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
        getState: function () {
            axios.get("/getState").then(
                function (response) {
                    this.state = response.data;
                }.bind(this)
            );
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
            formData.append("imagen[img]", this.editedItem.img);

            if (this.editedIndex > -1) {
                // Object.assign(this.clients[this.editedIndex], this.editedItem);
                this.$store
                    .dispatch("update", formData)
                    .then((res) => {
                        this.$store.dispatch("getClients");
                    })
                    .catch((error) => {
                        console.log(error.response.data);
                        this.registerRequestSent = false;
                    });
            } else {
                this.$store
                    .dispatch("register", formData)
                    .then((res) => {
                        this.$store.dispatch("getClients");
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
        this.$store.dispatch("getClients");
        this.getState();
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
