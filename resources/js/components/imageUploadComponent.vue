<template>
	<div>
		 <span v-if="allErrors.files" :class="['danger']">
                   {{allErrors.files[0]}}
               </span>
		<form action="" method="post" enctype="multipart/form-data">
			<div class="form-group files text-center " ref="fileform">
				<input type="file" name="" ref="file" multiple="">
				<span id="val"></span>
				<a class="btn btn-secondary" @click.prevent="submitFiles()">upload</a>
			</div>
		</form>
		<progress max="100" style="width: 100%" :value.prop="uploadPercentage" v-if="uploading"></progress> <span v-if="uploading">{{uploadPercentage}}%</span>
		<div class="container">
            <hr class="mt-2 mb-5">
			<div class="row text-center text-lg-left">
			      <div class="col-lg-3 col-md-4 col-6" v-for="(image,index) in Images" :key="index">
                       <a href="#">
						   <img :src="'/images/'+image.image" class="img-fluid img-thumbnail"/>
						   <button class="btn btn-danger btn-sm" @click.prevent="DeleteImage(image.id)">Delete</button>
					   </a>
			     </div>
		</div>
	</div>
	</div>
</template>

<script type="text/javascript">
	export default{
		props:['album_id'],
		data(){
			return {
				  uploading:false,
				  uploadPercentage:0,
				  Images:[],
				  allErrors:[],
			}
		},
		mounted(){
			this.getImage();
		},
		methods:{
			submitFiles(){
				  
                  let formData = new FormData();

                  let images   = this.$refs.file.files;
                     console.log(images);

					 Object.entries(images).forEach(
						
                            ([key, file]) =>  formData.append(`files[${key}]`,file)
                        )
						
 
                  formData.append('album_id',this.album_id);
                  this.uploading=true;
				  this.$refs.file.value='';
                  axios.post('/upload/image',formData,{
                    headers:{
                        'content-type':'multipart/form-data'
                    },
					onUploadProgress:function(progressEvent){
						this.uploadPercentage = parseInt(Math.round((progressEvent.loaded*100)/progressEvent.total));
					}.bind(this)
                  }).then((response)=>{
                          Swal.fire({
                                       position: 'center',
                                       icon: 'success',
                                       title: 'Photos now Uploaded Successfully',
                                       showConfirmButton: false,
                                       timer:2000
                                     });
						
						   this.uploading=false;
						   this.uploadPercentage=0;
						   this.getImage();
				  
                  }).catch((error)=>{
                  	                 
                  	                   Swal.fire({
                                       position: 'center',
                                       icon: 'error',
                                       title: 'try to upload again',
                                       showConfirmButton: false,
                                       timer:2000
                                     });
									 this.uploading=false;
						    this.uploadPercentage=0;
							   this.allErrors= error.response.data.errors
						   this.getImage();
                  	                                	 
                                  });


			},
			getImage(){
				axios.get('/getimages').then((response)=>{
                          this.Images = response.data
						  console.log(this.images);
				}).catch((error)=>{
					alert('error');
				})
			},
			DeleteImage(id){
				Swal.fire({
                          title: 'Are you sure',
                          icon: 'warning',
                          text: "you won't be able to revert this !",
                          showCancelButton: true,
                          confirmButtonColor:'#d33',
                          cancelButtonColor:'#3085d6',
                          confirmButtonText:'Yes,delete it'
                        }).then((result)=>{

                        	if(result.value){
                        		axios.delete('/image/'+id+'/delete').then((response)=>{
							
                                    Swal.fire({
                                       position: 'center',
                                       icon: 'success',
                                       title: 'Your changes has been saved',
                                       showConfirmButton: false,
                                       timer: 1500
                                     });
                                     this.getImage();
                        		}).catch((error)=>{
                  	                 
                  	                   console.log(error);
                  	                                	 
                                  });
                        	}
                        });

			}

		}
	}
</script>
<style type="text/css">
    .danger{
        color: red ;
    }
</style>