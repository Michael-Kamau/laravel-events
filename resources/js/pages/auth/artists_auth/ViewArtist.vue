<template>
    <div v-if="this.$store.getters.getUserArtists" class="m-2 p-4 rounded-lg shadow">
        <h1 class="text-3xl font-bold pt-8 lg:pt-0 text-gray-700">Profile</h1>

        <div class="md:flex">
            <div class="w-full md:w-2/5 h-auto ">
                <img class="max-w-full h-auto rounded"
                     :src="'/images/artistImages/' +artist.image"
                     alt="">
                <button class="w-full bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded" @click="showModal('edit-image-modal')">
                    Edit Image
                </button>
            </div>

            <div class="p-2 w-full md:w-3/5 ">
                <p class="text-2xl font-bold pt-8 lg:pt-0 text-gray-700">{{artist.name}}</p>
                <label class="block">
                    <span class="text-gray-700">Edit Username</span>
                    <input class="form-input mt-1 block w-full" v-model="artist.name" placeholder="New username">
                </label>

                <label class="block">
                    <span class="text-gray-700">Description</span>
                    <textarea class="form-textarea mt-1 block w-full p-2" rows="3"
                              v-model="artist.description"></textarea>
                </label>


                <div class="md:flex justify-between">
                    <h1 class="text-1xl font-bold pt-8 lg:pt-0 text-gray-700">Categories ( The categories of songs you
                        perform )</h1>
                    <div>
                        <label class="text-1xl font-bold pt-8 lg:pt-0 text-gray-700 " for="genre">Add category:</label>

                        <select name="genre" id="genre" v-model="form.genre" @change="genreActions('add', $event)">
                            <option v-for="genre in genres" :value="genre.id">{{genre.name}}</option>

                        </select>

                        <!--                        <button-->
                        <!--                            class="bg-blue-500 text-white active:bg-blue-600 font-bold uppercase text-xs px-2 py-1 rounded-full shadow hover:shadow-md outline-none focus:outline-none mr-1 mb-1"-->
                        <!--                            type="button" style="transition: all .15s ease" @click="genreActions('add')">-->
                        <!--                            <i class="fa fa-plus-circle"></i>-->
                        <!--                        </button>-->
                    </div>


                </div>
                <div class="shadow p-1 rounded flex flex-wrap space-x-2">
                    <p class="rounded-full bg-gray-400 p-1 w-auto " v-for="genre in artist.genres"
                       @click="genreActions('remove', genre)"> {{genre.name}} <i
                        class="fa fa-times"
                        aria-hidden="true"></i></p>

                </div>

                <div class="p-2">
                    <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-full"
                            @click="showModal('videos-modal')">
                        <i class="fa fa-youtube" aria-hidden="true"></i> Videos {{artist.videos.length}}
                    </button>

                </div>

                <div class="p-2">
                    <button class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-full"
                            @click="editArtist()">
                        Save
                    </button>

                </div>


<!--                <div class="flex">-->

<!--                    <div class="pt-12 pb-8 mx-2 justify-center">-->
<!--                        <button class="bg-yellow-700 hover:bg-yellow-900 text-white font-bold py-2 px-4 rounded-full">-->
<!--                            1-->
<!--                        </button>-->
<!--                        <p class="text-gray-700 text-center font-bold">Bookings</p>-->
<!--                    </div>-->

<!--                    <div class="pt-12 pb-8 mx-2 justify-center">-->
<!--                        <button class="bg-blue-700 hover:bg-blue-900 text-white font-bold py-2 px-4 rounded-full">-->
<!--                            1-->
<!--                        </button>-->
<!--                        <p class="text-gray-700 text-center font-bold">confirmed</p>-->
<!--                    </div>-->

<!--                    <div class="pt-12 pb-8 mx-2 justify-center">-->
<!--                        <button class="bg-green-700 hover:bg-green-900 text-white font-bold py-2 px-4 rounded-full">-->
<!--                            1-->
<!--                        </button>-->
<!--                        <p class="text-gray-700 text-center font-bold">Paid</p>-->
<!--                    </div>-->


<!--                </div>-->

            </div>
        </div>


        <modal name="videos-modal" height="auto" width="95%" :scrollable="true">
            <div>
                <ArtistVideos v-bind:artist="artist" @close-modal="hideModal('videos-modal')"/>
            </div>
        </modal>

        <modal name="edit-image-modal" height="auto" width="95%" :scrollable="true">
            <div>
                <EditImageModal v-bind:artist="artist" @close-modal="hideModal('edit-image-modal')"/>
            </div>
        </modal>


    </div>
</template>

<script>
    import axios from "axios";
    import ArtistVideos from "./modals/ArtistVideos";
    import {shallowEqual} from "../../../globals/functions";
    import EditImageModal from "./modals/EditImageModal";

    export default {
        name: "ViewArtist",
        components: {EditImageModal, ArtistVideos},
        mounted() {
            this.artistProfile()
            this.fetchGenres()

        },

        data() {
            return {
                genres: [],
                form: {}
            }

        },


        computed: {
            artist() {
                return this.$store.getters.getUserArtists
            }

        },

        methods: {
            showModal(modal, id) {
                this.$modal.show(modal);
            },
            hideModal(modal) {
                this.$modal.hide(modal);
            },
            fetchGenres() {
                axios.get(`/api/artists/genres`)
                    .then(response => {
                        this.genres = response.data.data
                    }).catch(e => {
                    console.log(e)
                })
            },

            genreActions(action, genreNew) {
                switch (action) {
                    case 'add':
                        let newGenre = this.artist.genres.filter(genre => genre.id == genreNew.target.value)
                        if (newGenre.length === 0) {

                            newGenre = this.genres.filter(genre => genre.id == genreNew.target.value)
                            this.artist.genres = [...this.artist.genres, ...newGenre]
                            console.log()
                        }

                        break;
                    case 'remove':
                        console.log('genreActions function ', genreNew)
                        this.artist.genres = this.artist.genres.filter(genre => genre.id !== genreNew.id)

                        break;
                }


            },

            artistProfile() {
                this.$store.dispatch('getUserArtist')
            },

            createPayload() {
                let {id, name, description} = this.artist
                this.form = {
                    id,
                    name,
                    description,
                    genres: this.artist.genres.map((genre) => genre.id)
                }

            },

            editArtist() {
                this.createPayload()
                if (false) {
                    this.error = true
                } else {

                    console.log('Object data sent', this.form)
                    this.wait = true
                    this.$store.dispatch('editArtist', this.form)
                        .then(response => {
                            this.artistProfile()
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
