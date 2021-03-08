<template>
    <div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Login</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="login-form">
                        <form action="" method="post">
                            <h2 class="text-center">Log in</h2>
                            <div class="form-group">
                                <input type="email" class="form-control" placeholder="Email" required="required" v-model="email">
                                <span class="text-danger" v-show="emailError"><i class="fa fa-info-circle"></i> &nbsp; Error!</span>
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" placeholder="Password" required="required" v-model="password">
                                <span class="text-danger" v-show="passwordError"><i class="fa fa-info-circle"></i> &nbsp; Error!</span>
                            </div>
                            <div class="form-group">
                                <button
                                    type="submit"
                                    class="btn btn-primary btn-block"
                                    :disabled="!isValidForm || loading"
                                    @click.prevent="submitForm"
                                >
                                    <span v-if="!loading"><i class="fa fa-check-double"></i> Log in</span>
                                    <span v-else><i class="fa fa-spin fa-spinner"></i> Loading</span>
                                </button>
                            </div>
                            <div class="clearfix">
                                <a href="#" class="pull-right">Forgot Password?</a>
                            </div>
                        </form>
                        <p class="text-center"><a class="switch-toregister-modal" href="#">Create an Account</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
export default {
    data(){
        return{
            loading  : false,
            email    : '',
            password : '',
        }
    },
    computed:{
        emailError(){
            return !( /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/.test(this.email) ) && this.email.length > 0
        },
        passwordError(){
            return this.password.length > 0 && this.password.length < 5
        },
        isValidForm(){
            return this.password.length >= 5 && ( /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/.test(this.email) )
        },
    },
    methods:{
        submitForm(){
            this.loading = true
            let {email,password} = this
            this.$store.dispatch('LoginUser', {email,password})
            this.loading = false
        }

    }
}
</script>

<style scoped>

</style>
