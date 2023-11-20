<template>
  <v-footer dark padless color="indigo darken-2">
    <v-card flat tile class="indigo darken-2 white--text text-center">
      <v-card-text>
        <v-btn v-for="icon in icons" :key="icon" class="mx-4 white--text" icon>
          <a href="https://facebook.com" style="color:white">
            <v-icon size="24px">
              {{ icon }}
            </v-icon>
          </a>
        </v-btn>
      </v-card-text>

      <v-card-text class="white--text pt-0">
        Thank You for visiting our website.
      </v-card-text>
      <v-card-text class="white--text pt-0">
        Our organization is providing the best developement services all over the world. Our offices are available in
        India as well as Australia also. Our vision is to maintain the customer's satisfaction after fulfilling all
        requirements.
      </v-card-text>

      <v-divider></v-divider>

      <v-card-text class="white--text">
        {{ new Date().getFullYear() }} — <strong>Khushal Sharma</strong>
      </v-card-text>
    </v-card>
  </v-footer>
</template>

<script>
export default {
  data: () => ({
    icons: [
      'mdi-facebook',
      'mdi-twitter',
      'mdi-linkedin',
      'mdi-instagram',
    ],
  }),
}
</script>