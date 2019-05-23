<template>
  <v-stepper v-model="stepper">
      <v-stepper-header>
        <v-stepper-step :complete="stepper > 1" step="1">Cart</v-stepper-step>

        <v-divider></v-divider>

        <v-stepper-step :complete="stepper > 2" step="2">Shipping Details</v-stepper-step>

        <v-divider></v-divider>

        <v-stepper-step :complete="stepper > 3" step="3">Payment</v-stepper-step>

        <v-divider></v-divider>

          <v-stepper-step :complete="stepper > 3" step="4">Receipt</v-stepper-step>
      </v-stepper-header>

      <v-stepper-items>

        <v-stepper-content step="1">
          <!-- Cart Content -->
          <CartContent :products="products" />

          <v-container class="centered">
            <v-btn flat class="mx-4" color="secondary" @click="backToShopping">Back To Shop</v-btn>
            <v-btn
              color="primary"
              @click="stepper = 2"
            >
              Checkout
            </v-btn>
          </v-container>



        </v-stepper-content>

        <v-stepper-content step="2">
          <!-- Order Summary and Shipping information -->
          <OrderSummary />
          <OrderDetails :user="user" />

          <v-btn flat @click="stepper = 1">Back</v-btn>
          <v-btn
            color="primary"
            @click="createOrder()"
          >
            Continue
          </v-btn>

        </v-stepper-content>

        <v-stepper-content step="3">
          <!-- Payment Information -->
          <OrderSummary />
          <!-- <OrderPayment /> -->

          <h1>Give us your payment details: </h1>
          <Card class="stripe-card"
            :class='{ complete }'
            stripe='pk_test_TYooMQauvdEDq54NiTphI7jx'
            :options='stripeOptions'
            @change='complete = $event.complete'
          />
          <button class="pay-with-stripe" @click="createPayment" :disabled='!complete'>Pay with credit card </button>

          <v-btn flat @click="stepper = 2">Back</v-btn>

          <div class="col-md-12">
            <div class="col-md-6 offset-md-6">
              <v-btn
                color="primary"
                @click="createPayment()"
                class="text-center"
              >
                Pay Now
              </v-btn>
            </div>
          </div>



        </v-stepper-content>

        <v-stepper-content step="4">
          <!-- Payment Receipt -->
          <OrderReceipt />

          <v-btn flat @click="stepper = 3">Back</v-btn>

          <v-btn
            color="primary"
            @click="goToDashboard()"
          >
            Go To Dashboard
          </v-btn>

        </v-stepper-content>
      </v-stepper-items>
    </v-stepper>

</template>

<script>
import { mapState } from 'vuex'
import CartContent from '@/components/cart/CartContent'
import OrderSummary from '@/components/order/Summary'
import OrderDetails from '@/components/order/Details'
import OrderPayment from '@/components/order/Payment'
import OrderReceipt from '@/components/order/Receipt'
import { Card, createToken } from 'vue-stripe-elements-plus'

export default {
  name: 'Cart',
  components: {
    CartContent,
    OrderSummary,
    OrderDetails,
    OrderPayment,
    OrderReceipt,
    Card

  },
  data() {
    return {
      stepper: 0,
      complete: false,
      stripeOptions: {

      }
    }
  },

  computed:
    mapState({
      products: state => state.shop.cart_products,
      user: state => state.auth.user,
    }),

  mounted() {
      this.fetchProducts()
  },

  methods: {
    fetchProducts() {
      this.$store.dispatch('shop/fetchCartProducts')
    },
    backToShopping() {
      this.$router.push('/')
    },

    createOrder() {
        let payload = {
          name: this.user.name,
          email: this.user.email,
          country: this.user.country,
          address: this.user.address,
          zip: this.user.zip,
          phone: this.user.phone
        }
      // Run validation before dispatching
      this.$store.dispatch('shop/createOrder', payload)
      // Catch the promise resolve / rejection
      .then((response) => {
        if (response === 'success') (
          this.stepper = 3
        )
      })
    },

    createPayment() {
      return new Promise((resolve,reject) => {
        createToken().then( data => {
          let payload = {
            name: this.user.name,
            email: this.user.email,
            country: this.user.country,
            address: this.user.address,
            zip: this.user.zip,
            phone: this.user.phone,
            token: data.token.id
          }
          this.$store.dispatch('shop/createPayment', payload)
        });
      })
      .then((response) => {
        if (response === 'success') {
          this.stepper = 4
        }
      })
    },

    goToDashboard(){
      this.$router.push('/dashboard')
    },

  }

}
</script>

<style lang="css" scoped>
</style>
