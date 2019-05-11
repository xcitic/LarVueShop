<template>
  <v-container>
    <div class="row">
      <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
        <RegisterForm />
      </div>
    </div>


  </v-container>

</template>

<script>
import RegisterForm from '@/components/RegisterForm'

export default {
  name: 'Register',
  components: {
    RegisterForm
  }
}
</script>

<style lang="css" scoped>
</style>
