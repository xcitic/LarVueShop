<template>
  <v-card class="elevation-2 my-4">
    <v-card-title>
      <h2 class="title">
        My Orders
      </h2>
      <v-spacer/>
      <v-text-field v-model="search" append-icon="search" label="Search" single-line hide-details />
    </v-card-title>

    <v-data-table
      :headers="headers"
      :items="orders"
      class="elevation-1"
      :search="search"
    >
      <template v-slot:items="props">
        <td class="text-xs-left">{{ props.item.id }}</td>
        <td class="text-xs-left">$ {{ props.item.payment.amount }}</td>
        <td class="text-xs-left">{{ props.item.order_status }}</td>
        <td class="text-xs-left">{{ props.item.created_at }}</td>
        <td class="text-xs-left">Delivery Date</td>
        <td class="text-xs-left">View Receipt</td>
      </template>
      <template v-slot:no-results>
        <v-alert :value="true" color="error" icon="warning">
          Your search for "{{ search }}" found no results.
        </v-alert>
      </template>
    </v-data-table>
  </v-card>
</template>

<script>
export default {
  name: 'MyOrders',
  props: ['orders'],
  data() {
    return {
      search: '',
      headers: [
        { text: '#', value: 'id' },
        { text: 'Total', value: 'payment.amount' },
        { text: 'Status', value: 'order_status' },
        { text: 'Date Created', value: 'created_at'},
        { text: 'Delivery Date', value: 'delivery_date'},
        { text: 'Actions', sortable: false,},

      ]
    }
  }
}
</script>

<style lang="css" scoped>
</style>
