<template>
	
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form @submit.prevent="updateAlbum" action="" enctype="multipart/form-data" v-if="!success">
           <div class="form-group">
            
               <label>Name of Album</label>
               <input type="text" name="name" class="form-control" v-model="editData.name" maxlength="15">
               <span v-if="allErrors.name" :class="['danger']">
                   {{allErrors.name[0]}}
               </span>
           </div>
           <div class="form-group">
               <label>Description of Album</label>
               <textarea class="form-control description" v-model="editData.description" maxlength="200" name="description"></textarea>
               <span v-if="allErrors.description" :class="['danger']">
                   {{allErrors.description[0]}}
               </span>
           </div>
           <div class="form-group">
               <label>Category of Album</label>
               <select name="category_id" class="form-control" v-model="editData.category_id">
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
               <button class="btn btn-primary mt-2" type="submit">Save</button>
           </div>
       </form>
      </div>
    </div>
  </div>
</div>
</template>

<script type="text/javascript">
	export default{
		props:['editData'],
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
             updateAlbum(){
                 const config = {
                    headers:{
                        'content-type':'multipart/form-data'
                    }
                  }
                  let formData = new FormData();

                  formData.append('image',this.image);
                  formData.append('name',this.editData.name);
                  formData.append('description',this.editData.description);
                  formData.append('category_id',this.editData.category_id);
                  formData.append('_method',"put");

                  axios.post('/albums/'+this.editData.id+'/edit',formData,config).then((response)=>{
                  	   $('#exampleModal').modal('hide');
                  	   this.$emit('updateRecorde',response);
                  	    Swal.fire({
                          position: 'center',
                          icon: 'success',
                          title: 'Your changes has been saved',
                          showConfirmButton: false,
                          timer: 1500
                        });
                  	  
                  }).catch((error)=>{
                  	console.log(error);
                  	   this.allErrors= error.response.data.errors;
                  	 
                  });
             },
              onImageChange(e){
                   this.image  = e.target.files[0];
             }
		}
	}
</script>
<style type="text/css">
	
</style>