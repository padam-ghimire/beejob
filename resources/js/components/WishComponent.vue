<template>
    <div>


         <button v-if="wished" @click.prevent='unWish()' class="btn btn-outline-info btn-block"> Remove from wish</button>
         <button v-else @click.prevent='wish()' class="btn btn-outline-dark btn-block"> Add to wish list </button>

    </div>
</template>

<script>
    export default {
        props:['jobid','ifwish'],
        data(){
            return{
                'wished':true
            }

        },
        mounted() {
            this.wished= this.ifWished ? true:false
        },

        computed:{
            ifWished(){
                return this.ifwish;
            }
        },

        methods:{
            wish(e){
               axios.post('/jobs/wish/'+ this.jobid).then(response=>this.wished=true).catch(error=>console.log(error));
            },
            unWish(e){
               axios.post('/jobs/unwish/'+ this.jobid).then(response=>this.wished=false).catch(error=>console.log(error));


            }
        }
    }
</script>
