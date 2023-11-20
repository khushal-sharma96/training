import Vue from 'vue'
import Vuex from 'vuex'
import VuexPersist from 'vuex-persist';
Vue.use(Vuex)
const vuexLocalStorage = new VuexPersist({
  key: 'vuex', // The key to store the state on in the storage provider.
  storage: window.localStorage,
  modules: ["index"]
})
let products = [
  { id: 1, name: "Iphone 14", price: 120000, stock: 20 },
  { id: 2, name: "Hp Laptop", price: 60000, stock: 1 },
  { id: 3, name: "Sony Headphones", price: 3000, stock: 0 },
  { id: 4, name: "Sony LED Tv", price: 32000, stock: 8 },
  { id: 5, name: "CP Plus dome Camera", price: 3000, stock: 2 },
  { id: 6, name: "Samsung Refrigerator", price: 30000, stock: 15 },
  { id: 7, name: "Home Theatre", price: 5000, stock: 20 },
  { id: 8, name: "Samsung Smart Watch", price: 10000, stock: 3 },
];
let coupons = [
  { code: "36A9Z6Y1", name: "DIWALI_OFFER", type: "percent", value: 50 },
  { code: "10K35S16", name: "FIRST_ORDER", type: "fixed", value: 200 },
  { code: "70K5VS16", name: "FESTI_COUNT", type: "fixed", extra: "minAmount", value: 1000, minAmount: 11000 },
  { code: "29K5VS50", name: "MONTH_END", type: "percent", extra: "maxAmount", value: 200, maxAmount: 10000 },
];
const defaultState = () => {
  return {
    count: 0,
    cartItems: [],
    allProducts: products,
    allCoupons: coupons,
    isLogin:false
  }
}

export default new Vuex.Store({
  state: defaultState(),
  getters: {
    GET_COUNT(state) {
      return state.count;
    },
    GET_ALL_CART_ITEMS(state) {
      return state.cartItems;
    },
    GET_COUNT_ITEMS(state) {
      return (state.cartItems).length;
    },
    GET_TOTAL_AMOUNT(state) {
      let amount = 0;
      for (let item of state.cartItems) {
        amount += (item.price * item.quantity)
      }
      return amount;
    },
    GET_LOGIN(state) {
      return state.isLogin
    },
    GET_ALL_PRODUCTS(state) {
      return state.allProducts;
    },
    GET_ALL_COUPONS(state) {
      return state.allCoupons;
    }
  },
  mutations: {
    SET_COUNT(state, payload) {
      state.count += payload.update;
    },
    DEC_QUANTITY(state, payload) {
      let index = state.cartItems.indexOf(payload);
      state.cartItems[index].quantity--;
    },
    INC_QUANTITY(state, payload) {
      let index = state.cartItems.indexOf(payload);
      state.cartItems[index].quantity++;
    },
    PUSH_ITEM(state, payload) {
      let itemIndex = -1;
      //for (let item of state.cartItems) {
      for (let i = 0; i < state.cartItems.length; i++) {
        if (state.cartItems[i].id == payload.id) {
          itemIndex = i;
          break;
        }
      }
      if (itemIndex === -1) {
        state.cartItems.push(payload);
      } else {
        state.cartItems[itemIndex].quantity++;
      }

    },
    POP_ITEM(state, payload) {
      const index = state.cartItems.indexOf(payload);
      state.cartItems.splice(index, 1);
    },
    LOGIN(state,payload) {
      state.isLogin = payload.value;
    },
    EMPTY_CART(state) {
      // state.cartItems = [];
      // Object.assign(state.cartItems, []);
      Object.assign(state, defaultState());
    }
  },
  actions: {
    UPDATE_COUNT(context, payload) {
      context.commit('SET_COUNT', { update: payload.update });
    },
    ADD_ITEM(context, payload) {
      context.commit('PUSH_ITEM', payload);
    },
    DELETE_ITEM(context, payload) {
      context.commit('POP_ITEM', payload);
    },
    LOGIN_ACTION(context, payload) {
      context.commit('LOGIN',payload);
    }
  },
  modules: {
  },
  plugins: [vuexLocalStorage.plugin]
})
