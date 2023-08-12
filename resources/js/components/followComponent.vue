<template>
    <div>
       <button class="btn btn-primary ml-4" @click.prevent="followUser" v-text="buttonText"> Follow</button>
    </div>
</template>

<script>

export default{
    props:['user_id','follows'],
    data(){
        return {
            status:this.follows,

        }
    },
    methods:{
        followUser()
        {
            axios.post('/follow',{
                user_id:this.user_id
            }).then((response)=>{
                   this.status = !this.status;
            }).catch((error)=>{
                alert(error);
            });
        }
    },
    computed:{
        buttonText()
        {
            return (this.status) ?'Unfollow':'Follow';
        }
    }
}
</script>
