<template>
  <v-form ref="form" width="250px" class="pa-md-4 mx-lg-auto" @submit.prevent="onSubmit">
    <v-text-field v-model="name" :counter="20" :rules="nameRules" label="Name" required></v-text-field>

    <v-text-field v-model="email" :rules="emailRules" label="E-mail" required></v-text-field>

    <v-text-field v-model="password" :counter="8" :rules="passwordRules" label="Password" required
      type="password"></v-text-field>

    <v-text-field v-model="cpassword" :counter="8" :rules="cpasswordRules" label="Confirm Password" required
      type="password"></v-text-field>

    <v-checkbox v-model="checkbox" :rules="[v => !!v || 'You must agree to continue!']" label="I have checked all these"
      required></v-checkbox>

    <v-btn :disabled="!valid" color="success" class="mr-4" type="submit">
      Validate
    </v-btn>

    <v-btn color="error" class="mr-4" @click="reset">
      Reset Form
    </v-btn>

  </v-form>
</template>

<script>
import axios from 'axios';
import Swal from 'sweetalert2'
import UserMixin from './Mixins/UserMixin';
export default {
  mixins: [UserMixin],
  data() {
    return {
      name: '',
      cpassword: '',
      checkbox: false,
      nameRules: [
        v => !!v || 'Name is required',
        v => (v && v.length <= 20) || 'Name must be less than 10 characters',
      ],
      cpasswordRules: [
        v => !!v || 'Confirm Password is required',
        v => (v && v == this.password) || 'Confirm password mismatched'
      ],
      select: null,
      items: [
        'Item 1',
        'Item 2',
        'Item 3',
        'Item 4',
      ]

    }
  },

  methods: {
    onSubmit() {

      if (this.$refs.form.validate()) {
        const data = {
          name: this.name,
          email: this.email,
          password: this.password,
          action: 'insertUse'
        }
        axios.post('index.php', data).then(({ data }) => {
          Swal.fire("Success", data.message, "success");
          window.location.href = 'http://localhost:8080/#/login';
          // this.$refs.form.reset();
        }).catch(({ response, message }) => {
          console.log("response", response, message)
          Swal.fire("Error", response && response.data ? response.data.message : message, "error");
        })

      } else {
        return false
      }

    },
    reset() {
      this.$refs.form.reset()
    }
  },
}
</script>

<style>
.v-application .pa-md-4 {
  padding: 16px !important;
  width: 516px;
  margin: auto;
}
</style>