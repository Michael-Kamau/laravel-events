<template>
    <div>
        <form class="w-full max-w-lg" enctype="multipart/form-data">
            <div class="flex flex-wrap -mx-3 mb-6">
                <div class="w-full md:w-2/2 px-3 mb-6 md:mb-0">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                           for="grid-event-name">
                        Venue Name
                    </label>
                    <input
                        class="appearance-none block w-full bg-gray-200 text-gray-700 border border-red-500 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                        id="grid-event-name" type="text" placeholder="" v-model="form.venue">
                    <!--                    <p class="text-red-500 text-xs italic">Please fill out this field.</p>-->
                </div>

            </div>

            <div class="flex flex-wrap -mx-3 mb-6">

                <div class="w-full md:w-2/2 px-3 mb-6 md:mb-0">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                           for="grid-location-name">
                        Venue Location
                    </label>
                    <input
                        class="appearance-none block w-full bg-gray-200 text-gray-700 border border-red-500 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                        id="grid-location-name" type="text" placeholder="" v-model="form.location">
                    <!--                    <p class="text-red-500 text-xs italic">Please fill out this field.</p>-->
                </div>
            </div>


            <div class="flex flex-wrap -mx-3 mb-6">

                <div class="w-full md:w-2/2 px-3 mb-6 md:mb-0">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                           for="grid-location-name">
                        Venue Description
                    </label>
                    <input
                        class="appearance-none block w-full bg-gray-200 text-gray-700 border border-red-500 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                        id="grid-description" type="text" placeholder="" v-model="form.description">
                    <!--                    <p class="text-red-500 text-xs italic">Please fill out this field.</p>-->
                </div>
            </div>

            <div class="flex flex-wrap -mx-3 mb-6">

                <div class="w-full md:w-2/2 px-3 mb-6 md:mb-0">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                           for="grid-location-name">
                        Venue Charges
                    </label>
                    <input
                        class="appearance-none block w-full bg-gray-200 text-gray-700 border border-red-500 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                        id="grid-charges" type="text" placeholder="" v-model="form.charges">
                    <!--                    <p class="text-red-500 text-xs italic">Please fill out this field.</p>-->
                </div>
            </div>


            <div class="flex flex-wrap -mx-3 mb-6">
                <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                           for="grid-image">
                        Venue Cover Image
                    </label>
                    <input
                        class="appearance-none block w-full bg-gray-200 text-gray-700 border border-red-500 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                        id="grid-image" type="file" placeholder="Pick an Image" @change="imageChanged">
                    <!--                    <p class="text-red-500 text-xs italic">Please fill out this field.</p>-->
                </div>
            </div>

            <button
                class="shadow bg-blue-500 hover:bg-purple-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded"
                type="button" @click="addVenue">
                Add
            </button>

        </form>
    </div>
</template>

<script>
    export default {
        name: "AddVenue",
        data() {
            return {
                form: {},
                error: null,
                success: null,
                wait: null
            }

        },

        methods: {
            imageChanged(e) {
                console.log(e.target.files[0])
                let fileReader = new FileReader()
                fileReader.readAsDataURL(e.target.files[0])

                fileReader.onload =(e)=>{
                    this.form.image=e.target.result
                }

            },
            addVenue() {
                if (this.form.venue == null || this.form.location == null || this.form.description == null || this.form.charges == null) {
                    this.error = true
                } else {
                    this.wait = true
                    this.$store.dispatch('addVenue', this.form)
                        .then(response => {
                            this.success = "success"
                            this.form = {}
                            this.wait = false
                        })
                }
            }
        }
    }
</script>

<style scoped>

</style>
