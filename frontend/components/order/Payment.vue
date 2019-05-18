<template>
  <div>

    <div>
      
    </div>

    <div class="payment_option">
      <Stripe/>
      <Paypal />
    </div>

  </div>


</template>

<script>
import Summary from '@/components/order/Summary'
import Stripe from '@/components/payment/Stripe'
import Paypal from '@/components/payment/Paypal'

export default {
  name: 'OrderPayment',
  components: {
    Summary,
    Stripe,
    Paypal
  }
}
</script>

<style lang="css" scoped>
</style>
