<template>
    <div>
        <v-dialog v-model="dialog">
            <!-- the login button -->
            <template v-slot:activator="{ on }">
                <v-btn v-on="on" tile text class="mr-1">Login</v-btn>
            </template>

            <!-- the login form -->
            <v-card tile :loading="loginRequestSent" max-width="500" class="mx-auto">
                <v-card-title class="text-uppercase font-weight-bold">Login</v-card-title>

                <v-divider></v-divider>

                <v-card-text>
                    <v-form ref="loginForm">
                        <v-container grid-list-md>
                            <v-layout column>
                                <v-flex xs12>
                                    <v-text-field
                                    v-model="email"
                                    type="email"    
                                    label="E-mail"
                                    autofocus
                                    :rules="emailRules"
                                    :error-messages="errors.email[0]"
                                    ></v-text-field>
                                </v-flex>

                                <v-flex xs12>
                                    <v-text-field
                                    v-model="password"
                                    type="password"
                                    label="Password"
                                    :rules="passwordRules"
                                    ></v-text-field>
                                </v-flex>

                            </v-layout>
                        </v-container>
                    </v-form>
                </v-card-text>
                
                <v-divider></v-divider>

                <v-card-actions>
                    <v-btn text :loading="loginRequestSent" @click="login">Login</v-btn>
                    <v-btn text @click="dialog = false">Cancel</v-btn>

                    <v-spacer></v-spacer>

                    <v-btn text @click="reset">reset</v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
    </div>
</template>

<script>
export default {
    data() {
        return {
            dialog : false,

            email       : '',
            emailRules  : [
                email => !!email || 'E-mail is required',
            ],

            password        : '',
            passwordRules   : [
                password => !!password ||'password is required',
                password => password.length > 6 || 'password must be more than 6 characters long'
            ],

            errors: {
                email : []
            },

            /* loading status for the v-card and v-btn */
            loginRequestSent : false,
        }
    }, /* end of data obj */
    
    methods: {
        reset(){
            this.$refs.loginForm.reset();
        },

        login(){
            if (this.$refs.loginForm.validate()) {
                // if the form is validated send login request
                this.loginRequestSent = true;

                const credentials = {
                    email       : this.email,
                    password    : this.password
                };

                this.$store.dispatch('login', credentials)
                    .then( res => {
                        this.loginRequestSent   = false;
                        this.dialog             = false;
                        window.location = '/';
                    }). catch( error => {
                        console.log(error.response.data);
                        this.errors = error.response.data.errors;
                        this.loginRequestSent = false;
                    });

    
            }
        },
        
    },
}
</script>
