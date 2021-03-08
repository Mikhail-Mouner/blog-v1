<template>

    <div class="row">

        <!-- Blog Entries Column -->
        <div class="col-md-8">

            <h1 class="my-4">Page Heading
                <small>Secondary Text</small>
            </h1>

            <!-- Blog Post -->
            <router-view></router-view>



        </div>

        <!-- Sidebar Widgets Column -->
        <div class="col-md-4">

            <!-- Categories Widget -->

            <categories></categories>


        </div>
    </div>
    <!-- /.row -->
</template>

<script>
import categories from "./Categories";


export default {
    components: {
        categories
    },
    beforeCreate(){
        this.$store.state.checkLogin = this.$store.dispatch('isLogin')

    },
}
</script>

<style scoped>

</style>
