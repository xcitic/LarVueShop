
<template>
        <v-hover>
            <v-card slot-scope="{ hover }" :class="`elevation-${hover ? 10 : 2}`" class="mx-auto">
              <router-link :to="{ name: 'Product', params: { id: product.id} }">
                <v-img src="https://store.storeimages.cdn-apple.com/4982/as-images.apple.com/is/image/AppleInc/aos/published/images/m/ac/macbook/select/macbook-select-space-gray-201706_GEO_US?wid=892&hei=820&&qlt=80&.v=1539399807811" height="200px">
                </v-img>
              </router-link>

                <v-card-text class="pt-4" style="position: relative;" >
                    <v-btn @click="addToCart" absolute color="orange" class="white--text" fab large right top>
                      <v-tooltip bottom>
                      <template v-slot:activator="{ on }">
                        <v-icon v-on="on">mdi-cart</v-icon>
                      </template>
                    <span>Add to cart </span>
                    </v-tooltip>
                    </v-btn>
                </v-card-text>


                <v-card-title primary-title>
                    <div>
                        <h3 class="headline mb-0">{{ product.title.substring(0,60) + '...' }}</h3>
                        <div></div>
                    </div>
                </v-card-title>

                <v-card-text class="text-center">
                    <h3>  </h3>

                </v-card-text>



                <v-card-actions>
                    <div class="m-auto text-center">
                        <v-rating readonly v-model="product.rating"></v-rating>
                    </div>
                </v-card-actions>

                <v-card-actions>

                    <router-link style="textDecoration: none" :to="{ name: 'Product', params: {id: product.id} }">
                      <v-btn flat color="primary" class="mr-auto">
                          <v-icon class="mr-1">mdi-eye</v-icon>
                          View Product
                      </v-btn>
                    </router-link>
                    <div class="ml-auto">
                      <small>{{product.likes}} </small>
                      <v-btn flat icon :color="liked ? 'red' : 'grey'">

                          <v-icon @click="like">mdi-cards-heart</v-icon>
                      </v-btn>
                    </div>


                </v-card-actions>

            </v-card>
        </v-hover>

</template>

<script>
export default {
  name: 'Product',
  props: {
    product: Object,
  },

  data() {
    return {
      liked: false,
      inCart: false,
    }
  },

  methods: {
    like() {
      this.liked = !this.liked
      if (this.liked) {
        this.$store.dispatch('products/like', this.product.id)
      } else {
        this.$store.dispatch('products/dislike', this.product.id)
      }
    },

    addToCart() {
      this.$store.dispatch('products/addToCart', this.product.id)
    },


  }
}
</script>

<style lang="css" scoped>
</style>
