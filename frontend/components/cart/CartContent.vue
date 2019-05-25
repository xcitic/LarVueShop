<template>

<v-content>
  <table class="table">
    <thead>
      <tr>
        <th>Picture</th>
        <th>Title</th>
        <th>Price</th>
        <th>Quantity</th>
        <th>Total</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      <tr v-for="product in products" v-model="products">
        <td>{{product.image}}</td>
        <td>{{product.title}}</td>
        <td>{{product.price}}</td>
        <td>{{product.quantity}}</td>
        <td>{{product.quantity * product.price}}</td>
        <td>
          <v-btn color="warning" prop="id" @click="removeFromCart(product.id)">Delete</v-btn>
        </td>
      </tr>
    </tbody>

  </table>

</v-content>



</template>

<script>
import { mapState } from 'vuex'

export default {
  name: 'CartContent',

  props: {
    products: Array
  },

  methods: {
    removeFromCart(item) {
      this.$store.dispatch('shop/removeFromCart', item)
      .then(
        this.$store.dispatch('shop/fetchCartProducts')
      )
    }
  }


}
</script>

<style lang="css" scoped>
</style>
