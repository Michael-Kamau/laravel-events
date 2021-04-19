<template>
    <div class="p-2">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-2 border-b border-gray-300 mb-2 w-full">
            <div class="rounded overflow-hidden shadow " v-for="video in artist.videos" :key="video.id">
                <VideoFrame v-bind:url="video.url"></VideoFrame>

            </div>
        </div>




        <div class="flex items-center justify-between">
            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full"
                    @click="closeModal">
                Close
            </button>

        </div>
    </div>
</template>

<script>
    import VideoFrame from "../partials/VideoFrame";
    export default {
        name: "ArtistVideos",
        props: ['artist'],
        components: {VideoFrame},
        data() {
            return {
                form: {
                    artistId: this.artist.id
                },
                loading: false
            }
        },
        methods: {
            closeModal() {
                this.$emit('close-modal');
            },
        }
    }
</script>

<style scoped>
</style>
