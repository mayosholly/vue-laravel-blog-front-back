<template>
    <!-- Navigation bar -->
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <router-link class="navbar-brand" to="/">Navbar</router-link>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Link</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Dropdown
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#">Action</a></li>
            <li><a class="dropdown-item" href="#">Another action</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">Something else here</a></li>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link disabled" aria-disabled="true">Disabled</a>
        </li>
      </ul>
      <form class="d-flex" role="search">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>
    </div>
  </div>
</nav>
    <nav>
    <!-- Links for different routes. They are conditionally rendered based on the 'isLoggedIn' state. -->
    <router-link to="/" v-if="isLoggedIn">Product List</router-link> |
    <router-link to="/add-product" v-if="isLoggedIn">Add Product</router-link> |
    <router-link to="/login" v-if="!isLoggedIn">Login</router-link> |
    <router-link to="/register" v-if="!isLoggedIn">Register</router-link> |
    <!-- Logout button that calls 'logout' action when clicked -->
    <button type="button" @click="logout" v-if="isLoggedIn">Logout</button>
    </nav>
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