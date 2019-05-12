<template>
  <v-container>
    <div class="row">
      <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
        <LoginForm />
      </div>

    </div>
  </v-container>

</template>

<script>
import LoginForm from '@/components/LoginForm'

export default {
  name: 'Login',
  components: {
    LoginForm
  }
}
</script>

<style lang="css" scoped>
</style>
