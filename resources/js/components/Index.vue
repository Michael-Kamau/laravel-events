<template>
    <div>
        <h1>Welcome to Events website</h1>
        <input class="bg-white focus:outline-none focus:shadow-outline border border-gray-300 rounded-lg py-2 px-4 block w-full appearance-none leading-normal" type="email" placeholder="jane@example.com">

        <router-view></router-view>
    </div>

</template>

<script>
    export default {
        name: "HomeComponent.vue"
    }
</script>

<style scoped>

</style>
