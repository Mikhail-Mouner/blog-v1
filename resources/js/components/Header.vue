<template>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container">
            <router-link class="navbar-brand" to="/blog-vue/public/">Blog Vue</router-link>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <notification-bar></notification-bar>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active">
                        <router-link class="nav-link" to="/blog-vue/public/">Home
                            <span class="sr-only">(current)</span>
                        </router-link>
                    </li>
                    <li
                        v-if="isAdmin"
                        class="nav-item">
                        <router-link class="nav-link" to="/blog-vue/public/admin">Admin</router-link>
                    </li>




                    <li
                        v-if="!isLogged"
                        class="nav-item register-btn reg-login-btn"
                        data-toggle="modal"
                        data-target="#register-modal" >
                        <a class="btn btn-info nav-link" href="" data-toggle="modal" data-target="#register-modal">Register</a>
                    </li>
                    <li
                        v-if="!isLogged"
                        class="nav-item reg-login-btn"
                        data-toggle="modal"
                        data-target="#login-modal" >
                        <a class="btn btn-primary text-weight nav-link" href="#">login</a>
                    </li>
                    <li
                        v-if="isLogged"
                        @click.stop="logout"
                        class="nav-item reg-login-btn" >
                        <a class="btn btn-danger text-weight nav-link" href="#">logut</a>
                    </li>

                </ul>
            </div>
        </div>
    </nav>

</template>

<script>
import notificationBar from './NotificationBar';
export default {
    name: "Header",
    computed:{
        isLogged(){
            return this.$store.getters.isLogged
        },
        isAdmin(){
            return this.$store.getters.isAdmin
        },
    },
    methods:{
        logout(){
            this.$store.commit('logout')
        }
    },
    components:{
        notificationBar
    }
}
</script>

<style scoped>

</style>
