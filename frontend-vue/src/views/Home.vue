<template>
<section class="blog-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="blog-area">
                    <div class="row" v-if="posts.length > 0">
                        <!-- Single Blog -->
                        <div class="col-sm-6" v-for="(post, index) in posts" :key="index">
                            <div >
                                <div class="single-blog" >
                                    <div class="blog-thumb" :style="{ backgroundImage: 'url(http://127.0.0.1:8000/' + post.imagePath + ')' }">
                                    </div>
                                    <h4 class="blog-title"><a href="single-blog.html">{{ post.title }}</a></h4>
                                    <p class="blog-meta">{{ post.created_at  }}</p>
                                    <p>{{ post.body }}</p>
                                    <router-link :to="{ name: 'BlogDetails', params: { id: post.id } }" class="button">Read More</router-link>                                </div>
                            </div>
                      
                        </div>

                    </div>
                    <div v-else>
                                <p>No posts available.</p>
                            </div>
                    <div class="row justify-content-center">
                        <div class="col-lg-6 text-center">
                            <a href="#" class="button blog-btn">Load More</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <div class="blog-sidebar">
                    <!-- Sidebar Widget -->
                    <div class="sidebar-widget">
                        <h2 class="sidebar-title">Search here</h2>
                        <form action="blog.html" method="get">
                            <input type="search" placeholder="Search">
                            <button><i class="fa fa-search"></i></button>
                        </form>
                    </div>
                    <!-- Sidebar Widget -->

                    <!-- Sidebar Widget -->
                    <div class="sidebar-widget">
                        <h2 class="sidebar-title">Categories</h2>
                        <ol>
                            <li v-for="(category, index) in categories" :key="index">{{ category.name  }}</li>
                        
                        </ol>
                    </div>
                    <!-- Sidebar Widget -->

                    <!-- Sidebar Widget -->
                    <div class="sidebar-widget">
                        <h2 class="sidebar-title">RECENT POSTS</h2>
                        <ol class="recent-post">
                            <!-- Single Recent Post -->
                            <li v-for="(post, index ) in posts" :key="index">
                                <span :style="{ backgroundImage: 'url(http://127.0.0.1:8000/' + post.imagePath + ')' }"></span>
                                <div class="blog-content">
                                    <a href="#">{{ post.title }}</a>
                                    <div class="blog-date">{{ post.created_at  }}</div>
                                </div>
                            </li>
                            <!-- Single Recent Post -->
                            <!-- Single Recent Post -->
                 
                            <!-- Single Recent Post -->
                        </ol>
                    </div>
                    <!-- Sidebar Widget -->

                    <!-- Sidebar Widget -->
                    <div class="sidebar-widget">
                        <h2 class="sidebar-title">POPULAR TAGS</h2>
                        <ol class="tags">
                            <li><a href="#">Design</a></li>
                            <li><a href="#">Creative</a></li>
                            <li><a href="#">Idea</a></li>
                            <li><a href="#">Web Design</a></li>
                            <li><a href="#">HTML Template</a></li>
                            <li><a href="#">Wordpress</a></li>
                            <li><a href="#">Other</a></li>
                        </ol>
                    </div>
                    <!-- Sidebar Widget -->
                </div>
            </div>
            <!-- // Sidebar -->
        </div>
    </div>
</section>
</template>

    
<script>
import axios from '../axios'

export default {

    data() {
        return {
            posts: [],
            categories : []
        }
    },
    mounted() {
        this.getAllPost()
        this.getAllCategories()
    },
    methods: {
        async getAllPost() {
            try {
                const res = await axios.get('/home');
                this.posts = res.data.data
            } catch (error) {
                if (error.response) {
                    console.log(error.response);
                }
            }
        },
        async getAllCategories() {
            const yourAuthToken = localStorage.getItem('token');

            try {
                const res = await axios.get('/category', {
                    headers: {
                        Authorization: `Bearer ${yourAuthToken}`,
                    }
                });
                this.categories = res.data.data
                console.log(this.categories);
            } catch (error) {
                if (error.response) {
                    console.log(error.response);
                }
            }
        },
       
    },

}
</script>

    
<style>
    </style>
