<template>
  <v-content wrap>
    <v-container grid-list-xl>
      <v-layout wrap>
        <!-- Picture Carousel -->
        <v-flex xs12 md6 mx-auto style="max-width:500px">
          <v-card mb-4 elevation12>
            <v-carousel>
              <v-carousel-item
                src="https://cdn.vuetifyjs.com/images/carousel/sky.jpg"/>
            </v-carousel>
          </v-card>
        </v-flex><!-- End Picture Carousel -->

        <v-flex xs12 md6>
          <h2 class="display-1 mb-3 font-weight-bold">{{product.title}}</h2>
          <div class="mb-5">
            <span class="display-1 grey--text text-darken-2">${{product.price}}</span>
          </div>
          <div class="container mb-5 grid-list-xl pa-0">
              <div class="layout justify-center wrap">
                <!-- Product Options -->
                <v-flex xs12 sm6>
                  <v-select
                    :items="product_options"
                    v-model="selected_options"
                    label="Option"
                    disabled
                  ></v-select>
                </v-flex>
                <!--./End Product Options -->

                <!-- Quantity Select -->
                <v-flex xs12 sm6>
                  <v-text-field
                    label="Quantity"
                    value=""
                    type="number"
                    v-model="quantity"
                  >
                  </v-text-field>
                </v-flex>
                <!--./End Quantity Select -->

                <!-- Add to Cart -->
                <v-flex xs12>
                  <v-btn color="primary" px-5 mx-0 block large @click="addToCart">
                    <span>
                      <span>Add to Cart</span>
                      <v-icon>mdi-cart-plus</v-icon>
                    </span>
                  </v-btn>
                </v-flex>
                <!--./End Add to Cart -->

                <v-divider my-5/>

                <!-- Product Description -->
                <div class="description my-4" >

                  <v-card>
                    <v-card-title primary-title>
                      Product Description
                    </v-card-title>
                    <v-card-text>
                      <p>{{product.description}}</p>
                    </v-card-text>
                  </v-card>
                </div>





              </div>
          </div>
        </v-flex>

      </v-layout>
    </v-container>
  </v-content>

</template>

<script>
import { mapState } from 'vuex'

export default {
  name: 'Product',

  data() {
    return {
      loading: false,
      quantity: 1,
      product_options: [
        'blue',
        'red',
        'green'
      ],
      selected_options: [],
    }
  },

  computed: mapState({
    product: state => state.products.product
  }),

  mounted() {
    this.$store.dispatch('products/getOneProduct', this.$route.params.id)
  },

  methods: {
    addToCart() {
      this.loading = true

      let payload = {
        product_id: this.product.id,
        quantity: this.quantity
      }

      this.$store.dispatch('shop/addToCart', payload)
    }
  }
}
</script>

<style lang="css" scoped>
</style>
