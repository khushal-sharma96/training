<template>
  <v-app>
    <Layout />
  </v-app>
</template>

<script>
export default {
  name: "App",

  components: {
    Layout: () => import("./layouts/defaultLayout.vue"),
  },
};
</script>
