<template>
    
    <div>
        <CoolLightBox :items="items" :index="index" @close="index = null"></CoolLightBox>
    <div class="images-wrapper">
      <div
        class="image"
        v-for="(image, imageIndex) in items"
        :key="imageIndex"
        @click="index = imageIndex"
        :style="{ backgroundImage: 'url(' + image + ')' }"
      ></div>
    </div>

    </div>
    
</template>

<script>


export default({
    props:['img_path','slug','album_id'],

  data(){
    return {
         items:[],
         options:[{closeText : 'X'}],
         index:null,
    }
  },
      mounted(){
          return (this.getImage())
      },
  methods:{
     getImage(){

            
            axios.get(`/images/album/${this.slug}/${this.album_id}`,{  params: {
   slug:`${this.slug}`,
   album_id:`${this.album_id}`
  }}).then((response)=>{
                  
                let image_arr = response.data.images;
                
                image_arr.forEach((value,key)=>{
                   // console.log(value);
                     this.items.push(`${this.img_path}${value.image}`);
                     
                });

            }).catch((error)=>{
                 console.log(error);
            });
            

     },
     
  }
})
</script>
