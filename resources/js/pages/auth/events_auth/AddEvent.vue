<template>
    <div>
        <form class="w-full max-w-lg" enctype="multipart/form-data">
            <div class="flex flex-wrap -mx-3 mb-6">
                <div class="w-full md:w-2/2 px-3 mb-6 md:mb-0">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                           for="grid-event-name">
                        Event Name
                    </label>
                    <input
                        class="appearance-none block w-full bg-gray-200 text-gray-700 border border-red-500 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                        id="grid-event-name" type="text" placeholder="" v-model="form.event">
<!--                    <p class="text-red-500 text-xs italic">Please fill out this field.</p>-->
                </div>

            </div>

            <div class="flex flex-wrap -mx-3 mb-6">

                <div class="w-full md:w-2/2 px-3 mb-6 md:mb-0">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                           for="grid-location-name">
                        Event Location and Time
                    </label>
                    <input
                        class="appearance-none block w-full bg-gray-200 text-gray-700 border border-red-500 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                        id="grid-location-name" type="text" placeholder="" v-model="form.location">
                    <!--                    <p class="text-red-500 text-xs italic">Please fill out this field.</p>-->
                </div>
            </div>


            <div class="flex flex-wrap -mx-3 mb-2">
                <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="start-date">
                        Start Date
                    </label>
                    <input
                        class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                        id="start-date" type="date" placeholder="Albuquerque" v-model="form.startDate">
                </div>
                <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="end-date">
                        End Date
                    </label>
                    <input
                        class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                        id="end-date" type="date" placeholder="Albuquerque" v-model="form.endDate">
                </div>


            </div>

            <div class="flex flex-wrap -mx-3 mb-2">
                <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-vvip">
                        VVIP
                    </label>
                    <input
                        class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                        id="grid-vvip" type="number" placeholder="Ksh" v-model="form.vvip">
                </div>
                <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-vip">
                        VIP
                    </label>
                    <input
                        class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                        id="grid-vip" type="number" placeholder="Ksh" v-model="form.vip">
                </div>
                <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                           for="grid-regular">
                        Regular
                    </label>
                    <input
                        class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                        id="grid-regular" type="number" placeholder="Ksh" v-model="form.regular">
                </div>
            </div>

            <div class="flex flex-wrap -mx-3 mb-6">
                <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                           for="grid-image">
                        Event Cover Image
                    </label>
                    <input
                        class="appearance-none block w-full bg-gray-200 text-gray-700 border border-red-500 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                        id="grid-image" type="file" placeholder="Pick an Image" @change="imageChanged">
                    <!--                    <p class="text-red-500 text-xs italic">Please fill out this field.</p>-->
                </div>
            </div>
            <div class="mb-2">
                <p>By creating an event, you agree to our <a href="/terms" class="text-blue-600">Terms and conditions</a> </p>

            </div>

            <button
                class="shadow bg-blue-500 hover:bg-purple-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded"
                type="button" @click="addEvent">
                Add
            </button>

        </form>
    </div>
</template>

<script>
    import axios from 'axios'

    export default {
        name: "AddEvent",
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
            addEvent() {
                if (this.form.event == null || this.form.location == null || this.form.startDate == null) {
                    this.error = true
                } else {
                    this.wait = true
                    this.$store.dispatch('addEvent', this.form)
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
