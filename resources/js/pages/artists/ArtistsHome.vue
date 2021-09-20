<template>
    <div>
        <div class="p-3 mb-2 ">
            <p class=" text-l text-gray-600">Click on a category to filter the items displayed by category</p>
            <span
                class="inline-flex items-center justify-center px-3 py-2 text-l font-bold leading-none text-gray-100 bg-gray-500 rounded ml-1"
                @click="setActiveGenre('')">All</span>
            <span
                class="inline-flex items-center justify-center px-3 py-2 text-l font-bold leading-none text-gray-100 bg-gray-500 rounded ml-1 mt-1"
                v-for="genre in this.genres" :key="genre.id"
                @click="setActiveGenre(genre.name)">{{ genre.name }}</span>

        </div>
        <div class="grid gap-4 md:grid-cols-3 md:grid-cols-1 px-4 pb-4" v-if="this.artists.length">
            <!--            <div class="w-2/7 m-2  "  >-->
            <ArtistTemplate v-bind:artist=artist v-for="artist in this.artists"
                            :key="artist.id"></ArtistTemplate>
            <!--            </div>-->
        </div>
        <div v-else class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md"
             role="alert">
            <div class="flex">
                <div class="py-1">
                    <svg class="fill-current h-6 w-6 text-teal-500 mr-4" xmlns="http://www.w3.org/2000/svg"
                         viewBox="0 0 20 20">
                        <path
                            d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z"/>
                    </svg>
                </div>
                <div>
                    <p class="font-bold">Notification</p>
                    <p class="text-sm">No Artists Available currently</p>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import ArtistTemplate from "./ArtistTemplate";
import axios from "axios";

export default {
    name: "ArtistsHome.vue",
    components: {ArtistTemplate},

    mounted() {
        this.$store.dispatch('getAllArtists');
        this.fetchGenres()
    },
    data() {
        return {
            genres: [],
            activeGenre: ''
        }
    },
    computed: {
        artists() {
            if (this.activeGenre?.length > 0) {
                return this.$store.getters.getAllArtists.filter((artist) => artist.genres.filter(genre => genre.name == this.activeGenre).length > 0)
            } else {
                return this.$store.getters.getAllArtists
            }
        },
    },

    methods: {
        fetchGenres() {
            axios.get(`/api/artists/genres`)
                .then(response => {
                    console.log(response)
                    this.genres = response.data.data
                }).catch(e => {
                console.log(e)
            })
        },

        setActiveGenre(genre_name) {
            console.log('this is the active genre', genre_name)
            this.activeGenre = genre_name

        }
    }
}
</script>

<style scoped>

</style>
