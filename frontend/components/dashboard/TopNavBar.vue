<template>
  <el-menu
    class="text-align"
    mode="horizontal"
    @select="handleSelect"
    menu-trigger="click"
    >

      <Hamburger class="float-left ma-3"/>

    <!-- TODO Logo setup
    <Logo />
    -->
    <el-submenu index="2" class="float-right">
      <template slot="title">Hello {{ user_name }}</template>
      <el-menu-item index="2-2">Profile</el-menu-item>
      <el-menu-item index="2-3" @click="logout">Logout</el-menu-item>
      </el-submenu>

  </el-menu>


</template>

<script>
import Hamburger from './Hamburger'

export default {
  name: 'TopNavBar',
  components: {
    Hamburger
  },
  computed: {
    isCollapse() {
      return this.$store.state.dashboard.isCollapse
    },
    user_name() {
      return this.$store.state.auth.user.name
    }
  },


    methods: {
      handleSelect(key, keyPath) {
        console.log(key, keyPath);
      },
      logout() {
        this.$store.dispatch('auth/logout')
        .then(() => {
          this.$router.push('/')
        })
      },
    }
}
</script>

<style lang="css" scoped>
</style>
