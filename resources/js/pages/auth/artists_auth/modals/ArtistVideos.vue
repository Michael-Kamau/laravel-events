<template>
    <div class="p-2">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-2 border-b border-gray-300 mb-2 w-full">
            <div class="rounded overflow-hidden shadow " v-for="video in artist.videos" :key="video.id">
                <VideoFrame v-bind:url="video.url"></VideoFrame>
                <!--                <img class=" w-full h-64 object-cover"  :src="'/' +video.url " alt="Sunset in the mountains">-->
                <div class="content-center p-2">
                    <button class="btn-outline-red" type="button" @click="deleteVideo(video.id)">
                        delete
                    </button>
                </div>
            </div>
        </div>


        <div class="flex flex-wrap -mx-3 mb-6">
            <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="video">
                    Video Url
                </label>
                <input class="shadow appearance-none border border-red-500 rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" id="video" type="video" placeholder="https://youtube.com....." v-model="form.video">
            </div>
        </div>

        <div class="flex items-center justify-between">
            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full"
                    @click="closeModal">
                Cancel
            </button>

            <button class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-full"
                    @click="addImage">
                Save
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
                // provider: this.provider,
                loading: false
            }
        },
        methods: {
            closeModal() {
                this.$emit('close-modal');
            },
            videoChanged(e) {
                console.log(e.target.files[0])
                let fileReader = new FileReader()
                fileReader.readAsDataURL(e.target.files[0])
                fileReader.onload = (e) => {
                    this.form.image = e.target.result
                }
            },
            addImage() {
                this.loading = true
                this.$store.dispatch('addVideo', this.form)
                    .then(response => {
                        this.form = {}
                        this.loading = false
                        this.$store.dispatch('getUserArtist')
                        this.closeModal()
                    })
            },
            deleteVideo(imageId){
                this.loading = true
                this.$store.dispatch('deleteVideo',imageId)
                    .then(response => {
                        console.log(response)
                        this.$store.dispatch('getUserArtist')
                        this.closeModal()
                    })
            }
        }
    }
</script>

<style scoped>
</style>
