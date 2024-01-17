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
                <h5 class="card-title">
                  Edit Category
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
                    <button type="submit" class="btn btn-primary" style="margin-right: 5px;">Update</button>
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
  import axios from '../../axios';
  import Spinner from '../../components/common/Spinner.vue';
  import apiService from '../../services/apiService';
  
  export default {
    name: 'EditCategory',
    data() {
      return {
        successMessage: '',
        isLoading: false,
        errorList: '',
        categoryId: '',
        model: {
          category: {
            name: '',
          },
        },
      };
    },
    mounted() {
      this.categoryId = this.$route.params.id;
      this.getCategory(this.categoryId);
    },
    methods: {
      async getCategory(categoryId) {
        try {
          this.isLoading = true;
          const response = await apiService.getCategory(categoryId);
          this.model.category = response.data.data;
        } catch (error) {
          if (error.response && error.response.status === 404) {
            alert('Page not found');
            this.$router.push({ name: 'IndexCategory' });
          } else {
            console.error(error);
          }
        } finally {
          this.isLoading = false;
        }
      },
  
      async submitForm() {
        try {
          this.isLoading = true;
          const response = await apiService.updateCategory(this.categoryId, this.model.category);
          this.successMessage = response.data.message;
          this.$router.push({ 
            name: 'IndexCategory',
            query: { success: this.successMessage },
         });
        } catch (error) {
          if (error.response && error.response.status === 422) {
            this.errorList = error.response.data.errors;
          } else {
            console.error('Error', error.message);
          }
        } finally {
          this.isLoading = false;
        }
      },
    },
  };
  </script>
  
  <style></style>
  