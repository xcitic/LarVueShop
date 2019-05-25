<template>
  <v-container>
    <CreateProductForm />
  </v-container>
</template>

<script>
import CreateProductForm from '@/components/admin/CreateProductForm'

export default {
  name: 'CreateProduct',
  components: {
    CreateProductForm,
  }
}
</script>

<style lang="css" scoped>
</style>
