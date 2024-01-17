import { createRouter, createWebHistory } from 'vue-router';
import AdminLayout from './components/layout/AdminLayout.vue';
import BlogLayout from './components/layout/BlogLayout.vue';
import ProductList from './components/ProductList.vue';
import ProductDetails from './components/ProductDetails.vue';
import AddProduct from './components/AddProduct.vue';
import EditProduct from './components/EditProduct.vue';
import Dashboard from './views/Dashboard.vue';
import Home from './views/Home.vue';
import BlogDetails from './views/BlogDetails.vue';
import Login from './views/Login.vue';
import Register from './views/Register.vue';
import CreateCategory from './views/categories/Create.vue';
import IndexCategory from './views/categories/IndexCategory.vue';
import EditCategory from './views/categories/EditCategory.vue';
import CreatePost from './views/posts/CreatePost.vue';
import ViewPost from './views/posts/ViewPost.vue';
import EditPost from './views/posts/EditPost.vue';
const routes = [
  {
    path: '/',
    component: AdminLayout,
    children: [
      { path: 'home', name: 'Dashboard', component: Dashboard , meta: { public: false } },
      { path: 'category/create', name: 'CreateCategory', component: CreateCategory , meta: { public: false } },
      { path: 'category', name: 'IndexCategory', component: IndexCategory , meta: { public: false } },
      { path: 'category/:id/edit', name: 'EditCategory', component: EditCategory , meta: { public: false } },
      
      { path: 'post/create', name: 'CreatePost', component: CreatePost , meta: { public: false } },
      { path: 'post', name: 'ViewPost', component: ViewPost , meta: { public: false } },
      { path: 'post/:id/edit', name: 'EditPost', component: EditPost , meta: { public: false } },

      { path: 'product', name: 'ProductList', component: ProductList, meta: { public: false } },
      { path: 'product/:id', name: 'ProductDetails', component: ProductDetails, meta: { public: false } },
      { path: 'add-product', name: 'AddProduct', component: AddProduct, meta: { public: false } },
      { path: 'edit-product/:id', name: 'EditProduct', component: EditProduct, meta: { public: false } },
 
    ],
  },

  {
    path: '/userPage',
    component: BlogLayout,
    children: [
        { path: '', name: 'Home', component: Home , meta: { public: true } },
        { path: 'blog/:id', name: 'BlogDetails', component: BlogDetails , meta: { public: true } },
    ]
    },


  { path: '/login', name: 'Login', component: Login, meta: { public: true } },
  { path: '/register', name: 'Register', component: Register, meta: { public: true } },
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

router.beforeEach((to, from, next) => {
  const isAuthenticated = !!localStorage.getItem('token');

  if (!to.meta.public && !isAuthenticated) {
    next({ name: 'Login' });
  } else {
    next();
  }
});

export default router;
