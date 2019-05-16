<template>
  <div class="container">
    <h1>Hello {{product.title}}</h1>
  </div>

</template>

<script>
import { mapState } from 'vuex'

export default {
  name: 'Product',

  computed: mapState({
    product: state => state.products.product
  }),

  mounted() {
    this.$store.dispatch('products/getOneProduct', this.$route.params.id)
  }
}
</script>

<style lang="css" scoped>
</style>
