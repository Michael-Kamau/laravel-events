<template>
    <div class="w-full h-64 object-cover">

        <iframe width="100%" height="250" :src="videoUrl" frameborder="0"
                allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                allowfullscreen></iframe>

    </div>
</template>

<script>
    export default {
        name: "VideoFrame",
        props: ['url'],
        computed: {
            videoUrl() {
                let url = this.url.replace("watch?v=", "embed/")
                return url + '?autoplay=0' //to mute, also append '&mute=1'
            }
        }
    }
</script>

<style scoped>
</style>
