<template>
  <v-app>
    <Navbar />
    <router-view />
  </v-app>
</template>
<script>
export default {
  components: {
    Navbar: () => import("../components/navbarComponent.vue"),
  },
};
</script>
