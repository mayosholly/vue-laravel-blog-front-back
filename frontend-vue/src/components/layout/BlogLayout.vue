<template>
        <body data-spy="scroll" data-target=".navbar-nav">

<!-- ====== Header ====== -->
<header id="header" class="header">
    <!-- ====== Navbar ====== -->
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container">
            <!-- Logo -->
            <router-link class="navbar-brand logo" :to="{name: 'Home'}">
                <!-- <img src="../../assets/assets/images/logo.png" alt="logo"> -->
                My Vue Blog
            </router-link>
            <!-- // Logo -->

            <!-- Mobile Menu -->
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-expanded="false"><span><i class="fa fa-bars"></i></span></button>
            <!-- Mobile Menu -->

            <div class="collapse navbar-collapse main-menu" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item"><router-link class="nav-link" :to="{name: 'Home'}">HOME</router-link></li>
                    <li class="nav-item"><router-link class="nav-link active" :to="{name: 'Home'}">BLOG</router-link></li>
                    <li class="nav-item"><router-link class="nav-link active" :to="{name: 'Dashboard'}">ADMIN</router-link></li>
                    <li v-if="!isLoggedIn" class="nav-item"><router-link class="nav-link active" :to="{name: 'Dashboard'}">LOGIN</router-link></li>
                    <li v-if="!isLoggedIn" class="nav-item"><router-link class="nav-link active" :to="{name: 'Dashboard'}">REGISTER</router-link></li>
                    <li v-if="isLoggedIn"  class="nav-item"><router-link @click="logout" class="nav-link active" :to="{name: 'Dashboard'}">LOGOUT</router-link></li>
                </ul> 
            </div>
        </div>
    </nav>
    <!-- ====== // Navbar ====== -->
    <!-- Page Title -->
    <div class="page-title bg-img section-padding bg-overlay"  :style="{ backgroundImage: 'url(../../assets/assets/images/breadcrumb.jpg)'}">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6 text-center">
                    <h2>Blog</h2>
                </div>
            </div>
        </div>
    </div>
    <!-- // Page Title -->
    <router-view></router-view>
</header>
<!-- ====== // Header ====== -->





<!-- ====== Footer Area ====== -->
<footer class="footer-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="copyright-text">
                    <p class="text-white">&copy; Mayor D</p>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- ====== // Footer Area ====== -->


</body>
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