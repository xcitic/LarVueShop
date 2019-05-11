<template>
  <v-app>
    <v-container fluid>
    <TopNavBar />
    <SideNavBar class="sidenav" />
  </v-container>
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
.fluid{
    padding: 0;
    margin: 0;
  }
  
</style>
