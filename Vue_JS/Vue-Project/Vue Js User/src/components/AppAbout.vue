<template>
  <v-card class="mx-auto my-10" max-width="344">
    <v-img src="https://www.learnatrise.in/wp-content/uploads/2019/01/full-stack-web-development-course.png"
      height="200px"></v-img>

    <v-card-title>
      Khushal Sharma
    </v-card-title>

    <v-card-subtitle>
      Developer
    </v-card-subtitle>

    <v-card-actions>
      <v-btn color="orange lighten-2" text>
        Explore
      </v-btn>

      <v-spacer></v-spacer>

      <v-btn icon @click="show = !show">
        <v-icon>{{ show ? 'mdi-chevron-up' : 'mdi-chevron-down' }}</v-icon>
      </v-btn>
    </v-card-actions>

    <v-expand-transition>
      <div v-show="show">
        <v-divider></v-divider>

        <v-card-text>
          Hello, Its Khushal Sharma, a full stack web developer. My team is providing developement services for more than
          5 years with full of customer satisfaction.
        </v-card-text>
      </div>
    </v-expand-transition>
  </v-card>
</template>
<script>
// import auth from '../middleware/auth'
export default {
  data: () => ({
    show: false,
  }),

  mounted() {
    const isLogin = localStorage.getItem("isLogin");
    this.show = isLogin && isLogin == "1";
  },
}
</script>