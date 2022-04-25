<template>
    <div>
        <v-dialog v-model="dialog">
            <!-- the login button -->
            <template v-slot:activator="{ on }">
                <v-btn v-on="on" tile text class="mr-1">Register</v-btn>
            </template>

            <!-- the login form -->
            <v-card tile :loading="registerRequestSent" max-width="500" class="mx-auto">
                <v-card-title class="text-uppercase font-weight-bold">Register</v-card-title>

                <v-divider></v-divider>

                <v-card-text>
                    <v-form ref="RegisterForm">
                        <v-container grid-list-md>
                            <v-layout column>
                                <v-flex xs12>
                                    <v-text-field
                                    v-model="name"
                                    type="text"    
                                    label="Name"
                                    autofocus
                                    :rules="nameRules"
                                    ></v-text-field>
                                </v-flex>

                                <v-flex xs12>
                                    <v-text-field
                                    v-model="email"
                                    type="email"    
                                    label="E-mail"
                                    
                                    :rules="emailRules"
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

                                <v-flex xs12>
                                    <v-text-field
                                    v-model="password_confirmation"
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
                    <v-btn text :loading="registerRequestSent" @click="register">Register</v-btn>
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

            name       : '',
            nameRules  : [
                name => !!name || 'Name is required',
            ],

            email       : '',
            emailRules  : [
                email => !!email || 'E-mail is required',
            ],

            password                : '',
            password_confirmation   : '',
            passwordRules           : [
                password => !!password ||'Password is required',
                //password => password.length <= 6 || 'password must be more than 6 characters long'
            ],

            /* loading status for the v-card and v-btn */
            registerRequestSent : false,
        }
    }, /* end of data obj */
    
    methods: {
        reset(){
            this.$refs.RegisterForm.reset();
        },

        register(){
            if (this.$refs.RegisterForm.validate()) {
                // if the form is validated send login request
                this.registerRequestSent = true;

                const credentials = {
                    name                    : this.name,
                    email                   : this.email,
                    password                : this.password,
                    password_confirmation   : this.password_confirmation
                };

                this.$store.dispatch('register', credentials)
                    .then( res => {
                        this.registerRequestSent   = false;
                        this.dialog             = false;
                        window.location = '/';
                    }). catch( error => {
                        console.log(error.response.data);
                        this.registerRequestSent = false;
                    });

    
            }
        },
        
    },
}
</script>
