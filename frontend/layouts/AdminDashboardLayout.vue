<template>
  <v-app>
    <v-container fluid>
    <TopNavBar />
    <SideNavBar class="sidenav" />
    <v-container class="content-container" :class="{ 'content-container-collapse' : isCollapse}">
      <!-- Dashboard content is injected here -->
      <router-view />

    </v-container>
  </v-container>
  </v-app>
</template>

<script>
import NavBar from '@/components/dashboard/NavBar'
import TopNavBar from '@/components/dashboard/TopNavBar'
import SideNavBar from '@/components/dashboard/SideNavBar'

export default {
  name: 'AdminDashboardLayout',
  computed: {
    isCollapse() {
      return this.$store.state.dashboard.isCollapse
    }
  },
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

  .content-container:not(.content-container-collapse) {
    padding-left:150px;
  }

  .content-container-collapse {
    padding-left: 25px;
  }

</style>
