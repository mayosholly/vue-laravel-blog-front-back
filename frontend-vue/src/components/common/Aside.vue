<template>

<aside id="sidebar" class="sidebar">

<ul class="sidebar-nav" id="sidebar-nav">

  <li class="nav-item">
    <router-link class="nav-link " :to="{name: 'Dashboard'}">
      <i class="bi bi-grid"></i>
      <span>Dashboard</span>
    </router-link>
  </li><!-- End Dashboard Nav -->

  <li class="nav-item">
    <router-link class="nav-link " :to="{name: 'Home'}">
      <i class="bi bi-grid"></i>
      <span>Home</span>
    </router-link>
  </li><!-- End Dashboard Nav -->


 

 



  <li class="nav-item">
    <a class="nav-link collapsed" data-bs-target="#icons-cat" data-bs-toggle="collapse" href="#">
      <i class="bi bi-gem"></i><span>Categories</span><i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="icons-cat" class="nav-content collapse " data-bs-parent="#sidebar-nav">
      <li>
        <router-link :to="{name: 'CreateCategory'}">
          <i class="bi bi-circle"></i><span>Create Category</span>
        </router-link>
      </li>
      <li>
        <router-link :to="{name: 'IndexCategory'}">
          <i class="bi bi-circle"></i><span>View Categories</span>
        </router-link>
      </li>
    </ul>
  </li><!-- End Icons Nav -->

  <li class="nav-item">
    <a class="nav-link collapsed" data-bs-target="#icons-nav" data-bs-toggle="collapse" href="#">
      <i class="bi bi-gem"></i><span>Post</span><i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="icons-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
        <li>
        <router-link :to="{name: 'CreatePost'}">
          <i class="bi bi-circle"></i><span>Create Post</span>
        </router-link>
      </li>
      <li>
        <router-link :to="{name: 'ViewPost'}">
          <i class="bi bi-circle"></i><span>View Post</span>
        </router-link>
      </li>
      
    </ul>
  </li><!-- End Icons Nav -->

  <li class="nav-heading">Pages</li>


  <li class="nav-item">
    <router-link v-if="!isLoggedIn" class="nav-link collapsed" :to="{name: 'Register'}">
      <i class="bi bi-card-list"></i>
      <span>Register</span>
    </router-link>
  </li><!-- End Register Page Nav -->

  <li class="nav-item">
    <router-link v-if="!isLoggedIn"  class="nav-link collapsed" :to="{name: 'Login' }">
      <i class="bi bi-box-arrow-in-right"></i>
      <span>Login</span>
    </router-link>
  </li><!-- End Login Page Nav -->

  <li class="nav-item">
    <a v-if="isLoggedIn" @click="logout"  class="nav-link collapsed" href="#">
      <i class="bi bi-box-arrow-in-left"></i>
      <span>Logout</span>
    </a>
  </li><!-- End Login Page Nav -->





</ul>

</aside><!-- End Sidebar-->
  
    
</template>

<script>

import { mapState, mapActions } from 'vuex'
    
    
    export default {
    computed: {
    // Using Vuex helpers to map the 'isLoggedIn' state to a computed property
    ...mapState(['isLoggedIn'])
    },
    methods: {
    // Using Vuex helpers to map the 'logout' action to a method
    ...mapActions(['logout'])
    }
}
</script>

<style>

</style>