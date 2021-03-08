<template>
    <!-- add Modal HTML -->
    <div id="editPostModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form enctype="multipart/form-data">
                    <div class="modal-header">
                        <h4 class="modal-title">Edit Post</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>title</label>
                            <input type="text" class="form-control" required v-model="PostToEdit.title">
                        </div>
                        <div class="form-group">
                            <label>body</label>
                            <textarea name="" cols="30" class="form-control" rows="10" v-model="PostToEdit.body"></textarea>
                        </div>
                        <div class="form-group">
                            <label>category</label>
                            <select name="" class="form-control" v-model="PostToEdit.category.id">
                                <option value="0" disabled selected>choose category</option>
                                <option v-for="category in categories" :value="category.id">{{ category.name }}</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>image</label>
                            <input type="file" class="form-control" required @change="onImgChange">
                            <img v-if="PostToEdit.image" style="max-height: 10em; max-width: 10em;" :src="PostToEdit.image_url" :alt="PostToEdit.title">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                        <input type="submit" class="btn btn-success" value="Submit" @click.prevent="updatePost">
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data(){
        return{
            categories: {},
        }
    },
    mounted() {
        this.getCategories()
    },
    methods:{
        getCategories(){
            axios.get('/blog-vue/public/api/admin/categories')
                .then(res=> {
                    this.categories = res.data
                })
                .catch(err=>console.log(err))
        },
        onImgChange(event){
            this.PostToEdit.image = event.target.files[0]
        },
        updatePost(){
            let config = {
                headers: {"content-type" : 'multipart/form-data' }
            }
            let formData = new FormData()
            formData.append('id',this.PostToEdit.id)
            formData.append('title',this.PostToEdit.title)
            formData.append('body',this.PostToEdit.body)
            formData.append('img',this.PostToEdit.image)
            formData.append('category',this.PostToEdit.category.id)

            axios.post('/blog-vue/public/api/admin/post/edit',formData,config)
                .then(res=> {
                    alert('Edit successfully')
                    this.PostToEdit.image_url = res.data.image_url
                })
                .catch(err=>console.log(err))
        }
    },
    computed:{
        PostToEdit(){
            return this.$store.getters.editPostData
        }
    }
}
</script>
