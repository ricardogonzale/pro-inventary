<template>
    <v-app id="main-layout">
        <v-navigation-drawer
            v-model="drawer"
            app
            color="white grey--text"
            :expand-on-hover="!mini"
            :mobile-breakpoint="breakmenu"
        >
            <v-list class="grey--text elevation-4">
                <v-list-item class="px-2">
                    <v-list-item-avatar>
                        <!-- <v-img v-bind:src="'../../../img/ntr-logo.png'"></v-img> -->
                    </v-list-item-avatar>
                    <v-list-item-content>
                        <v-list-item-title
                            class="text-h6 teal--text text--darken-2"
                        >
                            Inventario
                        </v-list-item-title>
                    </v-list-item-content>
                </v-list-item>
            </v-list>
            <v-list nav dense class="grey--text">
                <v-list-item-title class="text-h6 grey--text">
                    <v-subheader class="blue-grey--text font-weight-bold"
                        >OPERACIONES</v-subheader
                    >
                </v-list-item-title>
                <v-list-group
                    v-for="item in itemsMenu"
                    :key="item.title"
                    v-model="item.active"
                    :prepend-icon="item.icon"
                    color="grey"
                    no-action
                >
                    <template v-slot:activator>
                        <v-list-item-content>
                            <v-list-item-title class="black--text">{{
                                item.text
                            }}</v-list-item-title>
                        </v-list-item-content>
                    </template>
                    <v-list-item
                        v-for="subItem in item.items"
                        :key="subItem.title"
                        :to="subItem.link"
                        link
                    >
                        <v-list-item-title
                            class="teal darken-2--text"
                            v-text="subItem.title"
                        ></v-list-item-title>

                        <v-list-item-icon>
                            <v-icon small v-text="subItem.icon"></v-icon>
                        </v-list-item-icon>
                    </v-list-item>
                </v-list-group>
            </v-list>
            <template v-slot:append>
                <div class="pa-2">
                    <v-btn small @click="logout">
                        <v-icon right color="orange"> mdi-exit-to-app </v-icon>
                    </v-btn>
                </div>
            </template>
        </v-navigation-drawer>

        <v-main class="white" style="padding: 0px 0px 0px 56px">
            <v-container fluid class="grey lighten-4">
                <v-row class="pa-4">
                    <!-- Page Content -->
                    <main style="width: 100%">
                        <!-- If using vue-router -->
                        <v-toolbar style="border-radius: 5px">
                            <v-app-bar-nav-icon
                                v-show="mini"
                                @click="drawer = !drawer"
                            ></v-app-bar-nav-icon>
                            <router-link to="/">
                                <v-tooltip bottom>
                                    <template v-slot:activator="{ on, attrs }">
                                        <v-btn
                                            icon
                                            small
                                            color="teal darken-2"
                                            v-bind="attrs"
                                            v-on="on"
                                        >
                                            <v-icon color="teal darken-2">
                                                mdi-home
                                            </v-icon>
                                        </v-btn>
                                    </template>
                                    <span>Inicio</span>
                                </v-tooltip>
                            </router-link>
                            <router-link to="/calendar">
                                <v-tooltip bottom>
                                    <template v-slot:activator="{ on, attrs }">
                                        <v-btn
                                            class="mx-2"
                                            icon
                                            small
                                            color="teal darken-2"
                                            v-bind="attrs"
                                            v-on="on"
                                        >
                                            <v-icon color="teal darken-2">
                                                mdi-calendar-blank
                                            </v-icon>
                                        </v-btn>
                                    </template>
                                    <span>Agenda</span>
                                </v-tooltip>
                            </router-link>
                            <v-spacer></v-spacer>
                            <div class="text-right mr-2">
                                <small
                                    ><span
                                        class="font-weight-bold"
                                        v-text="currentDate"
                                    ></span
                                ></small>
                                <br />
                                <v-icon
                                    small
                                    v-if="onLine != false"
                                    color="green"
                                    >mdi-wifi</v-icon
                                >
                                <v-icon small v-else color="red"
                                    >mdi-wifi-off</v-icon
                                >
                                <small
                                    ><span v-text="currentTime"></span
                                ></small>
                            </div>
                            <v-divider class="mx-4" vertical> </v-divider>
                            <vue-internet-checker
                                @status="status"
                                @event="event"
                            />
                            <v-idle
                                @idle="onidle"
                                @remind="onremind"
                                :reminders="[1200, 2500]"
                                :wait="3000"
                                :duration="3000"
                                style="display: none"
                            />
                            <v-snackbar v-model="ntf_wait">
                                {{ ntf_text }}

                                <template> </template>
                            </v-snackbar>
                            <v-dialog
                                v-model="dlg_expired"
                                persistent
                                max-width="350"
                            >
                                <v-card>
                                    <v-card-title class="text-h5">
                                        ¿Estas en actividad?
                                    </v-card-title>

                                    <v-card-text class="p-4 text-center">
                                        El sistema ha detectado que llevas mucho
                                        tiempo sin actividad, por seguridad tu
                                        sesion sera cerrada.
                                    </v-card-text>

                                    <v-card-actions>
                                        <v-spacer></v-spacer>

                                        <v-btn
                                            color="green darken-1"
                                            text
                                            @click="dlg_expired = false"
                                        >
                                            Mantener la sesión
                                        </v-btn>

                                        <v-btn
                                            color="green darken-1"
                                            @click="logout"
                                        >
                                            Salir
                                        </v-btn>
                                    </v-card-actions>
                                </v-card>
                            </v-dialog>
                            <div class="text-right mr-4 hidden-sm-and-down">
                                <span class="font-weight-bold"
                                    >Administrador</span
                                >
                                <br /><small>Admin</small>
                            </div>
                            <MenuUser-component></MenuUser-component>
                        </v-toolbar>
                        <br />
                        <v-overlay
                            opacity="0.7"
                            :value="onLine == false"
                            class="text-center"
                        >
                            <v-icon x-large color="red">mdi-wifi-off</v-icon>
                            <p>Sin conexión a internet</p>
                            <v-divider></v-divider>
                        </v-overlay>
                        <v-overlay
                            opacity="0.7"
                            :value="this.$store.state.loadpage"
                        >
                            <v-progress-circular
                                :size="70"
                                :width="7"
                                color="purple"
                                indeterminate
                            ></v-progress-circular>
                        </v-overlay>
                        <router-view></router-view>
                    </main>
                </v-row>
            </v-container>
        </v-main>
    </v-app>
</template>

<script>
import vueInternetChecker from "vue-internet-checker";
import moment from "moment";

export default {
    name: "App",
    components: {
        vueInternetChecker,
    },
    data() {
        return {
            dlg_expired: false,
            ntf_wait: false,
            ntf_text: "Haz estado inactivo por más de 10 minutos",
            onLine: null,
            currentDate: null,
            currentTime: null,
            drawer: null,
            overlay: false,
            showingNavigationDropdown: false,
            selectedItem: 0,
            typeUser: null,
            items: [
                {
                    text: "Administrativo",
                    icon: "mdi-account-cog-outline",
                    type: 0,
                    items: [
                        {
                            title: "Companies",
                            icon: "mdi-account-box-multiple",
                            link: "/listcompanys",
                        },
                    ],
                },
                {
                    text: "Clients",
                    icon: "mdi-book-account",
                    type: 1,
                    items: [
                        {
                            title: "Clients",
                            icon: "mdi-account-box-multiple",
                            link: "/listclients",
                        },
                        {
                            title: "Equipments",
                            icon: "mdi-hammer-wrench",
                            link: "/listequipments",
                        },
                        {
                            title: "Proyectos",
                            icon: "mdi-truck-check-outline",
                            link: "/",
                        },
                        {
                            title: "Buscar",
                            icon: "mdi-clipboard-text-search",
                            link: "/home",
                        },
                    ],
                },
                {
                    text: "Configuración",
                    icon: "mdi-tools",
                    type: 0,
                    items: [
                        {
                            title: "Crear usuario",
                            icon: "mdi-account-plus",
                            link: "/listorder/8",
                        },
                        {
                            title: "Configuracion",
                            icon: "mdi-wrench-clock",
                            link: "/listorder/8",
                        },
                    ],
                },
            ],
        };
    },
    computed: {
        userdatatype() {
            return this.$store.getters.userdatatype;
        },
        itemsMenu: function () {
            const type = this.userdatatype;
            if (type == null) {
                return this.items;
            }
            return this.items.filter((i) => i.type === type);
        },
        mini() {
            switch (this.$vuetify.breakpoint.name) {
                case "xs":
                    return true;
                case "sm":
                    return true;
                case "md":
                    return false;
                case "lg":
                    return false;
                case "xl":
                    return false;
            }
        },
        breakmenu() {
            switch (this.$vuetify.breakpoint.name) {
                case "md":
                    return 1;
                case "lg":
                    return 1;
                case "xl":
                    return 1;
            }
        },
    },
    methods: {
        onidle() {
            this.logout();
        },
        onremind(time) {
            // alert seconds remaining to 00:00
            if (time === 1200) {
                this.dlg_expired = true;
            } else {
                this.ntf_wait = true;
            }
            // alert(time);
        },
        status(ele) {
            // console.log(ele);
            this.onLine = ele;
        },
        event(ele) {
            // console.log(ele);
        },
        updateCurrentTime() {
            this.currentDate = moment().format("dddd D [de] MMMM ");
            this.currentTime = moment().format("LTS");
        },
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
    created() {
        this.currentDate = moment().format("dddd D [de] MMMM ");
        this.currentTime = moment().format("LTS");
        setInterval(() => this.updateCurrentTime(), 1 * 1000);
    },
    mounted() {
        this.$store.dispatch("getUserdata");
    },
};
</script>
<style>
.v-application .teal {
    background-color: #ffffff !important;
}
a:hover {
    /* color: #fff; */
    /* background-color: white !important; */
    text-decoration: none;
}
.add-on,
textarea,
input[type="text"],
input[type="datetime"],
input[type="datetime-local"],
input[type="date"],
input[type="month"],
input[type="time"],
input[type="week"],
input[type="number"],
input[type="email"],
input[type="url"],
input[type="search"],
input[type="tel"],
input[type="color"],
input[type="file"],
.uneditable-input {
    border-color: #e4e6eb00 !important;
}
</style>
