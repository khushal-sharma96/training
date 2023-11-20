<template>
    <v-card class="overflow-hidden">
        <v-app-bar absolute color="indigo darken-2" dark>
            <!-- shrink-on-scroll prominent scroll-target="#scrolling-techniques" -->
            <!-- <v-app-bar-nav-icon></v-app-bar-nav-icon> -->
            <!-- <v-btn rounded color="primary" dark>
                Rounded Button
            </v-btn> -->
            <router-link to="/">
                <v-toolbar-title dark class="mr-5" style="cursor:pointer;text-decoration: none; color:white">Developer
                    Junction</v-toolbar-title>
            </router-link>
            <v-spacer></v-spacer>
            <router-link to="/about">
                <v-btn rounded class="mx-5" color="primary" dark elevation="10" v-if="isLogin">
                    About
                </v-btn>
            </router-link>


            <router-link to="/register">
                <v-btn rounded color="primary" class="mx-5" dark elevation="10" v-if="!isLogin">
                    Registration
                </v-btn>
            </router-link>
            <router-link to="/login">
                <v-btn rounded color="primary" class="mx-5" dark elevation="10" v-if="!isLogin">
                    Login
                </v-btn>
            </router-link>
            <v-btn rounded color="primary" class="mx-5" dark elevation="10" @click="logOut" v-if="isLogin">
                Logout
            </v-btn>

            <router-link to="/users">
                <v-btn rounded color="primary" class="mx-5" dark elevation="10" v-if="isLogin">
                    Users
                </v-btn>
            </router-link>

        </v-app-bar>
        <v-sheet id="scrolling-techniques" class="overflow-y-auto" max-height="600">
            <v-container style="height: 60px;"></v-container>
        </v-sheet>
    </v-card>
</template>
<script>
export default {
    mounted() {
        const isLoggedIn = localStorage.getItem('isLogin');
        this.isLogin = isLoggedIn && isLoggedIn == "1"

        this.$eventBus.$on("loggedIn", (resp) => {
            console.log("Received ", resp)
            this.isLogin = true;
        })
    },
    beforeDestroy() {
        this.$eventBus.$off("loggedIn")
    },
    data() {
        return {
            isLogin: false
        }
    },
    methods: {
        logOut() {
            this.isLogin = false;
            localStorage.setItem('isLogin', 0);
            console.log(localStorage.getItem('isLogin'));
            window.location.href = 'http://localhost:8080/#/login';
        }
    }
}
</script>
<style>
.v-application a {
    text-decoration: none;
    font-weight: 600;
}
</style>