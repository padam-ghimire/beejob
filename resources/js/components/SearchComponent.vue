
<template>
 <div>
  <input type="text" placeholder="Search from millions jobs" v-model="keyword" v-on:keyup="search" class="form-control">
  <div class="card-footer" v-if="results.length">
    <ul class="list-group">
        <li class="list-group-item" v-for="result in results" :key="result.id">
            <a style="color:#000;" :href=" '/jobs/' + result.id +'/'+result.slug+'/'  ">{{result.title}}
                <br>
                <span class="badge badge-info">{{result.position}}</span>
            </a>
            
        </li>
    </ul>
  </div>
  
  
  
 </div>
</template>


<script>
 export default{
  data(){
    return{
        keyword:'',
        results:[],
    }
  },
  methods: {
   search(){
    this.results = [];
    if(this.keyword.length>1){
        axios.get('/jobs/search',{params:{keyword:this.keyword}}).then(response=>{
            this.results = response.data;
        });
    }
    
  }
 }
}
</script>