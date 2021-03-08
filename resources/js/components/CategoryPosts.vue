<template>
    <div>
        <div class="media simple-post" v-for="post in posts" :key="post.id">
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
    </div>
</template>

<script>
export default {
    data(){
        return {
            posts: []
        }
    },
    mounted() {
        this.getPosts()
    },
    watch: {
        '$route.params.slug': function () {
        this.getPosts()

        }
    },
    methods:{
        getPosts() {
            axios.get('/blog-vue/public/api/category/'+this.$route.params.slug+'/posts')
                .then(res => {
                    this.posts = res.data
                })
                .catch(err => console.log(err))
        }
    }
}
</script>
