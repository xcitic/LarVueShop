<template>
  <div>
  <el-menu default-active="1"
   class="sidenav"
   background-color="#545c64"
   text-color="#fff"
   active-text-color="#ffd04b"
   @open="handleOpen"
   @close="handleClose"
   :collapse="isCollapse"

   >

   <el-menu-item index="1">
     <i class="el-icon-menu"></i>
     <span slot="title">Dashboard</span>
   </el-menu-item>

    <el-submenu index="2">
      <template slot="title">
        <i class="el-icon-location"></i>
        <span slot="title">Products</span>
      </template>
      <el-menu-item-group>
        <el-menu-item index="2-1">Create Product</el-menu-item>
        <el-menu-item index="2-2">Your Likes</el-menu-item>
      </el-menu-item-group>
    </el-submenu>
    <el-menu-item index="4">
      <i class="el-icon-setting"></i>
      <span slot="title">Profile</span>
    </el-menu-item>
  </el-menu>


    <v-container class="content-container" :class="{ 'content-container-collapse' : isCollapse}">

      <router-view />

    </v-container>


</div>
</template>

<script>
export default {
  name: 'SideNavBar',
  computed: {
    isCollapse() {
      return this.$store.state.dashboard.isCollapse
    }
  },
    methods: {
      handleOpen(key, keyPath) {
        console.log(key, keyPath);
      },
      handleClose(key, keyPath) {
        console.log(key, keyPath);
      }
    }
}
</script>

<style lang="css" scoped>
.sidenav:not(.el-menu--collapse) {
  width: 200px;
  min-height: 400px;
  height: 100%;
  position: absolute;
  overflow-y:hidden-md-and-up;
}
.content-container:not(.content-container-collapse) {
  padding-left:225px;
}

.content-container-collapse {
  padding-left: 100px;
}

.el-menu--collapse{
  height: 100%;
  position: absolute;
  overflow-y:hidden-md-and-up;
}



</style>
