<template>
  <div>
    <v-card>
      <v-app-bar color="orange" light class="text-align-center mb-5"
        ><v-toolbar-title light class="d-flex"
          ><v-img width="80" src="/static/shopping.png" class="mr-2"></v-img>
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

    <div v-else id="footer">
      <div id="couponDetails">
        <v-card color="yellow lighten-4">
          <div class="d-flex align-center justify-center">
            <v-form ref="couponForm" width="20" class="px-10 mx-3 mb-2">
              <v-text-field
                v-model="selectedCoupon.code"
                label="Coupon Code:"
                width="20"
                :rules="[(v) => !!v || 'Enter the Coupon code to check']"
                @change="showCoupon.status = false"
                required
              ></v-text-field>

              <v-btn
                color="orange"
                class="mr-4"
                x-small
                @click="verifyCoupon(selectedCoupon.code)"
              >
                Check
              </v-btn>
              <v-btn x-small color="red" class="mr-4" @click="resetCoupon()">
                Remove
              </v-btn>
            </v-form>
            <cartViewModal
              v-if="viewModal"
              :item="selectedItem"
              width="200"
              @closed="viewModal = false"
            ></cartViewModal>
            <couponModal @closeModal="closeModal"></couponModal>
          </div>

          <v-card v-show="showCoupon.status" dark color="deep-purple accent-4">
            <v-card-title
              ><v-icon>mdi-voucher</v-icon>
              {{ showCoupon.message }}.</v-card-title
            >
            <v-card-text color="green"
              >Discount: {{ discount.rate }}
              {{
                discount.type == "percent"
                  ? discount.extra
                    ? "/-"
                    : "%"
                  : "/-"
              }}</v-card-text
            >
            <v-card-subtitle
              >Total Amount: {{ formatAmount(amount) }}</v-card-subtitle
            >
          </v-card>
        </v-card>
      </div>
      <v-card class="mt-8 d-flex flex-row" color="grey">
        <div>
          <v-card-title> Total Amount to be Paid: Rs. ${{ amt }} </v-card-title>
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
      showCoupon: { status: false, message: "" },
      viewModal: false,
      discount: {},
      selectedCoupon: {},
      amt: 0,
      validCoupon: false,
    };
  },
  computed: {
    ...mapState({ products: "allProducts", cartItems: "cartItems" }),
    ...mapGetters({
      amount: "GET_TOTAL_AMOUNT",
      allCoupons: "GET_ALL_COUPONS",
    }),
  },
  mounted() {
    this.amt = this.amount;
    console.log("total amount: ", this.amount);
  },
  components: {
    cartViewModal: () => import("../modals/cartViewModal.vue"),
    couponModal: () => import("../modals/couponModal.vue"),
  },
  methods: {
    ...mapActions({ deleteItem: "DELETE_ITEM" }),
    ...mapMutations({
      emptyTheCart: "EMPTY_CART",
      decrement: "DEC_QUANTITY",
      increment: "INC_QUANTITY",
    }),
    formatAmount(amt) {
      return amt.toLocaleString("en-US");
    },
    getAmount() {
      this.amt = this.amount;
      if (this.discount.value && this.showCoupon.status) {
        this.amt = this.amt - this.discount.value;
      }
      console.log("getAmount");
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
      this.getAmount();
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
    verifyCoupon(code) {
      let found = {};
      alert("start",code);
      if (this.$refs.couponForm.validate()) {
        Object.assign(found, {});
        for (let coupon of this.allCoupons) {
          Object.assign(found, {});
          if (coupon.code === code) {
            Object.assign(found, coupon);
            console.log(coupon);
            break;
          }
        }
        
        if (found.code) {
          this.showCoupon.message = `Coupon attached successfully.`;
          this.validCoupon = true;
          this.showCoupon.status = true;
          if (found.type == "fixed") {
            if (found.extra == "minAmount") {
              if (this.amount < found.minAmount) {
                alert(`Minimun ${found.minAmount} is required !`);
                this.showCoupon.message = `Minimum amount of Rs. ${found.minAmount} is required to grab this.`;
                this.discount.value = 0;
              } else {
                this.discount.value = found.value;
              }
            } else {
              this.discount.value = found.value;
            }
          } else {
            console.log(found.type);
            if (found.extra == "minAmount") {
              if (this.amount < found.minAmount) {
                this.showCoupon.message = `Minimum amount of Rs. ${found.minAmount} is required to grab this.`;
                this.discount.value = 0;
              } else {
                this.discount.value =
                  this.amount - (this.amount / 100.0) * found.value;
              }
            } else if (found.extra == "maxAmount") {
              if ((this.amount / 100.0) * found.value > found.maxAmount) {
                this.discount.value = found.value;
                this.showCoupon.message = `You can get maximun Rs. ${found.value} of discount.`;
                this.discount.extra = "maxAmount";
              } else {
                this.discount.value =
                  this.amount - (this.amount / 100.0) * found.value;
              }
            } else {
              this.discount.value =
                this.amount - (this.amount / 100.0) * found.value;
            }
            // this.discount.value =
            //   this.amount - (this.amount / 100.0) * found.value;
          }
          this.discount.type = found.type;
          this.discount.rate = found.value;
          console.log(this.discount);
          this.getAmount();
        }
        else { alert("Nonono"); this.resetCoupon(); this.selectedCoupon.code = code; }

      } else {
        this.resetCoupon();
        this.selectedCoupon.code = code;
      }
    },
    closeModal(coupon) {
      if (coupon.code) {
        // console.log(coupon);
        this.selectedCoupon = coupon;
        // console.log(this.selectedCoupon);
      }
    },
    resetCoupon() {
      this.showCoupon.status = false;
      this.discount = {};
      this.selectedCoupon = {};
      this.getAmount();
    },
  },
};
</script>
