<template>
  <v-stepper v-model="e1">
      <v-stepper-header>
        <v-stepper-step :complete="e1 > 1" step="1">Cart</v-stepper-step>

        <v-divider></v-divider>

        <v-stepper-step :complete="e1 > 2" step="2">Shipping Details</v-stepper-step>

        <v-divider></v-divider>

        <v-stepper-step :complete="e1 > 3" step="3">Payment</v-stepper-step>

        <v-divider></v-divider>

          <v-stepper-step :complete="e1 > 3" step="4">Receipt</v-stepper-step>
      </v-stepper-header>

      <v-stepper-items>

        <v-stepper-content step="1">
          <!-- Cart Content -->
          <CartContent />

          <v-container class="centered">
            <v-btn flat color="secondary" @click="backToShopping">Continue Shopping</v-btn>
            <v-btn
              color="primary"
              @click="e1 = 2"
            >
              Purchase
            </v-btn>
          </v-container>



        </v-stepper-content>

        <v-stepper-content step="2">
          <!-- Order Summary and Shipping information -->
          <OrderSummary />
          <OrderDetails />

          <v-btn flat @click="e1 = 1">Back</v-btn>
          <v-btn
            color="primary"
            @click="e1 = 3"
          >
            Continue
          </v-btn>

        </v-stepper-content>

        <v-stepper-content step="3">
          <!-- Payment Information -->
          <OrderSummary />
          <OrderPayment />


          <v-btn flat @click="e1 = 2">Back</v-btn>
          <v-btn
            color="primary"
            @click="e1 = 4"
          >
            Continue
          </v-btn>


        </v-stepper-content>

        <v-stepper-content step="4">
          <!-- Payment Receipt -->
          <OrderReceipt />

          <v-btn flat @click="e1 = 3">Back</v-btn>

          <v-btn
            color="primary"
            @click="e1 = 1"
          >
            Continue
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

export default {
  name: 'Cart',
  components: {
    CartContent,
    OrderSummary,
    OrderDetails,
    OrderPayment,
    OrderReceipt

  },
  data() {
    return {
      e1: 0
    }
  },

  mounted() {
      this.$store.dispatch('shop/fetchCartProducts')
  },

  methods: {
    backToShopping() {
      this.$router.push('/')
    },

  }

}
</script>

<style lang="css" scoped>
</style>
