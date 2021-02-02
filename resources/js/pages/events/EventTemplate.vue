<template>
    <div class="">
        <router-link :to="{ name: 'eventPage', params: { id: event.id }}">

            <div class="max-w-md mx-auto bg-white rounded-xl shadow-md overflow-hidden md:max-w-2xl">
                <div class="md:flex flex-col">
                    <div class="md:flex-shrink-0">
                        <img class="h-56 w-full object-cover " :src="'/' +event.image">
                    </div>
                    <div class="p-8">
                        <div class="uppercase tracking-wide text-sm text-indigo-500 font-semibold">{{event.name}}</div>
                        <a href="#" class="block mt-1 text-lg leading-tight font-medium text-black hover:underline">{{event.location}}</a>
                    </div>
                    <div class="px-3 mb-2 text-center">
                    <span
                        class="inline-block w-2/5 bg-gray-200 rounded px-3 py-1 text-sm text-center font-semibold text-gray-700 mr-1">Start Date <br>{{event.start_date}}</span>
                        <span
                            class="inline-block w-2/5 bg-gray-200 rounded px-3 py-1 text-sm text-center font-semibold text-gray-700 ">End Date <br> {{event.end_date}}</span>
                        <!--                <span class="inline-block bg-gray-400 rounded px-3 py-2 text-center text-sm font-semibold text-gray-700"> Details</span>-->
                    </div>
                </div>
            </div>
        </router-link>
    </div>
</template>

<script>
    export default {
        name: "EventTemplate",
        props: ['event']
    }
</script>

<style scoped>

</style>
