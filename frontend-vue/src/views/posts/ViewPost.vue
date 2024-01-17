<template>
<main>
    <div class="pagetitle">
        <h1>{{ model }}</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item">{{ model }}</li>
                <li class="breadcrumb-item active">List</li>
            </ol>
        </nav>
    </div>

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{ model }}
                            <router-link :to="{ name: 'CreatePost' }" class="btn btn-success float-end">Create Post</router-link>
                        </h5>
                        <div v-if="successMessage" class="alert alert-success">
                            {{ successMessage }}
                        </div>
                        <DataTable :model="model" :columns="categoryColumns" :data="posts" :deleteItem="deleteCategory" :additionalFields="{ file: 'imagePath', 'category': 'category.name' }" />

                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
</template>

<script>
import axios from '../../axios';
import Spinner from '../../components/common/Spinner.vue';
import DataTable from '../../components/common/DataTable.vue';

export default {
    data() {
        return {
            successMessage: this.$route.query.success || '',
            model: 'Post',
            categoryColumns: [
                { label: 'ID', field: 'id' },
                { label: 'Title', field: 'title' },
                { label: 'Body', field: 'body' },
                { label: 'Image', field: 'file' },
                { label: 'Category', field: 'category' },
                // Add more columns as needed
            ],
            posts: [], // Rename from categories to posts
            isLoading: false,
        };
    },
    components: {
        Spinner,
        DataTable,
    },
    mounted() {
        if (this.successMessage) {
            setTimeout(() => {
                this.successMessage = '';
            }, 2000);
        }
        this.getData();
    },
    methods: {
        async getData() {
            try {
                this.isLoading = true;
                const yourAuthToken = localStorage.getItem('token');
                const res = await axios.get(`/${this.model.toLowerCase()}`, {
                    headers: {
                        Authorization: `Bearer ${yourAuthToken}`,
                    },
                });
                this.posts = res.data.data; // Update to posts
            } catch (error) {
                console.error(error);
            } finally {
                this.isLoading = false;
            }
        },
        async deleteCategory(categoryId) {
            try {
                const userConfirmed = window.confirm("Are you sure you want to delete this post?");

                if (userConfirmed) {
                    this.isLoading = true;
                    const yourAuthToken = localStorage.getItem('token');
                    await axios.delete(`/${this.model.toLowerCase()}/${categoryId}`, {
                        headers: {
                            Authorization: `Bearer ${yourAuthToken}`,
                        },
                    });
                    this.getData();
                }
            } catch (error) {
                console.error(error);
            } finally {
                this.isLoading = false;
            }
        },
    },
};
</script>

<style>
/* Add your styles here */
</style>
