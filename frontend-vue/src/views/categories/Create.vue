<template>
<div>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Category</h4>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Create A Category
                            <router-link :to="{ name: 'IndexCategory' }" class="btn btn-success float-end">Back</router-link>

                        </h5>

                        <div v-if="isLoading">
                            <Spinner />
                        </div>

                        <!-- Floating Labels Form -->
                        <form class="row g-3" @submit.prevent="submitForm">
                            <div class="col-md-12">
                                <div class="form-floating">
                                    <input type="text" class="form-control" v-model="model.category.name" id="floatingName" placeholder="Category Name">
                                    <label for="floatingName">Category Name</label>
                                    <div v-if="errorList.name" style="color: red;">{{ errorList.name[0] }}</div>

                                </div>
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn btn-primary" style="margin-right: 5px;">Submit</button>
                                <button type="reset" class="btn btn-secondary">Reset</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</template>

<script>
import axios from '../../axios'
import Spinner from '../../components/common/Spinner.vue';

export default {
    name: 'CreateCategory',
    data() {
        return {
            successMessage: '',
            isLoading: false,
            errorList: '',
            model: {
                category: {
                    name: ''
                }
            }
        }
    },
    methods: {
        async submitForm() {
            try {
                this.isLoading = true;
                const yourAuthToken = localStorage.getItem('token');
                //   const yourAuthToken = this.$store.getters.getToken;

                const response = await axios.post('/category', this.model.category, {
                    headers: {
                        Authorization: `Bearer ${yourAuthToken}`,
                    },
                });
                this.isLoading = false;
                this.model.category = { ...this.model.category };
                this.errorList = '';
                this.successMessage = response.data.message;
                this.$router.push({
                    name: 'IndexCategory',
                    query: { success: this.successMessage },
                });
            } catch (error) {
                if (error.response) {
                    if (error.response.status === 422) {
                        this.isLoading = false;
                        this.errorList = error.response.data.errors;
                    }
                } else if (error.request) {
                    console.log(error.request);
                } else {
                    console.log('Error', error.message);
                }
            }
        },
    },

}
</script>

<style></style>
