<template>
  <div>

  <!-- <el-radio-group
  v-model="isCollapse"
  style="margin-bottom: 0px;"

  text-color="#fff"
  >
  <el-radio-button :label="false" background-color="#545c64">expand</el-radio-button>
  <el-radio-button :label="true">collapse</el-radio-button>
  </el-radio-group> -->
  <el-menu default-active="1"
   class="el-menu-vertical-demo"
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
        <span slot="title">Group One</span>
        <el-menu-item index="2-1">Create Product</el-menu-item>
        <el-menu-item index="2-2">Your Likes</el-menu-item>
      </el-menu-item-group>
      <el-menu-item-group title="Group Two">
        <el-menu-item index="2-3">item three</el-menu-item>
      </el-menu-item-group>
      <el-submenu index="2-4">
        <span slot="title">item four</span>
        <el-menu-item index="2-4-1">item one</el-menu-item>
      </el-submenu>
    </el-submenu>

    <el-menu-item index="3" disabled>
      <i class="el-icon-document"></i>
      <span slot="title">Navigator Three</span>
    </el-menu-item>
    <el-menu-item index="4">
      <i class="el-icon-setting"></i>
      <span slot="title">Navigator Four</span>
    </el-menu-item>
  </el-menu>
</div>
</template>

<script>
export default {
  name: 'SideNavBar',
  data() {
      return {
        isCollapse: false
      };
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
.el-menu-vertical-demo:not(.el-menu--collapse) {
  width: 200px;
  min-height: 400px;
}
</style>
