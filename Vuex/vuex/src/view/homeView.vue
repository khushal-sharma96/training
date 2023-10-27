<template>
  <v-container class="my-5 px-3">
    <v-row>
      <v-card
        width="250"
        class="mx-5 my-3"
        v-for="(item) in allItems"
        :key="item.id"
      >
        <v-img :src="`/static/${item.name}.jpg`" height="200px" contain></v-img>
        <v-card-title>{{ item.name }}</v-card-title>

        <v-card-actions>
          <v-btn color="orange lighten-2" text
            >Rs. ${{ formatPrice(item.price) }}
          </v-btn>
          <v-spacer></v-spacer>
          <v-btn color="green" text @click="addItem(item)">Add To Cart</v-btn>
        </v-card-actions>
      </v-card>
    </v-row>
  </v-container>
</template>

<script>
import { mapGetters, mapActions } from "vuex";

export default {
  name: "homeView",
  computed: {
    ...mapGetters({
      countVal: "GET_COUNT",
    }),
  },
  data: () => ({
    allItems: [
      { id: 1, name: "Iphone 14", price: 120000 },
      { id: 2, name: "Hp Laptop", price: 60000 },
      { id: 3, name: "Sony Headphones", price: 3000 },
      { id: 4, name: "Sony LED Tv", price: 32000 },
      { id: 5, name: "CP Plus dome Camera", price: 3000 },
      { id: 6, name: "Samsung Refrigerator", price: 30000 },
      { id: 7, name: "Home Theatre", price: 5000 },
      { id: 8, name: "Samsung Smart Watch", price: 10000 },
    ],
  }),

  methods: {
    ...mapActions({ addToCart: "ADD_ITEM" }),
    formatPrice(value) {
      return value.toFixed(2);
    },
    addItem(item) {
      item.quantity = 1;
      item.showInput = false;
      this.addToCart(item);
      this.$swal({
        position: "top-end",
        icon: "success",
        title: "Item Added",
        showConfirmButton: false,
        timer: 1500,
      });
    },
  },
};
</script>
