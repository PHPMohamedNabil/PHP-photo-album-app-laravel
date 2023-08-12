<template>
    <div>
        <div class="row">
            <div class="card-body">
               <div class="text-center">
                   <img :src="'/storage/'+bgimg" width="70%"/>
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
            bgimg:''
        }
    },
    mounted(){
         this.getuserBg();
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

                  axios.post('/backgroundpic',formData,config).then((response)=>{ 
                         
                         this.image = this.getuserBg();
                  }).catch((error)=>{alert(error)});
                  
         },
         onImageChange(e){
                   this.image  = e.target.files[0];
             },
         getuserBg(){
                  axios.get('/user/background/'+this.userdata).then((response)=>{
                       this.bgimg=response.data.substr(7);
                  }).catch((error)=>{alert(error)});
         }
    }
}
</script>
