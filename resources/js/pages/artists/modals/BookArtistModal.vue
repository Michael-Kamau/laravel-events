<template>
  <div class="p-6">
    Book Artist
    <div
        class=" md:w-full  rounded-b lg:rounded-b-none lg:rounded-r sm:p-2 md:p-4  flex flex-col justify-between leading-normal">
      <div class="mb-8">
        <p class="text-sm text-gray-600 flex items-center">
          <svg class="fill-current text-gray-500 w-3 h-3 mr-2" xmlns="http://www.w3.org/2000/svg"
               viewBox="0 0 20 20">
            <path
                d="M4 8V6a6 6 0 1 1 12 0v2h1a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-8c0-1.1.9-2 2-2h1zm5 6.73V17h2v-2.27a2 2 0 1 0-2 0zM7 6v2h6V6a3 3 0 0 0-6 0z"/>
          </svg>
          Artist Booking Details
        </p>
        <div class="text-gray-900 font-bold text-xl mb-2">Artist Name : {{ artist.name }}</div>
        <p>After making an inquiry, the artist manager will be notified and will send you details of
          the event booking to your email address</p>

      </div>
      <form class="bg-white shadow-md rounded sm:px-8 md:px-8 pt-6 pb-8 mb-4">
        <div class="mb-4 mt-6">
          <label class="block  text-gray-700 text-sm font-bold mb-2" for="firstname">
            Firstname
          </label>
          <input
              class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
              id="firstname" type="text" placeholder="Firstname" v-model="form.firstname">
        </div>

        <div class="mb-4 mt-6">
          <label class="block  text-gray-700 text-sm font-bold mb-2" for="lastname">
            LastName
          </label>
          <input
              class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
              id="lastname" type="text" placeholder="Lastname" v-model="form.lastname">
        </div>

        <div class="mb-4 mt-6">
          <label class="block  text-gray-700 text-sm font-bold mb-2" for="email">
            Email
          </label>
          <input
              class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
              id="email" type="text" placeholder="email" v-model="form.email">
        </div>

        <div class="mb-4 mt-6">
          <label class="block  text-gray-700 text-sm font-bold mb-2" for="phone">
            Phone Number
          </label>
          <input
              class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
              id="phone" type="text" placeholder="+254..(safaricom line)" v-model="form.phone">
        </div>
        <div class="mb-4 mt-6">
          <label class="block  text-gray-700 text-sm font-bold mb-2" for="description">
            Description
          </label>
          <textarea
              class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
              id="description" type="textArea"
              placeholder="Time and other artist booking details or enquiries..."
              v-model="form.description" cols="250"></textarea>
        </div>
        <div class="mb-4 mt-6">
          <label class="block  text-gray-700 text-sm font-bold mb-2" for="book_date">
            Date
          </label>
          <input
              class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
              id="book_date" type="date" placeholder="date" v-model="form.book_date">
        </div>

        <div class="mb-4 mt-6">
          <label class="block text-left">
            <span class="text-gray-700">Event Type</span>
            <select class="form-select block w-full mt-1" v-model="form.type">
              <option value="private">Private</option>
              <option value="corporate">Corporate</option>
              <option value="charity">Charity</option>
              <option value="social">Social</option>
            </select>
          </label>

        </div>


        <div class="flex items-center justify-between">
          <button
              class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
              type="button" @click="closeModal">
            Cancel
          </button>

          <button
              class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
              type="button" @click="bookArtist">
            Make Inquiry
          </button>
        </div>

      </form>
    </div>

  </div>
</template>

<script>
import axios from "axios";
import {bus} from "../../../app";

export default {
  name: "BookArtistModal",

  props: ['artist'],

  data() {
    return {
      form: {}
    }
  },

  methods: {
    closeModal() {
      this.$emit('close-modal');
    },

    bookArtist() {
      this.form.id = this.$route.params.id;

      bus.$emit('loadingAction', {status: true})
      axios.post(`/api/artists/bookArtist`, this.form)
          .then(response => {
            console.log('Artist Booking response', response.data)
            if (response?.data?.success == true) {
              bus.$emit('successAction', {message: 'Enquiry sent successfully. Once the artist responds you will receive an email with the details.'})
            } else {
              bus.$emit('errorAction', {message: 'Error encountered making the booking. Please ensure all the fields are correctly filled then try again.'})
            }
            bus.$emit('loadingAction', {status: false})
            this.closeModal()
          }).catch(e => {
        bus.$emit('errorAction', {message: 'Error encountered making the booking. Please ensure all the fields are correctly filled then try again.'})

      })
    },
  }
}
</script>

<style scoped>

</style>
