<template>
  <div>
    <CarouselFull />
    <v-container fluid>
      <v-layout row wrap>
        <v-flex shrink pa-3 sm3 v-for="product in products" :key="product.id" >
            <ProductCard :product="product"  />
          </v-flex>
      </v-layout>
    </v-container>
  </div>
</template>

<script>
import ProductCard from '@/components/ProductCard'
import CarouselFull from '@/components/CarouselFull'
import { mapState } from 'vuex'
export default {
  name: 'Landing',
  components: {
    ProductCard,
    CarouselFull
  },
  computed:
    mapState({
      products: state => state.products.products
    })
  ,

  mounted() {
    this.$store.dispatch('products/getProducts')
  }
}
</script>

<style lang="css" scoped>
</style>
