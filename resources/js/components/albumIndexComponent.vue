<template>
	<div>
		<table class="table table-striped">
			<thead>
				<tr>
					<th scope="col">Image</th>
					<th scope="col">Name</th>
					<th scope="col">Description</th>
					<th scope="col">Category</th>
					<th scope="col">settings</th>
				</tr>
			</thead>
			<tbody>
				<tr v-for="(value,index) in albums" :key="index">
					<td class="w-25">
						<img :src="/album/+value.image" class="img-thumbnail"/>
					</td>
					<td>
						{{value.name}}
					</td>
					<td>
						{{value.description}}
					</td>
					<td>
						{{value.category.name}}
					</td>
					<td>
						<!-- Button trigger modal -->
					  <a :href="'/albums/'+value.slug+'/'+value.id" class="btn btn-info btn-sm">View</a>
                      <button type="button" @click.prevent="edit(value.id)" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                        Edit
                      </button>
                      <button type="button" class="btn btn-danger" @click.prevent="deleteRecorde(value.id)">
                      	Delete
                      </button>
					  <a class="btn btn-success btn-sm" :href="'upload/images/'+value.id">
						  Upload Images
					  </a>
					</td>
				</tr>
			</tbody>
		</table>
		<pagination :meta="meta" v-on:pagination="getAlbums"></pagination>
		<albumEdit :editData="album" @updateRecorde="updateRecorde"></albumEdit>
	</div>
</template>

<script type="text/javascript">
	export default{
		data(){
            return{
            	albums:[],
            	album:[],
				meta:[],
            }
		},
		created(){
            
            this.getAlbums(); 
		},
		methods:{
			getAlbums(page){
				axios.get('/albums/get/',{params:{page}}).then((response)=>{
                    this.albums = response.data.data;
					this.meta   = response.data.meta; 
            }).catch((error)=>{
                   console.log(error);
            });
			},
			 edit(id){
			 	axios.get('/api/albums/'+id).then((response)=>{
                     this.album = response.data;     
			 	}).catch((error)=>{
                    
			 	});
			 },
			 updateRecorde(response)
			 {
			 	this.albums=response.data
			 },
			 deleteRecorde(albumId){
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
                        		axios.delete('/album/'+albumId+'/delete').then((response)=>{
                                           Swal.fire({
                                       position: 'center',
                                       icon: 'success',
                                       title: 'Your changes has been saved',
                                       showConfirmButton: false,
                                       timer: 1500
                                     });
                                     this.albums = response.data;   
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
	
</style>