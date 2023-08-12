<template>
   <div>
       <form @submit.prevent="createAlbum" action="" enctype="multipart/form-data" v-if="!success">
           <div class="form-group">
           
               <label>Name of Album</label>
               <input type="text" name="name" class="form-control" v-model="name" maxlength="15">
               <span v-if="allErrors.name" :class="['danger']">
                   {{allErrors.name[0]}}
               </span>
           </div>
           <div class="form-group">
               <label>Description of Album</label>
               <textarea class="form-control description" v-model="description" maxlength="200" name="description"></textarea>
               <span v-if="allErrors.description" :class="['danger']">
                   {{allErrors.description[0]}}
               </span>
           </div>
           <div class="form-group">
               <label>Category of Album</label>
               <select name="category_id" class="form-control" v-model="category">
                   <option v-for="(category,index) in categories" :key="index" :value="category.id">
                       {{category.name}}
                   </option>
               </select> 
               <span v-if="allErrors.category_id" :class="['danger']">
                   {{allErrors.category_id[0]}}
               </span>
           </div>
           <div class="form-group"> 
               <label>Image of Album</label>
               <input type="file" v-on:change="onImageChange"  name="image" class="form-control">
               <span v-if="allErrors.image" :class="['danger']">
                   {{allErrors.image[0]}}
               </span>
           </div>
           <div class="form-group">
               <button class="btn btn-primary mt-2" type="submit">Create Album</button>
           </div>
       </form>
       <div class="" v-if="success">
              <a :href="'/upload/images/'+albumId">Your Album is Created. Please click the link to upload the images</a>
       </div>
   </div>
</template>

<script>
    export default {
        data(){
            return{
                name:'',
                description:'',
                category:'',
                image:'',
                categories:[],
                albumId:'',
                success:false,
                allErrors:[]
            }
        },
        created(){
              this.getCategories();
        }, 
        methods:{
             getCategories(){
                axios.get('/api/categories').then((response)=>{
                    this.categories=response.data;
                }).catch((error)=>{
                    alert('unable to fetch data');
                })
             },
             createAlbum(){
                  const config = {
                    headers:{
                        'content-type':'multipart/form-data'
                    }
                  }
                  let formData = new FormData();

                  formData.append('image',this.image);
                  formData.append('name',this.name);
                  formData.append('description',this.description);
                  formData.append('category_id',this.category);
                  axios.post('/albums/store',formData,config).then((response)=>{
                        this.image= '';
                        this.name= '';
                        this.category= '';
                        this.description= '';
                        this.albumId = response.data.id;

                        this.success = true;


                  }).catch((error)=>{
                    console.log(error);
                    this.allErrors= error.response.data.errors
                })
             },
             onImageChange(e){
                   this.image  = e.target.files[0];
             }
        }
    }
</script>

<style type="text/css">
    .danger{
        color: red ;
    }
</style>
