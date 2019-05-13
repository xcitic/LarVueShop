<template>
  <li class="nav-item mx-4" v-model="cart" v-if="cart.length > 0">
    <a @click="showCart">
      <span class="badge red">{{ cart.length }}</span>
      <v-icon color="white">mdi-cart</v-icon>
      Cart
    </a>
  </li>
</template>

<script>
import { mapState } from 'vuex'

export default {
  name: 'CartIcon',
  computed: mapState({
    cart: state => state.shop.cart
  }),


  mounted() {
    this.fetchCart();
  },

  methods: {
    showCart() {
      console.log('show cart');
    },
    fetchCart() {
      this.$store.dispatch('shop/fetchCart')
    }
  },

}
</script>

<style lang="css" scoped>
</style>
