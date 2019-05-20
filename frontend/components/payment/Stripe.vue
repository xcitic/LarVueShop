<template>

  <div class="col-md-12">
    <div class="col-md-4 offset-md-4">
      <div ref="card">
      </div>
    </div>
  </div>


</template>


<script>
var stripe = Stripe('pk_test_TYooMQauvdEDq54NiTphI7jx')
var elements = stripe.elements()
let card = undefined

export default {
  name: 'Stripe',
  mounted() {
    card = elements.create('card');
    card.mount(this.$refs.card);
  }
}
</script>

<style lang="css" scoped>
.StripeElement {
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

.StripeElement--focus {
  box-shadow: 0 1px 3px 0 #cfd7df;
}

.StripeElement--invalid {
  border-color: #fa755a;
}

.StripeElement--webkit-autofill {
  background-color: #fefde5 !important;
}
</style>
