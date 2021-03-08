<template>
    <div>
        <!-- Title -->
        <h1 class="mt-4">{{ post.title }}</h1>

        <!-- Author -->
        <p class=" alert alert-info" style="width: fit-content;padding: 5px;color: #142d31;"> {{ post.category.name }}</p>

        <hr>

        <!-- Date/Time -->
        <p>Posted on <strong class="badge badge-primary p-1">{{ post.added_at }}</strong>
            <span class="float-right"><strong class="badge badge-info p-1">{{ comments.length }}</strong> comments</span></p>

        <hr>

        <!-- Preview Image -->
        <img class="img-fluid rounded" :src="post.image_url" style="width:900px;max-height:300px" alt="">

        <hr>

        <!-- Post Content -->
        <p class="lead" v-html="post.body"></p>

        <hr>

        <!-- Comments Form -->
        <div class="card my-4">
            <h5 class="card-header">Leave a Comment:</h5>
            <div class="card-body">
                <form>
                    <div class="form-group">
                        <textarea class="form-control" rows="3" v-model="body"></textarea>
                    </div>
                    <button
                        type="submit"
                        class="btn btn-primary"
                        @click.prevent="addComment"
                    >
                        Submit
                    </button>
                </form>
            </div>
        </div>

        <!-- Single Comment -->
        <div class="media mb-4 comment" v-for="comment in comments" :key="comment.id">
            <img class="d-flex mr-3 rounded-circle" :src="comment.user_photo" alt=""  style="width: 50px;height: 50px;">
            <div class="media-body">
                <h5 class="mt-0" >{{ comment.user.name }}</h5>
                {{ comment.body }}
            </div>
        </div>

    </div>
</template>

<script>
export default {
    data(){
        return {
            post: '',
            post_id: '',
            body: '',
            comments: '',
        }
    },
    created() {
        this.getPost()
    },
    methods:{
        getPost() {
            axios.get('/blog-vue/public/api/posts/'+this.$route.params.slug)
                .then(res => {
                    this.post = res.data
                    this.post_id = this.post.id
                    this.comments = this.post.comments
                    this.initListener()
                })
                .catch(err => console.log(err))
        },
        addComment() {
            let {post_id,body} = this
            axios.post('/blog-vue/public/api/posts/comment/create',{post_id,body})
                .then(res => {
                    this.body = ''
                })
                .catch(err => console.log(err))

        },
        initListener(){
            Echo.private(`newComment.${this.post.id}`)
            .listen('NewComment',(e)=>{
                this.comments.unshift(e.comment)
                document.querySelectorAll('.comment').forEach(c=>{
                  c.classList.remove('new')
                })
                document.querySelectorAll('.comment')[0].classList.add('new')
                console.log('listen new comment')
            })
        }

    },

}
</script>

<style scoped>
.comment{
    padding: 0.5rem;
    background-color: #fff;
}
.comment.new{
    background-color: #fff;
    animation-name: newComment;
    animation-duration: 6s;
    animation-iteration-count: 1;
}
@keyframes newComment {
    from {background-color: rgb(241,245,24);}
    to {background-color: inherit;}

}
</style>
