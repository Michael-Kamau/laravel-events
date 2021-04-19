<template>
    <div>
        <div class="grid gap-4 md:grid-cols-3 md:grid-cols-1 p-4" v-if="this.$store.getters.getAllArtists.length">
            <!--            <div class="w-2/7 m-2  "  >-->
            <ArtistTemplate v-bind:artist=artist v-for="artist in this.$store.getters.getAllArtists" :key="artist.id"></ArtistTemplate>
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
    export default {
        name: "ArtistsHome.vue",
        components: {ArtistTemplate},

        mounted() {
            this.$store.dispatch('getAllArtists');
        }
    }
</script>

<style scoped>

</style>
