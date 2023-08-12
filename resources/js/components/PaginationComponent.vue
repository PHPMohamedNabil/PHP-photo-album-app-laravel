<template>
    <div>
<nav aria-label="Page navigation example">
  <ul class="pagination">
    <li class="page-item" :class="{'disabled':meta.current_page==1}"><a class="page-link" href="#" @click.prevent="changePage(meta.current_page - 1)">Previous</a></li>
    <li class="page-item"  v-for="page in meta.last_page" :class="{'active':meta.links[page].active == true}">
        <a class="page-link" href="#" @click.prevent="changePage(page);">{{page}}</a>
    </li>
    <li class="page-item" :class="{'disabled':meta.last_page==meta.current_page}"><a class="page-link" href="#" @click.prevent="changePage(meta.current_page + 1)">Next</a></li>
  </ul>
</nav>

    </div>
    
</template>
<script>
    export default{
        props:['meta'],
        methods:{
            changePage(page){
                if(page <=0  || page > this.meta.last_page){
                    return
                }
                this.$emit('pagination',page);
            }
        }

    
    }
</script>
