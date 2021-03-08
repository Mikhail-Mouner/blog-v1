<template>
    <div>

        <!-- Search Widget -->
        <div class="card my-4">
            <h5 class="card-header">Search</h5>
            <div class="card-body">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search for..." v-model="search_post">
                    <span class="input-group-btn">
                                <button class="btn btn-secondary" type="button">Go!</button>
                            </span>
                </div>
            </div>
        </div>

        <!-- Post Section -->
        <div v-if="is_searching">
            <div class="alert alert-warning"><i class="fa fa-spin fa-spinner"></i> Searching</div>
        </div>
        <div v-else>

            <div class="media simple-post" v-for="post in posts.data" :key="post.id">
                <img class="mr-3" :src="post.image_url" :alt="post.title">
                <div class="media-body">
                    <h4 class="mt-0">
                        <router-link :to="'/blog-vue/public/posts/'+post.slug">{{ post.title }}</router-link>
                    </h4>
                    {{ post.body.substr(0,150) }}
                    <ul class="list-inline list-unstyled d-flex post-info">
                        <li><span><i class="fas fa-user"></i> posted by : <strong class="text-info">{{ post.user.name }}</strong> </span></li>
                        <li>|</li>
                        <li><span><i class="fa fa-calendar"></i> {{ post.added_at }} </span></li>
                        <li>|</li>
                        <span><i class="fa fa-comment"></i> {{ post.comment_count }} comments</span>

                    </ul>
                </div>
            </div>

            <!-- Pagination -->
            <pagination v-if="search_post.length <= 0" :data="posts" @pagination-change-page="getPosts"></pagination>
            <pagination v-else :data="posts" @pagination-change-page="searchPosts"></pagination>
        </div>
    </div>
</template>

<script>
export default {
    data(){
        return{
            is_searching: false,
            search_post: '',
            posts: {},
        }
    },
    mounted() {
        this.getPosts()
    },
    methods:{
        getPosts(page = 1) {
            axios.get('api/posts/?page='+page)
                .then(res => {
                    this.posts = res.data
                    localStorage.setItem('posts',JSON.stringify(this.posts))
                })
                .catch(err => console.log(err))
        },
        searchPosts(page = 1) {
            let query = this.search_post
            axios.get('api/posts/search/'+query+'?page='+page)
                .then(res=>  {
                    this.posts = res.data
                    this.is_searching = false
                }).catch(err=>console.log(err))
        },
    },
    watch:{
        search_post(query,page = 1){
            if (query.length > 0){
                this.is_searching = true
                this.searchPosts(query,page)
            }else{
                this.posts = JSON.parse(localStorage.getItem('posts'))
            }
        }
    }
}
</script>
