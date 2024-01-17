<template>
<main>
    <div class="pagetitle">
        <h1>{{ model }}</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="">Home</a></li>
                <li class="breadcrumb-item">{{ model }}</li>
                <li class="breadcrumb-item active">{{ model }}</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{ model }}
                            <router-link :to="{ name: 'CreateCategory' }" class="btn btn-success float-end">Create Category</router-link>

                        </h5>
                        <div v-if="successMessage" class="alert alert-success">
                            {{ successMessage }}
                        </div>
                        <DataTable :model="model" :columns="categoryColumns" :data="categories" :deleteItem="deleteCategory" />
                    </div>
                </div>
            </div>
        </div>
    </section>
</main><!-- End #main -->
</template>

<script>
import axios from '../../axios';
import Spinner from '../../components/common/Spinner.vue';
import DataTable from '../../components/common/DataTable.vue';

export default {
    data() {
        return {
            successMessage: this.$route.query.success || '',
            model: 'Category',
            categoryColumns: [
                { label: 'ID', field: 'id' },
                { label: 'Name', field: 'name' },
                // Add more columns as needed
            ],
            categories: [],
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
        this.getData(); // Call the function to get data when the component is mounted
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
                this.categories = res.data.data;
            } catch (error) {
                console.error(error);
            } finally {
                this.isLoading = false;
            }
        },
        async deleteCategory(categoryId) {
            try {
                const userConfirmed = window.confirm("Are you sure you want to delete this ?");

                // If the user confirmed, proceed with deletion
                if (userConfirmed) {
                    this.isLoading = true;
                    const yourAuthToken = localStorage.getItem('token');
                    await axios.delete(`/${this.model.toLowerCase()}/${categoryId}`, {
                        headers: {
                            Authorization: `Bearer ${yourAuthToken}`,
                        },
                    });
                    // Assuming you want to refresh the list after deletion
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
