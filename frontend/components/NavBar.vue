<template>
  <div class="container-fluid">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">

      <router-link :to="{ name: 'Landing', params: {} }">
      <slot name="app_name"></slot>
      </router-link>

        <div class="container">

          <button class="navbar-toggler ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>

          <div class="collapse navbar-collapse " id="navbarSupportedContent">

            <ul class="navbar-nav mr-auto">
              <li class="nav-item" >
                <router-link class="nav-link" :to="{ name: 'Products' }">Browse Products</router-link>
              </li>
            </ul>

            <ul class="navbar-nav ml-auto">

              <li class="nav-item" v-if="!isLoggedIn">
                <router-link class="nav-link" :to="{ name: 'Login', params: {} }">Login</router-link>
              </li>
              <li class="nav-item" v-if="!isLoggedIn">
                <router-link class="nav-link" :to="{ name: 'Register', params: {} }">Signup</router-link>
              </li>

              <li class="nav-item dropdown" v-if="isLoggedIn">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Welcome {{user.name}}
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <router-link class="dropdown-item" :to="{ name: 'Dashboard'}">Dashboard</router-link>
                  <a class="dropdown-item" @click="logout">Logout</a>
                </div>
              </li>
            </ul>
          </div>
        </div>
    </nav>
  </div>

</template>

<script>
import { mapState } from 'vuex'

export default {
  name: 'NavBar',

  computed: mapState({
    isLoggedIn: state => state.auth.authToken,
    user: state => state.auth.user
  }),

  methods: {
    logout() {
      this.$store.dispatch('auth/logout')
      .then(() => {
        this.$router.push('/')
      })
    }
  }
}
</script>

<style lang="css" scoped>
.container-fluid {
  padding-left: 0;
  padding-right: 0;
}
</style>
