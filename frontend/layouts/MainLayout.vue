<template>
  <div>
    <NavBar />
    <div>
      <router-view></router-view>
    </div>
    <Footer />
  </div>
</template>

<script>
import NavBar from '@/components/NavBar';
import Footer from '@/components/Footer';

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
