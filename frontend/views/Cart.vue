<template>
  <v-stepper v-model="stepper">
      <v-stepper-header>
        <v-stepper-step :complete="stepper > 1" step="1">Cart</v-stepper-step>

        <v-divider></v-divider>

        <v-stepper-step :complete="stepper > 2" step="2">Shipping & Payment</v-stepper-step>

        <v-divider></v-divider>

          <v-stepper-step :complete="stepper > 2" step="3">Receipt</v-stepper-step>
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
          <!-- Shipping Information & Payment  -->
          <OrderSummary />
          <!-- <OrderPayment /> -->
          <div class="col-md-12">

            <div class="row">

            <div class="col-md-6">
              <div class="card ma-2">
                <h2 class="text-center my-2">Shipping Details</h2>
                  <OrderDetails :user="user" :complete="complete" />
              </div>
            </div>

            <div class="col-md-6">
              <div class="card ma-2">
                <h2 class="text-center my-2">Payment Details</h2>
                <Card class="stripe-card elevation-1 pa-2"
                  :class='{ complete }'
                  stripe='pk_test_c41Zq4wUeOtNpp73DYLHjFAS'
                  :options='stripeOptions'
                  @change='complete = $event.complete'
                />
              </div>

            </div>
          </div>
        </div>

          <v-container>
            <div class="col-md-12">

            </div>

          </v-container>


          <v-btn flat @click="stepper = 1">Back</v-btn>

          <div class="col-md-12">
            <div class="col-md-6 offset-md-6">
              <v-btn
                color="primary"
                :disabled="!complete"
                @click="createPayment()"
                class="text-center"
              >
                Pay Now
              </v-btn>
            </div>
          </div>



        </v-stepper-content>

        <v-stepper-content step="3">
          <!-- Payment Receipt -->
          <OrderReceipt />

          <v-btn flat @click="stepper = 2">Back</v-btn>

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


    // Replaced by createPayment which does both.
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



    validate() {
     if (this.$refs.form.validate()) {
       return true
     }
    },

    createPayment() {
      // Validate Shipping details before creating a new Promise.
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
        })
      })
      .then((response) => {
        if (response === 'success') {
          this.stepper = 3
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
.card-stripe {
  box-sizing: border-box;

  height: 40px;

  padding: 10px 12px;

  border: 1px solid transparent;
  border-radius: 4px;
  background-color: white;

  box-shadow: 0 1px 3px 0 #e6ebf1;
  -webkit-transition: box-shadow 150ms ease;
  transition: box-shadow 150ms ease;
}

.card-stripe--focus {
  box-shadow: 0 1px 3px 0 #cfd7df;
}

.card-stripe--invalid {
  border-color: #fa755a;
}

.card-stripe--webkit-autofill {
  background-color: #fefde5 !important;
}
</style>
