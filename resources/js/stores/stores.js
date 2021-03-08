import Vue from 'vue';
import Vuex from "vuex";

Vue.use(Vuex)

const stores = new Vuex.Store({
    state:{
        userToken: null,
        checkLogin: false,
        user: '',
        editPostData: {},
        notification: []
    },
    getters:{
        isLogged(state){
            return !!state.userToken
        },
        isAdmin(state){
            return state.user.is_admin
        },
        editPostData(state){
            return state.editPostData
        },
        getNotification(state){
            return state.notification
        },

    },
    mutations:{
        setUserData(state, token){
            state.userToken = token
            localStorage.setItem('token',JSON.stringify(token))
            axios.defaults.headers.common.Authorization = `Bearer ${token}`
        },
        setUser(state,user){
            state.user = user
            this.commit('getUnreadNotifications')
            Echo.connector.pusher.config.auth.headers.Authorization = `Bearer ${state.userToken}`

            Echo.private('App.User.' + state.user.id)
                .notification((notification) => {
                    state.notification.unshift(notification)
                    console.log(notification);
                });
        },
        removeUserData(state){
            state.userToken = null
            localStorage.removeItem('token')
        },
        logout(){
            this.commit('removeUserData')
            window.location.pathname = "/blog-vue/public/"
        },
        editPost(state,post){
            state.editPostData = post
        },
        getUnreadNotifications(state){
            axios.get('/blog-vue/public/api/get-unread-notifications')
                .then(res=>{
                    state.notification = res.data
                })
                .catch(err=>console.log(err))
        }
    },
    actions:{
        isLogin({commit,dispatch}) {
            let token = JSON.parse(localStorage.getItem('token'))
            if (token === undefined || token == null || token.length <= 0){
                return false
            } else {
                commit('setUserData',token)
                dispatch('getUserData')
                return true
            }
        },
        LoginUser({commit,dispatch},data){
            axios.post('/blog-vue/public/api/login',data)
                .then(res => {
                    commit('setUserData',res.data.token)
                    dispatch('getUserData')
                    return true
                })
                .catch(err => {
                    console.log(err)
                    commit('removeUserData')
                    return false
                } )
        },
        RegisterUser({commit},data){
            axios.post('/blog-vue/public/api/register',data)
                .then(res => {
                    commit('setUserData',res.data.token)
                })
                .catch(err => console.log(err) )
        },
        getUserData({commit}){
            axios.get('/blog-vue/public/api/user')
                .then(res=>{
                    commit('setUser', res.data.user)
                })
                .catch(err=>console.log(err))
        }

    }
});

export default stores
