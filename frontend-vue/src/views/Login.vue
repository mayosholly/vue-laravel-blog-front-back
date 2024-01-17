<template>
<main>
    <div class="container">

        <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

                        <div class="d-flex justify-content-center py-4">
                            <div class="logo d-flex align-items-center w-auto">
                                <img src="../assets/img/logo.png" alt="">
                                <span class="d-none d-lg-block">My Vue Project</span>
                            </div>
                        </div><!-- End Logo -->

                        <div class="card mb-3">

                            <div class="card-body">

                                <div class="pt-4 pb-2">
                                    <h5 class="card-title text-center pb-0 fs-4">Login to Your Account</h5>
                                    <p class="text-center small">Enter your username & password to login</p>
                                </div>
                                <div v-if="isLoading">
                                    <Spinner />
                                </div>
                                <div v-if="errorList.message" style="color: red; text-align: center;">{{ errorList.message }}</div>

                                <form class="row g-3 " @submit.prevent="submitForm">

                                    <div class="col-12">
                                        <label for="yourEmail" class="form-label">Your Email</label>
                                        <input type="email" v-model="model.user.email" class="form-control" id="yourEmail">
                                        <div v-if="errorList.email" style="color: red;">{{ errorList.email[0] }}</div>
                                    </div>

                                    <div class="col-12">
                                        <label for="yourPassword" class="form-label">Password</label>
                                        <input type="password" v-model="model.user.password" class="form-control" id="yourPassword">
                                        <div v-if="errorList.password" style="color: red;">{{ errorList.password[0] }}</div>
                                    </div>

                                    <div class="col-12">
                                        <button class="btn btn-primary w-100" type="submit">Login</button>
                                    </div>
                                    <div class="col-12">
                                        <p class="small mb-0">Don't have account? <router-link to="/register">Create an account</router-link>
                                        </p>
                                    </div>
                                </form>

                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </section>

    </div>
</main><!-- End #main -->
</template>

<script>
import axios from '../axios'
import Spinner from '../components/common/Spinner.vue';

export default {
    data() {
        return {
            errorList: '',
            isLoading: false,
            model: {
                user: {
                    email: '',
                    password: ''
                }
            }
        }
    },
    components: {
        Spinner
    },
    methods: {
        async submitForm() {
            var mythis = this
            try {
                this.isLoading = true
                const response = await axios.post('/login', this.model.user)
                if (response.data.token) {
                    this.isLoading = false
                    this.errorList = ''
                    this.model.user = { ...this.model.user }
                    localStorage.setItem('token', response.data.token)
                    this.$store.commit('LOGIN')
                    this.$router.push({ name: 'Dashboard' })
                }

            } catch (error) {
                if (error.response) {
                    if (error.response.status == 422) {
                        this.isLoading = false;
                        mythis.errorList = error.response.data.errors
                    } else {
                        this.isLoading = false;
                        mythis.errorList = error.response.data
                        console.log('Error', error.response.data.message);
                    }
                }
            }
        }
    },
}
</script>

<style>
</style>
