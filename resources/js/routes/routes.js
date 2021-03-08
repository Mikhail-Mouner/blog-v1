import Vue from 'vue';
import VueRouter from "vue-router";

Vue.use(VueRouter)

import Post from '../components/Posts'
import PostDetails from '../components/PostDetails'
import CategoryPosts from '../components/CategoryPosts'
import AdminIndex from '../components/admin/AdminIndex'

const routes = [
    {path: '/blog-vue/public/',component: Post, name: 'Post' },
    {path: '/blog-vue/public/home',component: Post, name: 'Post' },
    {path: '/blog-vue/public/posts/:slug',component: PostDetails, name: 'PostDetails' },
    {path: '/blog-vue/public/category/:slug/posts',component: CategoryPosts, name: 'CategoryPosts' },

    {path: '/blog-vue/public/admin',component: AdminIndex, name: 'AdminIndex' },
]

const router = new VueRouter({
    routes,
    hashbang:false,
    mode: 'history',
})

export default router
