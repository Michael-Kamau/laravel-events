<template>
    <div class="m-2 p-4 rounded-lg shadow">
        <h1 class="text-3xl font-bold pt-8 lg:pt-0 text-gray-700">Artist Profile</h1>

        <div class="md:flex">
            <div class="w-full md:w-2/5 h-auto ">
                <img class="max-w-full h-auto rounded" src="https://www.zaziehotel.paris/images/annuaire/hd/%c2%a9%20Paris%20Tourist%20Office%20-%20Photographe%20%20Annemiek%20Veldman.jpg" alt="">
            </div>

            <div class="p-2 w-full md:w-3/5 ">
                <h1 class="text-2xl font-bold pt-8 mb-2 lg:pt-0 text-gray-700">Michie Brownlee</h1>

                <h1 class="text-1xl font-bold pt-8 lg:pt-0 text-gray-700">Description</h1>
                <h6 class="p-1 mb-2">Save time with the online editor for Tailwind CSS that has a simple, intuitive drag ... Too often developers don't have time to implement their designs perfectly. ... a layout to the refining stage so that you can have time to work on the details.</h6>


                <div class="md:flex justify-between">
                    <h1 class="text-1xl font-bold pt-8 lg:pt-0 text-gray-700">Categories</h1>

                </div>
                <div class="shadow p-1 rounded flex flex-wrap space-x-2 py-3 m-2">
                    <p class="rounded-full bg-gray-400 p-1 w-auto "> One man </p>
                    <p class="rounded-full bg-gray-400 p-1 w-auto"> One man </p>
                    <p class="rounded-full bg-gray-400 p-1 w-auto "> One man </p>

                </div>
                <div class=" flex justify-between my-5">
                    <button class="h-10 px-2 text-indigo-100 transition-colors duration-150 bg-indigo-700 rounded-lg focus:shadow-outline hover:bg-indigo-800">
                        <span class="mr-2">Videos</span>
                        <span class="inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-red-100 bg-red-600 rounded-full">9</span>
                    </button>

                    <button class="h-10 px-2 text-indigo-100 transition-colors duration-150 bg-green-700 rounded-lg focus:shadow-outline hover:bg-green-800">
                        <span class="mr-2">Book Artist</span>
                    </button>
                </div>

            </div>
        </div>


    </div>
</template>

<script>
    export default {
        name: "ArtistBook"
    }
</script>

<style scoped>

</style>
