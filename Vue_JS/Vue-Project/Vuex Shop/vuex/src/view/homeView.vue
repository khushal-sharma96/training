<template>
  <v-container class="my-5 px-3">
    <v-row>
      <v-card
        width="250"
        class="mx-5 my-3"
        v-for="item in allItems"
        :key="item.id"
        elevation="10"
      >
        <v-img :src="`/static/${item.name}.jpg`" height="200px" contain></v-img>
        <v-card-title>{{ item.name }}</v-card-title>
        <v-card-subtitle v-if="item.stock <= 10 && item.stock != 0">
          Only {{ item.stock }} left
        </v-card-subtitle>
        <v-card-subtitle v-if="item.stock==0" style="color: red">
          Out of Stock
        </v-card-subtitle>

        <v-card-actions>
          <v-btn color="orange lighten-2" text
            >Rs. ${{ formatPrice(item.price) }}
          </v-btn>
          <v-spacer></v-spacer>
          <v-btn
            color="green"
            small
            @click="addItem(item)"
            v-if="item.stock > 0 "
            >Add To Cart <v-icon small color="" text> mdi-cart </v-icon>
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-row>
  </v-container>
</template>

<script>
import { mapGetters, mapActions } from "vuex";

export default {
  name: "homeView",
  data() {
    return {
      userCartId: 314,
      selectedItem:{}
    }
  },
  mounted() {
    // alert("stop")
  },
  computed: {
    ...mapGetters({
      countVal: "GET_COUNT",
      allItems: "GET_ALL_PRODUCTS",
      isLogin:"GET_LOGIN"
    }),
  },
  methods: {
    ...mapActions({ addToCart: "ADD_ITEM" }),
    formatPrice(value) {
      return value.toFixed(2);
    },
    addItem(item) {
      if (!this.isLogin) {
        this.$router.push('/login')
      }
      else {
        Object.assign(this.selectedItem, item);
        this.selectedItem.quantity = 1;
        this.selectedItem.showInput = false;
        this.addToCart(this.selectedItem);
        delete this.selectedItem.stock;
        console.log(this.selectedItem)
        this.$swal({
          position: "top-end",
          icon: "success",
          title: "Item Added",
          showConfirmButton: false,
          timer: 1500,
          toast:true
        });
      }
    },
  },
};
</script>
