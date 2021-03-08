<template>
    <!-- Categories Widget -->
    <div class="card my-4">
        <h5 class="card-header">Categories</h5>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-12">
                    <ul class="list-unstyled mb-0" v-for="category in categories" :key="category.id">
                        <li>
                            <router-link :to="'/blog-vue/public/category/'+category.slug+'/posts'">{{ category.name }}</router-link>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
export default {
    data(){
        return {
            categories: []
        }
    },
    mounted() {
        this.getCategories()
    },
    methods:{
        getCategories(){
            axios.get('/blog-vue/public/api/categories')
            .then(res=> {
                this.categories = res.data
            })
            .catch(err=>console.log(err))
        }
    }
}
</script>

<style scoped>

</style>
