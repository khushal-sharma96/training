import Vue from 'vue'
import Vuex from 'vuex'
import VuexPersist from 'vuex-persist';
Vue.use(Vuex)
const vuexLocalStorage = new VuexPersist({
  key: 'vuex', // The key to store the state on in the storage provider.
  storage: window.localStorage,
})

export default new Vuex.Store({
  state: {
    count: 0,
    cartItems: [],
  },
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
        payload.quantity = 1;
        state.cartItems.push(payload);
      } else {
        state.cartItems[itemIndex].quantity += 1;
      }

    },
    POP_ITEM(state, payload) {
      const index = state.cartItems.indexOf(payload);
      state.cartItems.splice(index, 1);
    },
    EMPTY_CART(state) {
      state.cartItems = [];
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
    }
  },
  modules: {
  },
  plugins: [vuexLocalStorage.plugin]
})
