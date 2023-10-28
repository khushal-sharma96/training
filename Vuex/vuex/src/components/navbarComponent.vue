<template>
  <div>
    <v-app-bar height="70" color="deep-purple accent-4" dense dark>
      <v-icon color="white darken-2 ml-5 mr-2"> mdi-shopping </v-icon>
      <v-toolbar-title class="" @click="$router.push({path:'/'})">Shopsy</v-toolbar-title>
      <v-spacer></v-spacer>
      <v-btn @click="$router.push({path:'/'})" class="mx-5" color="orange
" small light>Products</v-btn>
      <v-badge color="green" :content="countItems ? countItems : '0'" class="mr-5">
        <router-link to="/cart">
          <v-icon large color="white darken-2"> mdi-cart </v-icon>
        </router-link>
      </v-badge>
    </v-app-bar>
  </div>
</template>
<script>
import { mapGetters, mapActions } from "vuex";
export default {
  name: "navbarComponent",
  computed: {
    ...mapGetters({ countItems: "GET_COUNT_ITEMS", countVal: "GET_COUNT" }),
  },
  methods: {
    ...mapActions({ incrementCount: "UPDATE_COUNT" }),
    decrementCount() {
      if (this.countVal > 0) {
        this.incrementCount({ update: -1 });
      }
    },
  },
};
</script>
