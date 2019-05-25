<template>
  <v-container>
    <MyOrders :orders="orders" />
  </v-container>

</template>

<script>
import { mapState } from 'vuex'
import MyOrders from '@/components/dashboard/MyOrders'

export default {
  name: 'Dashboard',
  components: {
    MyOrders
  },

  computed:
    mapState({
      orders: state => state.dashboard.orders
    }),

  mounted() {
    this.fetchOrders()
  },

  methods: {
    fetchOrders() {
      store.dispatch('dashboard/fetchOrders')
    }
  }
}
</script>

<style lang="css" scoped>
</style>
