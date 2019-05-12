<template>
  <v-app>
    <NavBar />
    <v-container>
      <router-view />
    </v-container>
    <Footer />
  </v-app>
</template>

<script>
import NavBar from '@/components/NavBar'
import Footer from '@/components/Footer'

export default {
  name: 'MainLayout',
  components: {
    NavBar,
    Footer
  }
}
</script>

<style lang="css" scoped>
</style>
