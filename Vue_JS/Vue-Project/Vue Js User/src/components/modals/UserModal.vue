<template>
  <v-dialog v-model="showForm" persistent max-width="500" max-height="700">
    <v-card>
      <v-card-title> User Data </v-card-title>
      <v-card-text>
        <v-form ref="formEdit" @submit.prevent="saveData()">
          <v-text-field
            v-model="form.name"
            :counter="20"
            :rules="rules.nameRules"
            label="Name"
            required
          />

          <v-text-field
            v-model="form.email"
            :rules="rules.emailRules"
            label="E-mail"
            required
          />

          <v-btn :disabled="!valid" color="success" class="mr-4" type="submit">
            Save
          </v-btn>

          <v-btn color="error" class="mr-4" @click="reset"> Reset Form </v-btn>
          <v-btn color="primary " class="mr-4" @click="$emit('closed')"
            >Close</v-btn
          >
        </v-form>
      </v-card-text>
    </v-card>
  </v-dialog>
</template>

<script>
import userMixin from "../Mixins/UserMixin";
import Swal from "sweetalert2";
export default {
  name: "UserModal",
  mixins: [userMixin],
  props: {
    user: {
      type: Object,
      default: () => {},
    },
  },
  data() {
    return {
      form: { name: "", email: "" },
      showForm: true,
      rules: {
        nameRules: [
          (v) => !!v || "Name is required",
          (v) =>
            (v && v.length <= 20) || "Name must be less than 10 characters",
        ],
        cpasswordRules: [
          (v) => !!v || "Confirm Password is required",
          (v) =>
            (v && v == this.form.password) || "Confirm password mismatched",
        ],
      },
    };
  },
  mounted() {
    console.log(this.user);
    if (this.user && this.user.userID) {
      this.form = this.user;
    }
  },
  methods: {
    saveData() {
      const valid = this.$refs.formEdit.validate();
      if (valid) {
        if (this.form.userID) {
          const mainData = {
            action: "updateUser",
            newOne: this.form,
            prev: {
              userID: this.form.userID,
            },
          };
          this.$axios
            .post("index.php", mainData)
            .then(({ data }) => {
              if (data.status) {
                Swal.fire("Success", "User Updated Successsfully", "success");
                this.$emit("closed");
              } else {
                Swal.fire("Error");
                console.log(data.message);
              }
            })
            .catch((err) => {
              console.log(err);
            });
        } else {
          this.form.action = "insertUser";
          this.$axios.post("index.php", this.form).then(({ data }) => {
            if (data.status) {
              Swal.fire("Success", "User Added Successsfully", "success");
              this.$emit("closed");
            } else {
              Swal.fire("Error");
            }
          });
        }
      }
    },
    reset() {
      this.$refs.formEdit.reset();
    },
  },
};
</script>
