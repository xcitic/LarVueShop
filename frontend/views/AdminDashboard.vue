<template>
  <v-container>
    <UsersTable :users="users" />
    <ProductsTable :products="products" />
    <OrdersTable :orders="orders" />
    <PaymentsTable :payments="payments" />
  </v-container>

</template>

<script>
import UsersTable from '@/components/admin/UsersTable'
import ProductsTable from '@/components/admin/ProductsTable'
import OrdersTable from '@/components/admin/OrdersTable'
import PaymentsTable from '@/components/admin/PaymentsTable'

import { mapState } from 'vuex'

export default {
  name: 'Dashboard',
  components: {
    UsersTable,
    ProductsTable,
    OrdersTable,
    PaymentsTable
  },

  mounted() {
    this.fetchTables()
  },

  computed: mapState({
    users: state => state.admin.users,
    products: state => state.admin.products,
    orders: state => state.admin.orders,
    payments: state => state.admin.payments
  }),

  methods: {
    fetchTables() {
      store.dispatch('admin/fetchTables');
    }
  }
}
</script>

<style lang="css" scoped>
</style>
