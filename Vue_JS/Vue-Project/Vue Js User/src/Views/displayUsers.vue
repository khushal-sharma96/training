<template>
  <v-main>
    <div class="table mx-auto" style="border: 2px solid black">
      <h2 class="text-center">User Data</h2>
      <v-btn
        depressed
        color="primary"
        small
        @click="
          user = {};
          showModal = true;
        "
      >
        Add User
      </v-btn>

      <v-simple-table>
        <template #default>
          <thead>
            <tr>
              <th class="text-left" size="3rem">Name</th>
              <th class="text-left">E-mail</th>
            </tr>
          </thead>

          <tbody v-if="!isEmpty">
            <tr v-for="(user, index) in allUsers" :key="index">
              <td>{{ user.name }}</td>
              <td>{{ user.email }}</td>
              <td>
                <v-btn depressed color="primary" small @click="editUser(user)">
                  Edit User
                </v-btn>
              </td>
              <td>
                <v-btn depressed color="red" small @click="deleteUser(index)">
                  Remove User
                </v-btn>
              </td>
            </tr>
          </tbody>
          <div v-else>
            <v-btn
              class="mx-lg-auto my-10"
              large
              color="primary"
              @click="editUser = false"
            >
              Add User
            </v-btn>
          </div>
        </template>
      </v-simple-table>
      <!-- modals---------- -->
      <user-modal v-if="showModal" :user="user" @closed="closeModal" />
    </div>
  </v-main>
</template>

<script>
import axios from "axios";
import Swal from "sweetalert2";
import mixin from "../components/Mixins/UserMixin";
export default {
  components: {
    UserModal: () => import("../components/modals/UserModal.vue"),
  },
  mixins: [mixin],
  data() {
    return {
      user: {},
      showModal: false,
      isEmpty: false,
      allUsers: [],
      isEdit: false,
      form: {
        name: "",
        email: "",
        password: "",
      },
    };
  },
  mounted() {
    this.getUsers();
  },
  methods: {
    closeModal() {
      this.showModal = false;
      this.getUsers();
    },
    getUsers() {
      axios
        .post("index.php", { action: "getUser" })
        .then(({ data }) => {
          this.allUsers = data.data;
          if (!this.allUsers) {
            this.isEmpty = true;
          }
        })
        .catch((e) => {
          Swal.fire("Error", "Something went wrong!", "error");
          console.log(e);
        });
    },
    editUser(user) {
      this.user = JSON.parse(JSON.stringify(user));
      this.showModal = true;
    },
    deleteUser(row_no) {
      const deleRecord = {
        action: "deleteUser",
        name: this.allUsers[row_no].name,
        email: this.allUsers[row_no].email,
      };
      axios
        .post("index.php", deleRecord)
        .then(() => {
          Swal.fire(
            "Deleted",
            `Record of ${this.allUsers[row_no].name} is deleted successfully`,
            "success"
          );
          this.allUsers.splice(row_no, 1);
        })
        .catch((e) => {
          Swal.fire("Error", "Could't delete", "error");
          console.log(e);
        });
    },
    saveData(New, exist = 0) {
      if (this.$refs.form.validate()) {
        if (exist) {
          const updateData = {
            exist,
            New,
            action: "updateUser",
          };
          axios
            .post("index.php", updateData)
            .then(() => {
              Swal.fire(
                "Success",
                "User Updated Successsfully",
                "success"
              ).then(() => {
                this.isEdit = false;
              });
            })
            .catch((error) => {
              Swal.fire("Error", "Could't Update", "error");
              console.log(error);
            });
        } else {
          const saveData = { ...New };
          saveData.action = "insertUser";
          axios.post("index.php", saveData).then(({ data }) => {
            if (data.status) {
              Swal.fire("Success", "User Added Successfully", "success");
            } else {
              Swal.fire("Error", data.message, "error");
            }
          });
        }
      }
    },
  },
};
</script>
