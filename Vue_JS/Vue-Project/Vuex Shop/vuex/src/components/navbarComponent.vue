<template>
  <div>
    <v-app-bar height="70" color="deep-purple accent-4" dense dark>
      <v-icon color="white darken-2 ml-5 mr-2"> mdi-shopping </v-icon>
      <v-toolbar-title class="" @click="$router.push({ path: '/' })"
        >Shopsy</v-toolbar-title
      >
      <v-spacer></v-spacer>
      <v-btn
        @click="$router.push({ path: '/' })"
        color="orange
"
        small
        light
        >Products</v-btn
      >

      <v-btn
        small
        color="orange"
        light
        class="mx-3"
        v-if="!isLogin"
        @click="$router.push({ path: '/login' })"
      >
        Login
      </v-btn>
      <v-btn small color="orange" light  v-if="!isLogin">
        Register
      </v-btn>

      <v-badge
        color="green"
        :content="countItems && isLogin ? countItems : '0'"
        class="mx-4"
      >
        <router-link to="/cart">
          <v-icon large color="white darken-2"> mdi-cart </v-icon>
        </router-link>
      </v-badge>
      <v-btn
        small
        rounded
        color="red"
        class="ml-6"
        light
        v-if="isLogin"
        @click="logoutUser(false)"
      >
        Log Out
      </v-btn>
    </v-app-bar>
  </div>
</template>
<script>
import { mapGetters, mapActions, mapMutations } from "vuex";
export default {
  name: "navbarComponent",
  data() {
    return {};
  },
  computed: {
    ...mapGetters({
      countItems: "GET_COUNT_ITEMS",
      countVal: "GET_COUNT",
      isLogin: "GET_LOGIN",
    }),
    ...mapMutations({}),
  },
  methods: {
    ...mapActions({ incrementCount: "UPDATE_COUNT", logout: "LOGIN_ACTION" }),

    decrementCount() {
      if (this.countVal > 0) {
        this.incrementCount({ update: -1 });
      }
    },
    logoutUser(value) {
      this.logout({ value });
    },
  },
};
</script>
