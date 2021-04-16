<template>
    <div class="p-2">
        <div class="flex flex-wrap -mx-3 mb-6">
            <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                       for="grid-image">
                    Your Cover Image
                </label>
                <input
                    class="appearance-none block w-full bg-gray-200 text-gray-700 border border-red-500 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                    id="grid-image" type="file" placeholder="Pick an Image" @change="imageChanged">
                <!--                    <p class="text-red-500 text-xs italic">Please fill out this field.</p>-->
            </div>
        </div>
        <div class="flex items-center justify-between">
            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full"
                    @click="closeModal">
                Cancel
            </button>

            <button class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-full" @click="editImage">
                Save
            </button>


        </div>
    </div>
</template>

<script>
    import axios from "axios";

    export default {
        name: "EditImageModal",
        props: ['artist'],

        data() {
            return {
                form: {
                    id:this.artist.id
                },
                error: null,
                success: null,
                wait: null
            }

        },


        methods:{
            closeModal() {
                this.$emit('close-modal');
            },

            imageChanged(e) {
                console.log(e.target.files[0])
                let fileReader = new FileReader()
                fileReader.readAsDataURL(e.target.files[0])

                fileReader.onload =(e)=>{
                    this.form.image=e.target.result
                }

            },

            editImage(){
                axios.post(`/api/artists/saveImage`, this.form)
                    .then(response => {
                        console.log(response)
                        this.$store.dispatch('getUserArtist')
                        this.closeModal()
                    }).catch(e => {
                })

            }
        }
    }
</script>

<style scoped>

</style>
