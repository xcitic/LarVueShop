<template>
  <v-app>
    <TopNavBar />
    <SideNavBar />
    <router-view :key="key"/>
  </v-app>
</template>

<script>
import NavBar from '@/components/dashboard/NavBar';
import TopNavBar from '@/components/dashboard/TopNavBar';
import SideNavBar from '@/components/dashboard/SideNavBar';

export default {
  name: 'DashboardLayout',
  components: {
    NavBar,
    TopNavBar,
    SideNavBar
  }

}
</script>

<style lang="css" scoped>
</style>
