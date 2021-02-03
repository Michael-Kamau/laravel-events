<template>
    <div class="">
        <router-link :to="{ name: 'artistPage', params: { id: artist.id }}">

            <div class="max-w-md mx-auto bg-white rounded-xl shadow-md overflow-hidden md:max-w-2xl">
                <div class="md:flex flex-col">
                    <div class="md:flex-shrink-0">
                        <img class="h-56 w-full object-cover " :src="'/' +artist.image">
                    </div>
                    <div class="px-8">
                        <div class="uppercase tracking-wide text-sm text-indigo-500 font-semibold">{{artist.name}}</div>
                        <a href="#" class="block mt-1 text-lg leading-tight font-medium text-black hover:underline">{{artist.location}}</a>
                    </div>
                    <div class="px-3 mb-2 ">
                        <span class="inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-gray-100 bg-gray-500 rounded">NEW</span>
                        <span class="inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-red-100 bg-red-500 rounded">NEW</span>
                        <span class="inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-green-100 bg-green-700 rounded">NEW</span>
                        <span class="inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-indigo-100 bg-indigo-700 rounded">NEW</span>
                        <span class="inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-indigo-100 bg-indigo-700 rounded">NEW</span>
                    </div>
                    <div class="p-2">
                        <button class="h-10 px-2 text-indigo-100 transition-colors duration-150 bg-indigo-700 rounded-lg focus:shadow-outline hover:bg-indigo-800">
                            <span class="mr-2">Videos</span>
                            <span class="inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-red-100 bg-red-600 rounded-full">9</span>
                        </button>
                    </div>
                </div>
            </div>
        </router-link>
    </div>
</template>

<script>
    export default {
        name: "ArtistTemplate",
        props: ['artist']
    }
</script>

<style scoped>

</style>
