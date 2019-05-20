<template>
  <v-card class="elevation-2 my-4">
    <v-card-title>
      <h2 class="title">
        Products
      </h2>
      <v-spacer/>
      <v-text-field v-model="search" append-icon="search" label="Search" single-line hide-details />
    </v-card-title>

    <v-data-table
      :headers="headers"
      :items="products"
      class="elevation-1"
      :search="search"
    >
      <template v-slot:items="props">
        <td class="text-xs-left">{{ props.item.id }}</td>
        <td class="text-xs-left">{{ props.item.title }}</td>
        <td class="text-xs-left">{{ props.item.image }}</td>
        <td class="text-xs-left">{{ props.item.likes }}</td>
        <td class="text-xs-left">{{ props.item.price }}</td>
        <td class="text-xs-left"><a> View </a></td>

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
  name: 'ProductsTable',
  props: ['products'],

  data () {
      return {
        search: '',
        headers: [
          {
            text: '#',
            value: 'id'
          },
          { text: 'Title', value: 'title' },
          { text: 'Image', value: 'image' },
          { text: 'Likes', value: 'likes'},
          { text: 'price', value: 'price' },
        ],
      }
    }

}
</script>

<style lang="css" scoped>
</style>
