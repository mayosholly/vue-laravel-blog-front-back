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
                        <h5 class="card-title">Create A Post
                            <router-link :to="{ name: 'ViewPost' }" class="btn btn-success float-end">Back</router-link>

                        </h5>

                        <div v-if="isLoading">
                            <Spinner />
                        </div>

                        <!-- Floating Labels Form -->
                        <form class="row g-3" @submit.prevent="submitForm">
                            <div class="col-md-12">
                                <div class="form-floating">
                                    <input type="text" class="form-control" v-model="model.post.title" id="floatingName" placeholder="Post Title">
                                    <label for="floatingName">Post Title</label>
                                    <div v-if="errorList.title" style="color: red;">{{ errorList.title[0] }}</div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-floating mb-3">
                                    <select class="form-select" v-model="model.post.category_id" id="floatingSelect" aria-label="Category">
                                        <option selected disabled>Select Category</option>
                                        <option v-for="(category, index) in categories" :key="index" :value="category.id">{{ category.name }}</option>
                                    </select>
                                    <label for="floatingSelect">Category</label>
                                    <div v-if="errorList.title" style="color: red;">{{ errorList.category_id[0] }}</div>

                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-floating">
                                    <textarea class="form-control" placeholder="Body" v-model="model.post.body" id="floatingTextarea" style="height: 100px;"></textarea>
                                    <label for="floatingTextarea">Body</label>
                                    <div v-if="errorList.title" style="color: red;">{{ errorList.body[0] }}</div>

                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-floating">
                                    <input type="file" class="form-control" @change="handleFileChange" accept="image/**">
                                    <label for="floatingName">File Upload</label>
                                    <div v-if="errorList.file" style="color: red;">{{ errorList.file[0] }}</div>
                                </div>
                                <img v-if="imageUrl" :src="imageUrl" alt="Uploaded Image" style="max-width: 200px; margin-top: 10px;">
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
    name: 'CreatePost',
    data() {
        return {
            successMessage: '',
            isLoading: false,
            errorList: '',
            categories: [],
            image: null, // Rename 'file' to 'image'
            imageUrl: null, // Add imageUrl to display the uploaded image
            model: {
                post: {
                    title: '',
                    body: '',
                    category_id: '',
                }
            }
        }
    },
    mounted() {
        this.categories = this.getData()
    },
    methods: {
        handleFileChange(e) {
            const file = e.target.files[0]
            this.image = file

            if (file) {
                const reader = new FileReader()
                reader.onload = (e) => {
                    this.imageUrl = e.target.result;
                }
                reader.readAsDataURL(file)
            }
        },

        async submitForm() {
            try {
                this.isLoading = true;
                const yourAuthToken = localStorage.getItem('token');
                //   const yourAuthToken = this.$store.getters.getToken;

                const formData = new FormData();
                formData.append("file", this.image);
                formData.append("title", this.model.post.title);
                formData.append("body", this.model.post.body);
                formData.append("category_id", this.model.post.category_id);

                const response = await axios.post('/post', formData, {
                    headers: {
                        Authorization: `Bearer ${yourAuthToken}`,
                        'Content-Type': 'multipart/form-data', // Specify content type for file upload
                    },
                });
                this.isLoading = false;
                this.model.post = { ...this.model.post };
                this.errorList = '';
                this.successMessage = response.data.message;
                this.$router.push({
                    name: 'ViewPost',
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

        async getData() {
            try {
                this.isLoading = true;
                const yourAuthToken = localStorage.getItem('token');
                const res = await axios.get('/category', {
                    headers: {
                        Authorization: `Bearer ${yourAuthToken}`,
                    },
                });
                this.categories = res.data.data;
            } catch (error) {
                console.error(error);
            } finally {
                this.isLoading = false;
            }
        },
    },

}
</script>

<style></style>
