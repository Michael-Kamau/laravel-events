<template>
    <div>
        <div class="w-full p-4">
            <form class="w-full max-w-lg" enctype="multipart/form-data">
                <div class="flex flex-wrap -mx-3 mb-6">
                    <div class="w-full md:w-2/2 px-3 mb-6 md:mb-0">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                               for="grid-event-name">
                            Venue Name
                        </label>
                        <input
                            class="appearance-none block w-full bg-gray-200 text-gray-700 border border-red-500 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                            id="grid-event-name" type="text" placeholder="" v-model="form.name">
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

                <div class="flex items-center justify-between">
                    <button
                        class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                        type="button" @click="closeModal">
                        Cancel
                    </button>

                    <button
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                        type="button" @click="editVenue">
                        Edit
                    </button>
                </div>
            </form>

        </div>
    </div>
</template>

<script>
    export default {
        name: "EditVenue",
        props: ['venue'],

        data() {
            return {
                form: {
                    id: this.venue.id,
                    name: this.venue.name,
                    location: this.venue.location,
                    description: this.venue.description
                }
            }
        },

        methods: {
            closeModal() {
                this.$emit('close-modal');
            },
            editVenue() {

            },

            imageChanged(e) {
                console.log(e.target.files[0])
                let fileReader = new FileReader()
                fileReader.readAsDataURL(e.target.files[0])

                fileReader.onload = (e) => {
                    this.form.image = e.target.result
                }

            },
        }
    }
</script>

<style scoped>

</style>
