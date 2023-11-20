<template>
  <v-row justify="center">
    <v-dialog v-model="dialog" persistent scrollable max-width="300px">
      <template v-slot:activator="{ on, attrs }">
        <v-btn
          color="primary"
          dark
          small
          v-bind="attrs"
          v-on="on"
          @click="dialog = true"
        >
          Available Coupons
        </v-btn>
      </template>
      <v-card>
        <v-card-title color="text-color-red">Select Coupon</v-card-title>
        <v-divider></v-divider>
        <v-card-text>
          <v-radio-group v-model="selectedCoupon" column>
            <v-radio
              v-for="coupon of coupons"
              :key="coupon.code"
              :label="coupon.name"
              :value="coupon"
            ></v-radio>
          </v-radio-group>
        </v-card-text>
        <v-divider></v-divider>
        <v-card-actions>
          <v-btn color="red" rounded @click="closeModal(false)" small>Cancel </v-btn>
          <v-btn color="blue darken-1" rounded @click="closeModal(true)" small
>
            Apply
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </v-row>
</template>

<script>
import { mapGetters } from "vuex";
export default {
  name: "couponModal",
  data() {
    return {
      dialogm1: "",
      dialog: false,
      coupon: {},
      selectedCoupon: "",
    };
  },
  computed: {
    ...mapGetters({ coupons: "GET_ALL_COUPONS" }),
  },
  methods: {
    closeModal(value) {
      this.dialog = false;
      if (value) {
        // console.log(this.selectedCoupon)
        this.$emit("closeModal", this.selectedCoupon);
      } else {
        this.$emit("closeModal", "");
      }
    },
  },
};
</script>
