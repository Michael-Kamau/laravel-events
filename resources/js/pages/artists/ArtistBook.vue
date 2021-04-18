<template>
    <div class="m-2 p-4 rounded-lg shadow">
        <h1 class="text-3xl font-bold pt-8 lg:pt-0 text-gray-700">Artist Profile</h1>

        <div class="md:flex">
            <div class="w-full md:w-2/5 h-auto ">
                <img class="max-w-full h-auto rounded" :src="'/images/artistImages/' +artist.image" alt="">
            </div>

            <div class="p-2 w-full md:w-3/5 ">
                <h1 class="text-2xl font-bold pt-8 mb-2 lg:pt-0 text-gray-700">{{artist.name}}</h1>

                <h1 class="text-1xl font-bold pt-8 lg:pt-0 text-gray-700">Description</h1>
                <h6 class="p-1 mb-2">{{artist.description}}</h6>


                <div class="md:flex justify-between">
                    <h1 class="text-1xl font-bold pt-8 lg:pt-0 text-gray-700">Categories</h1>

                </div>
                <div class="shadow p-1 rounded flex flex-wrap space-x-2 py-3 m-2" >
                    <p class="rounded-full bg-gray-400 p-1 w-auto " v-for="genre in artist.genres" :key="genre.id"> {{genre.name}} </p>


                </div>
                <div class=" flex justify-between my-5">
                    <button class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded-full"
                            @click="showModal('videos-modal')">
                        <i class="fa fa-youtube" aria-hidden="true"></i> Videos {{artist.videos.length}}
                    </button>

                    <button class="h-10 px-2 text-indigo-100 transition-colors duration-150 bg-green-700 rounded-lg focus:shadow-outline hover:bg-green-800" @click="showModal('book-modal')">
                        <span class="mr-2">Book Artist</span>
                    </button>
                </div>

            </div>
        </div>


        <modal name="videos-modal" height="auto" width="95%" :scrollable="true">
            <div>
                <ArtistVideos v-bind:artist="artist" @close-modal="hideModal('videos-modal')"/>
            </div>
        </modal>

        <modal name="book-modal" height="auto" width="95%" :scrollable="true">
            <div>
                <BookArtistModal v-bind:artist="artist" @close-modal="hideModal('book-modal')"/>
            </div>
        </modal>


    </div>
</template>

<script>
    import {mapGetters, mapActions} from 'vuex';
    import ArtistVideos from "./modals/ArtistVideos";
    import BookArtistModal from "./modals/BookArtistModal";
    import axios from "axios";
    export default {
        name: "ArtistBook",
        components: {BookArtistModal, ArtistVideos},
        mounted() {
            this.getAllArtists();
        },

        computed: {

            artist(){
              return this.$store.getters.getAnArtist(this.$route.params.id)[0]
            },
        },

        methods:{

            showModal(modal) {
                this.$modal.show(modal);
            },
            hideModal(modal) {
                this.$modal.hide(modal);
            },

            ...mapActions([
                'getAllArtists'
            ])
        }

    }
</script>

<style scoped>

</style>
