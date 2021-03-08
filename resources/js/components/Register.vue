<template>
    <div class="modal fade" id="register-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Register</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="login-form">
                        <form action="" method="post" nonvalidate >
                            <h2 class="text-center">Create New Account</h2>
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="firstname" required="required" v-model="firstname">
                                <span class="text-danger" v-show="firstnameError"><i class="fa fa-info-circle"></i> &nbsp; Error!</span>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="lastname" required="required" v-model="lastname">
                                <span class="text-danger" v-show="lastnameError"><i class="fa fa-info-circle"></i> &nbsp; Error!</span>
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control" placeholder="email" required="required" v-model="email">
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
                                    :disabled="!isValidForm"
                                    @click.prevent="submitForm"
                                >
                                    Create Account
                                </button>
                            </div>
                            <div class="clearfix">
                                <a href="#" class="pull-right">Forgot Password?</a>
                            </div>
                        </form>
                        <p class="text-center">having account ?
                            <strong class="switch-tologin-modal" ><a href="#">Login</a></strong>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data(){
        return {
            firstname: '',
            lastname : '',
            password : '',
            email    : '',
        }
    },
    computed:{
        firstnameError(){
            return this.firstname.length > 0 && this.firstname.length < 4
        },
        lastnameError(){
            return this.lastname.length > 0 && this.lastname.length < 4
        },
        emailError(){
            return !( /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/.test(this.email) ) && this.email.length > 0
        },
        passwordError(){
            return this.password.length > 0 && this.password.length < 5
        },
        isValidForm(){
            return this.firstname.length >= 4 && this.lastname.length >= 4 && this.password.length >= 5 && ( /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/.test(this.email) )
        }
    },
    methods:{
        submitForm(){
            let {firstname,lastname,email,password} = this
            this.$store.dispatch('RegisterUser', {firstname,lastname,email,password})
        }
    }
}
</script>

<style scoped>

</style>
