<template>
    <div>

        <form @submit="applyJob">
         <button v-if="applied==false" type="submit" class="btn btn-success btn-block">APPLY NOW</button>

         <div v-else class="alert alert-success">
             Application sent successfully.
         </div>
        </form>
        
    </div>
</template>

<script>
    export default {
        props:['jobid','job'],
        mounted() {
            console.log('Component mounted.')
        },
        data(){
            return{
                'applied':false
            }

        },
        methods:{
            applyJob(e){
                e.preventDefault();
                axios.post('/jobs/apply/'+this.jobid+'/'+this.job,{

                }).then((response)=>{
                    this.applied=true
                })
            }
        }
    }
</script>
