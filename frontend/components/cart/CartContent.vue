<template>

<v-content>
  <el-table :data="products" style="width: 100%">
    <el-table-column prop="title" label="Product" width="180"/>
    <el-table-column prop="price" label="Price" width="180"/>
    <el-table-column prop="quantity" label="Qty" width="180" />
  </el-table>
</v-content>



</template>

<script>
import { mapGetters } from 'vuex'

export default {
  name: 'CartContent',

  computed: {
    products: () => store.getters['shop/products'],
    productTotal: () => store.getters['shop/productTotal'],
    orderTotal: () => store.getters['shop/orderTotal'],
  }

  // mapGetters({
  //   products,
  //
  // })

  // mapState({
  //   products: state => state.shop.cart_products
  // }),


}
</script>

<style lang="css" scoped>
</style>
