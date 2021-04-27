<template>
    <div class="p-4 bg-white">
<!--        <h1>Terms and conditions</h1>-->


        <div v-if="generalTerms.length>0">
            <p><span v-html="generalTerms[0].content"></span></p>
        </div>

    </div>

</template>

<script>
    import axios from "axios";

    export default {
        name: "TermsAndConditions",

        mounted() {
            axios.get(`/api/terms`, this.form)
                .then(response => {
                    this.terms=response.data.data
                }).catch(e => {
                reject(e)
                console.log(e)
            })
        },


        data(){
            return{
                terms:[]
            }
        },

        computed:{

            generalTerms(){
                return this.terms.filter(term=>term.slug == "general")
            }
        }
    }
</script>

<style scoped>

</style>
