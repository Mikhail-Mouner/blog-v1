<template>
    <div class="dropdown">
        <button class="dropbtn"><i class="fa fa-bell"></i><span class="badge badge-danger">{{ notifications.length }}</span></button>
        <div class="dropdown-content">
            <div class="media p-2" v-for="(n,i) in notifications" :key="i">
                <img :src="'/blog-vue/public/img/'+n.data.comment_owner.photo" :alt="n.data.comment_owner.name" style="height: 60px;width: 60px" class="mr-2">
                <div class="media-body">
                    <div class="mt-0"><strong>{{ n.data.comment_owner.name }}</strong> added a comment on your post</div>
                    <router-link :to="'/blog-vue/public/posts/'+n.data.post.slug" class="p-0">{{ n.data.post.title }}</router-link>
                    <p class="m-0"><i class="fa fa-clock mr-1"> {{ formatTime(n.data.commented_at) }}</i></p>
                </div>
            </div>

            <div>
                <a href="" class="see-all"><i class="fa fa-concierge-bell mr-2"></i> See All</a>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "NotificationBar",
    computed:{
        notifications(){
            return this.$store.getters.getNotification
        },
    },
    methods:{
        formatTime(date){
            let d = new Date(date);
            return `${d.getFullYear()}/${d.getMonth()}/${d.getDate()}`
        },
    },
}
</script>

<style scoped>
.dropdown .dropbtn {
    font-size: 16px;
    border: none;
    outline: none;
    color: white;
    padding: 14px 16px;
    background-color: inherit;
    font-family: inherit;
    margin: 0;
}
.navbar a:hover,
.dropdown:hover .dropbtn {
    background-color: #686e73;
}
.dropdown-content {
    display: none;
    position: absolute;
    background-color: #f9f9f9;
    min-width: 160px;
    box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
    z-index: 1;
    min-width: 287px;
    max-height: 400px;
    overflow: auto;
}
.dropdown-content .media-body>div {
    font-size: 15px;
    line-height: 1.3;
}
.dropdown-content .media-body a {
    float: none;
    color: #1580dc;
    background: none;
    text-decoration: none;
    display: block;
    text-align: left;
}
.see-all {
    color: #000;
    background: #e4dede;
    text-decoration: none;
    text-align: center !important;
    display: block;
    padding: 4px;
}
.dropdown-content p {
    font-size: 14px;
}
.dropdown-content a:hover {
    background-color: #ddd;
}
.dropdown:hover .dropdown-content {
    display: block;
}
</style>
