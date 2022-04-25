<template>
    <v-app
        :class="{ 'pa-3': $vuetify.breakpoint.smAndUp }"
        :dark="darkTheme"
        id="inspire"
    >
        <v-divider></v-divider>
        <v-container fluid>
            <v-layout wrap style="margin-top: 20vh">
                <v-flex sm12 md4 offset-md4>
                    <v-card
                        :loading="loginRequestSent"
                        elevation="4"
                        light
                        tag="section"
                    >
                        <v-card-title class="py-9">
                            <v-layout align-center justify-space-between>
                                <!-- 
                                <v-img
                                    :alt="platformName"
                                    class="mr-3"
                                    contain
                                    height="48px"
                                    src="https://unoynueve.info/dev/ntr/wp-content/uploads/2022/02/logo-ntr-black.svg"
                                ></v-img>
                                -->
                            </v-layout>
                        </v-card-title>
                        <v-divider></v-divider>
                        <v-card-text class="text-center py-9">
                            <p>Rellena los datos para acceder</p>
                            <v-form ref="loginForm">
                                <v-text-field
                                    outline
                                    v-model="email"
                                    type="email"
                                    label="E-mail"
                                    autofocus
                                    :rules="emailRules"
                                    :error-messages="errors.email[0]"
                                ></v-text-field>
                                <v-text-field
                                    outline
                                    hide-details
                                    v-model="password"
                                    type="password"
                                    label="Password"
                                    :rules="passwordRules"
                                ></v-text-field>
                            </v-form>
                        </v-card-text>
                        <v-divider></v-divider>
                        <v-card-actions
                            :class="{ 'pa-3': $vuetify.breakpoint.smAndUp }"
                        >
                            <v-btn class="teal--text text--darken-2" text>
                                Olvidé mi contraseña
                            </v-btn>
                            <v-spacer></v-spacer>
                            <v-btn
                                class="white--text"
                                color="teal darken-2"
                                :large="$vuetify.breakpoint.smAndUp"
                                :loading="loginRequestSent"
                                @click="login"
                                ><v-icon left>mdi-lock</v-icon> Entrar</v-btn
                            >
                        </v-card-actions>
                    </v-card>
                </v-flex>
                <v-flex sm12 md4 offset-md4>
                    <v-layout align-center justify-space-between>
                        <p class="caption my-3 teal--text text--darken-2">
                            <a href="#">Politicas de Privacidad</a>
                            |
                            <a href="#">Terminos de uso</a>
                        </p>
                        <!-- <p class="caption my-3">Powered by <a href="#">StaffCircle</a></p> -->
                    </v-layout>
                </v-flex>
            </v-layout>
        </v-container>
    </v-app>
</template>

<script>
export default {
    props: ["auth"],
    data() {
        return {
            darkTheme: true,
            platformName: "NTR | Good Deals",
            email: "",
            emailRules: [(email) => !!email || "E-mail is required"],

            password: "",
            passwordRules: [
                (password) => !!password || "password is required",
                (password) =>
                    password.length > 6 ||
                    "password must be more than 6 characters long",
            ],

            errors: {
                email: [],
            },

            /* loading status for the v-card and v-btn */
            loginRequestSent: false,
        };
    },

    computed: {
        loggedIn() {
            return this.$store.getters.loggedIn;
        },
    },

    methods: {
        reset() {
            this.$refs.loginForm.reset();
        },

        login() {
            if (this.$refs.loginForm.validate()) {
                // if the form is validated send login request
                this.loginRequestSent = true;

                const credentials = {
                    email: this.email,
                    password: this.password,
                };

                this.$store
                    .dispatch("login", credentials)
                    .then((res) => {
                        console.log(res);
                        this.loginRequestSent = false;
                        this.dialog = false;
                        window.location.href = "/home/";
                    })
                    .catch((error) => {
                        console.log(error.response.data.message);
                        alert(error.response.data.message);
                        this.errors = error.response.data.errors;
                        this.loginRequestSent = false;
                    });
            }
        },
    },
};
</script>
<style>
.v-btn,
.v-card {
    border-radius: 4px;
}
.v-card__title {
    text-transform: uppercase;
}
</style>
