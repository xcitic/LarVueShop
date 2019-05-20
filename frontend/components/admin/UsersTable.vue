<template>
  <v-card class="elevation-2 my-4">
    <v-card-title>
      <h2 class="title">
        Users
      </h2>
      <v-spacer/>
      <v-text-field v-model="search" append-icon="search" label="Search" single-line hide-details />
    </v-card-title>

    <v-data-table
      :headers="headers"
      :items="users"
      class="elevation-1"
      :search="search"
    >
      <template v-slot:items="props">
        <td class="text-xs-left">{{ props.item.id }}</td>
        <td class="text-xs-left">{{ props.item.name }}</td>
        <td class="text-xs-left">{{ props.item.email }}</td>
        <td class="text-xs-left">{{ props.item.email_verified_at ? 'Verified' : 'Not verified' }}</td>
        <td class="text-xs-left">{{ props.item.created_at }}</td>
        <td class="text-xs-left">{{ props.item.phone || 'Not added' }}</td>
        <td class="text-xs-left">{{ props.item.country || 'Not added' }}</td>
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
  name: 'UsersTable',
  props: ['users'],

  data () {
      return {
        search: '',
        headers: [
          {
            text: '#',
            value: 'id'
          },
          { text: 'Name', value: 'name' },
          { text: 'Email', value: 'email' },
          { text: 'Verified', value: 'email_verified_at'},
          { text: 'Joined Date', value: 'created_at' },
          { text: 'Phone', value: 'phone' },
          { text: 'Country', value: 'country' },
        ],
      }
    }

}
</script>

<style lang="css" scoped>
</style>
