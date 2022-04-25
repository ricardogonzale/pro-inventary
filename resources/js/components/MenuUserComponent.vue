<template>
    <div class="text-center">
        <v-menu
            v-model="menu"
            :close-on-content-click="false"
            :nudge-width="100"
            offset-y
        >
            <template v-slot:activator="{ on, attrs }">
                <v-avatar
                    color="grey darken-1 shrink"
                    size="45"
                    v-bind="attrs"
                    v-on="on"
                >
                    <v-img v-bind:src="'../../../img/user.png'"></v-img>
                </v-avatar>
            </template>

            <v-card>
                <v-list>
                    <v-list-item>
                        <v-list-item-avatar>
                            <img
                                v-bind:src="'../../../img/user.png'"
                                alt="Ricardo"
                            />
                        </v-list-item-avatar>

                        <v-list-item-content>
                            <v-list-item-title>Admin</v-list-item-title>
                            <v-list-item-subtitle
                                >Administrador</v-list-item-subtitle
                            >
                        </v-list-item-content>
                        <v-list-item-action>
                            <Darkmode-component></Darkmode-component>
                        </v-list-item-action>
                    </v-list-item>
                </v-list>

                <v-divider></v-divider>

                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn color="orange" small text @click="logout">
                        Salir
                        <v-icon right color="orange"> mdi-exit-to-app </v-icon>
                    </v-btn>
                </v-card-actions>
            </v-card>
        </v-menu>
    </div>
</template>
<script>
export default {
    data: () => ({
        fav: true,
        menu: false,
        message: false,
        hints: true,
    }),
    methods: {
        logout: function () {
            axios
                .post("logout")
                .then((response) => {
                    if (response.status === 302 || 401) {
                        window.location = "/";
                        console.log("logout");
                    } else {
                        // throw error and go to catch block
                    }
                })
                .catch((error) => {});
        },
    },
};
</script>
