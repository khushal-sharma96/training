<template>
  <v-card
    width="400"
    color="deep-purple lighten-5"
    class="mx-auto my-3 px-3 py-5"
  >
    <v-card-title align-center>Login</v-card-title>
    <v-form ref="form" @submit.prevent="validate">
      <v-text-field
        v-model="userId"
        :counter="10"
        :rules="idrule"
        label="Username/Email"
        required
      ></v-text-field>
      <v-text-field
        v-model="password"
        :rules="passwordRule"
        label="Password"
        type="password"
        required
      ></v-text-field>

      <v-btn :disabled="!valid" color="orange" class="mr-4" small type="submit">
        Submit
      </v-btn>

      <v-btn color="error" class="mr-4" small @click="reset"> Reset </v-btn>
    </v-form>
  </v-card>
</template>

<script>
import { mapMutations } from "vuex";
export default {
  name: "loginPage",
  data: () => ({
    valid: true,
    userData: {},
    idrule: [],
    userId: "",
    password: "",
    passwordRule: [
      (v) => !!v || "Password is required",
      (v) =>
        (v && v.length > 8 && v.length <= 16) ||
        "Password length must be in 8-16 characters",
    ],
  }),
  computed: {
    ...mapMutations({ login: "LOGIN" }),
  },
  watch: {
    userId: {
      handler(newValue, prev) {
        if (newValue != null) {
          if (newValue == "" || prev == "") {
            this.idrule = [(v) => !!v || "Username/Email is required"];
          } else if (newValue.indexOf("@") > -1) {
            console.log(newValue.indexOf("@"));
            this.idrule = [
              (v) => /.+@.+\..+/.test(v) || "E-mail must be valid",
            ];
          } else {
            this.idrule = [
              (v) =>
                (v && v.length <= 16) ||
                "Username should be of 16 characters only",
            ];
          }
        }
      },
      deep: true,
    },
  },
  methods: {
    validate() {
      if (this.$refs.form.validate()) {
        this.userData = {};
        if (this.userId.indexOf("@") != -1) {
          this.userData.email = this.userId;
        } else {
          this.userData.userName = this.userId;
        }
        this.userData.password = this.password;
        console.log("UserData:", this.userData);
        //   this.login;
        this.$swal({
          icon: "success",
          title: "Logged in Successfully",
          showConfirmButton: false,
          timer: 1500,
        }).then(() => {
          this.$store.state.isLogin = true;
          this.$router.push({ path: "/cart" });
        });
      }
    },
    reset() {
      this.$refs.form.reset();
    },
  },
};
</script>
