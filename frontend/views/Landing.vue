<template>
  <div>
    <CarouselFull />
    <v-container fluid>
      <v-layout row wrap>
        <v-flex shrink pa-3 sm3 v-for="product in products" :key="product.id" >
            <ProductCard :product="product"  />
          </v-flex>
          <!-- <div class="text-xs-center">
            <v-pagination
              v-model="page"
              :length="6"
            ></v-pagination>
          </div> -->

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
    }),
  data() {
    return {
      page: 1,
    }
  },

  mounted() {
    this.$store.dispatch('products/getProducts')
  }
}
</script>

<style lang="css" scoped>
</style>
