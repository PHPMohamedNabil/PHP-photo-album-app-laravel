<template>
    <div>
        <div class="row">
            <div class="card-body">
               <div class="text-center">
                   <img :src="'/storage/'+user_img" width="70%"/>
               </div>
              <form @submit.prevent="updateProfilePic" method="post" enctype="multipart/form-data">
                  <div class="form-group">
                        <input class="form-control" name="file" type="file"  v-on:change="onImageChange"/>
                  </div>
                  <div class="form-group">
                      <button class="btn btn-primary" type="submit">Update</button>
                  </div>
              </form>
            </div>
        </div> 
    </div>
</template>
<script>

export default{
    props:['userdata'],
    data(){
        return {
            image:'',
            user_img:''
        }
    },
    mounted(){
         this.getUserAvatar();
    },
    methods:{
         updateProfilePic(){
           //  console.log(e);
              const config = {
                    headers:{
                        'content-type':'multipart/form-data'
                    }
                  }
                  let formData = new FormData();

                  formData.append('image',this.image);

                  axios.post('/profilepic',formData,config).then((response)=>{ 
                         
                         this.image = this.getUserAvatar();
                  }).catch((error)=>{alert(error)});
                  
         },
         onImageChange(e){
                   this.image  = e.target.files[0];
             },
         getUserAvatar(){
                  axios.get('/user/'+this.userdata).then((response)=>{
                       this.user_img=response.data.substr(7);
                  }).catch((error)=>{alert(error)});
         }
    }
}
</script>
