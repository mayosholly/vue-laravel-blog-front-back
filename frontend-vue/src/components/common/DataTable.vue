<template>
    <table class="table datatable">
      <thead>
        <tr>
          <th v-for="column in columns" :key="column.field" scope="col">{{ column.label }}</th>
          <th scope="col">Actions</th>
        </tr>
      </thead>
      <tbody>
        <tr v-if="data.length === 0">
          <td :colspan="columns.length + 1">
            <Spinner />
          </td>
        </tr>
        <tr v-else v-for="(item, index) in data" :key="index">
          <td v-for="column in columns" :key="column.field">
            <!-- Check if the column is an additional field and handle accordingly -->
            <template v-if="additionalFields[column.field]">
              <template v-if="column.field === 'file'">
                <img :src="`http://127.0.0.1:8000/${item[additionalFields[column.field]]}`" alt="Post Image" style="max-width: 50px; max-height: 50px;" />
              </template>
              <template v-else-if="column.field === 'category'">
                {{ item.category ? item.category.name : 'N/A' }}
              </template>
            </template>
            <!-- Handle other columns as usual -->
            <template v-else>
              {{ item[column.field] }}
            </template>
          </td>
          <td>
            <router-link :to="{ path: `/${model}/${item.id}/edit` }" class="btn btn-primary" style="margin-right: 5px;">
              <i class="bi bi-pencil"></i>
            </router-link>
            <button type="button" @click="deleteItem(item.id)" class="btn btn-danger">
              <i class="bi bi-trash"></i>
            </button>
          </td>
        </tr>
      </tbody>
    </table>
  </template>
  
  <script>
  import Spinner from '../../components/common/Spinner.vue';
  
  export default {
    props: {
      model: {
        type: String,
        required: true,
      },
      columns: {
        type: Array,
        default: () => [],
      },
      data: {
        type: Array,
        default: () => [],
      },
      deleteItem: {
        type: Function,
        required: true,
    },
      additionalFields: {
        type: Object,
        default: () => ({}),
      },
    },
    components: {
      Spinner,
    },
  };
  </script>
  
  <style>
  /* Add your styles here */
  </style>
  