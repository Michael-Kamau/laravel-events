<template>
    <div class="p-4">
        <div class="max-w-md mx-auto bg-white rounded-xl shadow-md overflow-hidden md:max-w-2xl mb-4">
            <div class="md:flex flex-col">
                <div class="p-8">
                    <div class="uppercase tracking-wide text-sm text-indigo-500 font-semibold">{{booking.name}}</div>
                    <a href="#" class="block mt-1 text-lg leading-tight font-medium text-black hover:underline">{{booking.location}}</a>
                    <p class="mt-2 text-gray-500">{{booking.description}}.</p>
                </div>
            </div>
        </div>
        <div class="w-full md:w-2/2 px-3 mb-6 md:mb-0" v-if="booking.status === 'submitted'">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                   for="grid-charges">
                Venue Charges
            </label>
            <input
                class="appearance-none block w-full bg-gray-200 text-gray-700 border border-red-500 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                id="grid-charges" type="text" placeholder="" v-model="form.amount">
            <!--                    <p class="text-red-500 text-xs italic">Please fill out this field.</p>-->
        </div>
        <div>

        </div>

        <div class="flex items-center justify-between">
            <button
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                type="button" @click="bookingAction('confirmed')" v-if="booking.status === 'submitted'">
                Confirm
            </button>

            <button
                class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline "
                type="button" @click="bookingAction('rejected')" v-if="booking.status === 'submitted'">
                Reject
            </button>

            <button
                class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                type="button" @click="closeModal">
                Cancel
            </button>
        </div>
    </div>
</template>

<script>
    import axios from "axios";

    export default {
        name: "BookingActions",

        props: ['booking'],

        data() {
            return {
                form: {
                    id: this.booking.id,
                    venue_id: this.$route.params.id,
                    amount:0
                }
            }

        },

        methods: {
            closeModal() {
                this.$emit('reload-bookings');
                this.$emit('close-modal');
            },

            bookingAction(action) {
                this.form.status = action
                console.log(this.form)
                axios.post(`/api/venues/bookingActions`, this.form)
                    .then(response => {
                        console.log(response.data)
                        this.closeModal();
                        resolve(response)
                    }).catch(e => {
                    reject(e)
                    console.log(e)
                })
            }
        }
    }
</script>

<style scoped>

</style>
