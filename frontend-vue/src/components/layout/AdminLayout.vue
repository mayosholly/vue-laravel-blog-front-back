<template>
<div>
    <Header />

    <main id="main" class="main">

        <Aside />

        <!-- Your main content goes here -->
        <router-view></router-view>

    </main><!-- End #main -->
    <Footer />
</div>
</template>

<script>
import Header from '../common/Header.vue'
import Aside from '../common/Aside.vue'
import Footer from '../common/Footer.vue'

export default {
    name: 'AdminLayout',
    components: {
        Header,
        Aside,
        Footer
    }
}
</script>

<style>
</style>
