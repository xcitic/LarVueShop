<template>
  <div>
    <TopNavBar/>
    <SideNavBar/>
  </div>

</template>

<script>
import SideNavBar from './SideNavBar';
import TopNavBar from './TopNavBar';

export default {
  name: 'NavBar',
  components: {
    SideNavBar,
    TopNavBar
  }
}
</script>

<style lang="css" scoped>
</style>
