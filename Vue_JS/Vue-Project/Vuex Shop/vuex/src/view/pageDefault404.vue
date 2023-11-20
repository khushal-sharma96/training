<template>
  <v-img src="/error.jpg" class="absolute-image" contain>
    <v-btn
      color="orange"
      class="errorButton"
      @click="$router.push({ path: '/' })"
      >Go to Home Page</v-btn
    >
  </v-img>
  <!-- <v-img scr="/error.jpg"> -->
</template>
<style>
.absolute-image {
  position: absolute;
  top: 0;
  z-index: 2;
}
.errorButton {
  position: relative;
  top: 80vh;
  left: 45vw;
}
</style>
