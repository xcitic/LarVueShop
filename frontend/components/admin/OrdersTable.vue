<template>
  <v-card class="elevation-2 my-4">
    <v-card-title>
      <h2 class="title">
        Orders
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
        <td class="text-xs-left">{{ props.item.order_status }}</td>
        <td class="text-xs-left">{{ props.item.created_at }}</td>
        <td class="text-xs-left">{{ props.item.total }}</td>
        <td class="text-xs-left">{{ props.item.user_id }}</td>
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
  name: 'OrdersTable',
  props: ['orders'],

  data () {
      return {
        search: '',
        headers: [
          {
            text: '#',
            value: 'id'
          },
          { text: 'Status', value: 'order_status' },
          { text: 'Created At', value: 'created_at' },
          { text: 'Total Price', value: 'total_price'},
          { text: 'User', value: 'user_id' },
        ],
      }
    }

}
</script>

<style lang="css" scoped>
</style>
