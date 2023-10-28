<template>
  <div>
    <v-card>
      <v-app-bar color="orange" light class="text-align-center mb-5"
        ><v-toolbar-title light class="d-flex"><v-img width="80" src="/static/shopping.png" class="mr-2"></v-img> 

 </v-toolbar-title>
      </v-app-bar>
    </v-card>
    <v-simple-table width="1000" class="mx-4">
      <template v-slot:default>
        <thead>
          <tr>
            <th>S.No.</th>
            <th class="text-left">Item Name</th>
            <th class="text-left">Image</th>
            <th class="text-left">Quantity</th>
            <th class="text-left">Action</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="(item, index) in cartItems" :key="item.name">
            <td>{{ index + 1 }}</td>
            <td>{{ item.name }}</td>
            <td>
              <v-img
                :src="`/static/${item.name}.jpg`"
                height="100"
                width="70"
                class="my-2 rounded-lg"
                contain
              ></v-img>
            </td>
            <td>
              <v-col class="d-flex" cols="12" sm="6">
                <v-select
                  v-model="item.quantity"
                  :items="quantities"
                  filled
                  dense
                  :disabled="item.quantity > products.stock"
                  v-if="!item.showInput"
                  @change="changeQuantity(item, index)"
                ></v-select>
                <div v-else class="d-flex flex-row">
                  <v-btn
                    class="mx-2"
                    fab
                    dark
                    x-small
                    color="red"
                    :disabled="item.quantity == 1"
                  >
                    <v-icon dark @click="updateQuantity(item, -1)">
                      mdi-minus
                    </v-icon>
                  </v-btn>

                  <v-text-field
                    v-model="item.quantity"
                    type="number"
                    label="Enter Quantity"
                    required
                    v-on:blur="checkEmpty(item)"
                    @change="changeQuantity(item, index)"
                    @wheel="$event.target.blur()"
                  ></v-text-field>

                  <v-btn class="mx-2" fab dark x-small color="green">
                    <v-icon dark @click="updateQuantity(item, 1)">
                      mdi-plus
                    </v-icon>
                  </v-btn>
                </div>
              </v-col>
            </td>
            <td>
              <v-btn
                small
                depressed
                color="primary"
                class="mr-5"
                rounded
                @click="viewItem(item)"
              >
                View
              </v-btn>
              <v-btn
                small
                depressed
                color="orange"
                rounded
                @click="removeItem(item)"
              >
                Remove From Cart
              </v-btn>
            </td>
          </tr>
        </tbody>
      </template>
    </v-simple-table>

    <v-card
      class="mt-8 d-flex flex-column align-center"
      color="light-blue lighten-4"
      v-if="!cartItems.length"
    >
      <v-card-title align-center> Empty Cart !</v-card-title>
      <v-spacer></v-spacer>
      <v-card-subtitle
        ><v-btn color="yellow" @click="$router.push('/')"
          >Buy Products</v-btn
        ></v-card-subtitle
      >
    </v-card>

    <div v-else>
      <v-card class="mt-8 d-flex flex-row" color="grey">
        <div>
          <v-card-title>
            Total Amount: Rs. ${{ getAmount(amount) }}
          </v-card-title>
        </div>
        <v-spacer></v-spacer>
        <v-card-subtitle
          ><v-btn color="red" @click="emptyCart"
            >Remove All Items</v-btn
          ></v-card-subtitle
        >
      </v-card>
      <v-card>
        <v-card-title width="100" class="mx-auto">
          <v-btn
            color="green"
            class="my-8 mx-auto align-self-center"
            @click="$router.push('/')"
            ><v-icon color="white darken-2 ml-5 mr-2"> mdi-shopping </v-icon>
            Continue Shopping</v-btn
          >
        </v-card-title>
      </v-card>
    </div>
    <cartViewModal
      v-if="viewModal"
      :item="selectedItem"
      @closed="viewModal = false"
    ></cartViewModal>
  </div>
</template>

<script>
import { mapGetters, mapActions, mapMutations, mapState } from "vuex";

export default {
  name: "cartVue",
  data() {
    return {
      quantities: [1, 2, 3, "more"],
      selectedItem: [],
      viewModal: false,
      //cartItems: this.$store.state.cartItems
    };
  },
  computed: {
    ...mapState({ products: "allProducts", cartItems: "cartItems" }),
    ...mapGetters({
      amount: "GET_TOTAL_AMOUNT",
    }),
  },
  components: {
    cartViewModal: () => import("../modals/cartViewModal.vue"),
  },
  methods: {
    ...mapActions({ deleteItem: "DELETE_ITEM" }),
    ...mapMutations({
      emptyTheCart: "EMPTY_CART",
      decrement: "DEC_QUANTITY",
      increment: "INC_QUANTITY",
    }),
    getAmount(amt) {
      return amt.toLocaleString("en-US");
    },
    removeItem(item) {
      this.$swal
        .fire({
          title: "Are you sure to delete?",
          showCancelButton: true,
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33",
          confirmButtonText: "Yes",
        })
        .then((result) => {
          if (result.isConfirmed) {
            this.$swal
              .fire({
                icon: "success",
                title: "Item Deleted",
                showConfirmButton: false,
                timer: 1500,
              })
              .then(() => {
                this.deleteItem(item);
              });
          }
        });
    },

    emptyCart() {
      this.$swal
        .fire({
          title: "Want to empty the Cart?",
          showCancelButton: true,
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33",
          confirmButtonText: "Yes",
        })
        .then((result) => {
          if (result.isConfirmed) {
            this.$swal
              .fire({
                icon: "success",
                title: "Items Deleted",
                showConfirmButton: false,
                timer: 1500,
              })
              .then(() => {
                this.emptyTheCart();
                // this.cartItems = [];
              });
          }
        });
    },
    changeQuantity(item, index) {
      if (item.quantity == "more") {
        item.showInput = true;
        item.quantity == 1;
      } else {
        this.cartItems[index].quantity = item.quantity;
      }
      if (item.quantity > item.stock) {
        this.$swal({
          icon: "error",
          title: "Quantity going out of Stock !",
        }).then(() => {
          item.quantity = 1;
        });
      }
    },
    updateQuantity(item, value) {
      if (value == -1) {
        if (item.quantity == 1) return;
        this.decrement(item);
      } else {
        this.increment(item);
      }
      if (item.quantity > item.stock) {
        this.$swal({
          icon: "error",
          title: "Quantity going out of Stock !",
        }).then(() => {
          item.quantity = 1;
        });
      }
    },
    checkEmpty(item) {
      if (item.quantity == "" || item.quantity == 0) {
        item.quantity = 1;
      }
    },
    viewItem(item) {
      this.selectedItem = item;
      this.viewModal = true;
    },
  },
};
</script>
