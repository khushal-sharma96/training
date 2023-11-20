<template>
  <div class="container-fluid">
    <b-form @submit="onSubmit" @reset="onReset" v-if="show">

      <b-form-group id="input-group-2" label="First Name:" label-for="input-2" v-bind:description=message.nameDesc>
        <b-form-input id="input-2" v-model="name" placeholder="Enter name" required
          v-bind:description=nameDesc></b-form-input>
      </b-form-group>

      <b-form-group id="input-group-1" label="Email address:" label-for="input-1" v-bind:description=message.emailDesc>
        <b-form-input id="input-1" v-model="email" type="email" placeholder="Enter email" required></b-form-input>
      </b-form-group>

      <b-form-group id="input-group-3" label="Password:" label-for="input-3" v-bind:description=message.passwordDesc>
        <b-form-input id="input-3" v-model="password" type="text" placeholder="Enter Password" required></b-form-input>
      </b-form-group>

      <b-button type="submit" variant="primary">Submit</b-button>
      <b-button type="reset" variant="danger">Reset</b-button>
    </b-form>
    <b-card class="mt-3" header="Form Data Result">
      <pre class="m-0" v-show="show.sname">Name: {{ name }}</pre>
      <pre class="m-0" v-show="show.semail">Email: {{ email }}</pre>
      <pre class="m-0" v-show="show.spassword">Password: {{ password }}</pre>
    </b-card>
  </div>
</template>

<script>
export default {
  data() {
    return {
      email: '',
      name: '',
      password: "",
      message:{nameDesc: "Name is mandatory",
      passwordDesc: "Password is mandatory",
      emailDesc: "Email is mandatory"},
      show: {sname:true,semail:true,spassword:true},
      status: false
    }
  },
  watch: {
    name(val) {
      if (val == "") {
        this.message.nameDesc = "Name is mandatory";
        this.show.sname=true;
      }
      else if (val.length < 3 || /[0-9]/.test(val) || /[ `!@#$%^&*()_+\-=[\]{};':"\\|,.<>/?~]/.test(val)){
        this.message.nameDesc = "Enter the valid name please";
        this.show.sname=false;
      }
      else{
      this.message.nameDesc = "";
      this.show.sname=true;
      }
    },
  email(val) {
    if (val == "") {
      this.message.emailDesc = "Email is mandatory";
      this.show.semail=true;
    }
    else if ((val.length < 8) || (!val.includes("@"))){
      this.message.emailDesc = "Enter the valid Email please";
      this.show.semail=false;
    }
    else
      this.message.emailDesc = "";
      this.show.semail=true;
  },

  password(val) {
    let checkPattern = /[ `!@#$%^&*()_+\-=[\]{};':"\\|,.<>/?~]/;
    if (val == "") {
      this.message.passwordDesc = "Password is mandatory";
      this.show.spassword=true;
    }
    else if (val.length < 8 || (!checkPattern.test(val))){
      this.message.passwordDesc = "Minumun 8 characters along with special characters";
      this.show.spassword=false;
    }
    else
      this.message.passwordDesc = "";
      this.show.spassword=true;
  }
},
methods: {
  onReset(event) {
    event.preventDefault()
    // Reset our form values
    this.email = ''
    this.name = ''
    this.password = ''
    // Trick to reset/clear native browser form validation state
    // this.show = false
    // this.$nextTick(() => {
    //   this.show = true
    // })
  },
  onSubmit(event) {
    event.preventDefault();
//     Swal.fire(
//   'Good job!',
//   'You clicked the button!',
//   'success'
// )
    this.onReset(event);
    return true;
  }
}
}
</script>
<style>
.container {
  padding: 20px;
}
</style>