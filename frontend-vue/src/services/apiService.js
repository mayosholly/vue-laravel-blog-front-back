import axios from '../axios';

const apiService = {
  async getCategory(categoryId) {
    const yourAuthToken = localStorage.getItem('token');
    return await axios.get(`/category/${categoryId}`, {
      headers: {
        Authorization: `Bearer ${yourAuthToken}`,
      },
    });
  },

  async updateCategory(categoryId, data) {
    const yourAuthToken = localStorage.getItem('token');
    return await axios.put(`/category/${categoryId}`, data, {
      headers: {
        Authorization: `Bearer ${yourAuthToken}`,
      },
    });
  },

  async updatePost(postId, data) {
    const yourAuthToken = localStorage.getItem('token');
    return await axios.post(`/post/${postId}`, data, {
        headers: {
            Authorization: `Bearer ${yourAuthToken}`,
            'Content-Type': 'multipart/form-data', // Specify content type for file upload
        },
    });
  },
};

export default apiService;
