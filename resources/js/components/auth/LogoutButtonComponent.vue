<template>
    <v-btn :loading="logoutRequestSent" tile text class="mr-1" @click="logout"
        >Logout</v-btn
    >
</template>

<script>
export default {
    data() {
        return {
            logoutRequestSent: false,
        };
    } /* end of data obj */,

    methods: {
        logout() {
            this.logoutRequestSent = true;

            this.$store
                .dispatch("logout")
                .then((res) => {
                    this.logoutRequestSent = false;
                    window.location = "/";
                })
                .catch((error) => {
                    console.log(error.response.data);
                    this.logoutRequestSent = false;
                });
        } /* end of logout */,
    },
};
</script>
