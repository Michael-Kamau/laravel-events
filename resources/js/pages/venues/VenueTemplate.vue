<template>
    <div class="">
        <router-link :to="{ name: 'venuePage', params: { id: venue.id }}">
            <div class="max-w-md mx-auto bg-white rounded-xl shadow-md overflow-hidden md:max-w-2xl">
                <div class="md:flex flex-col">
                    <div class="md:flex-shrink-0">
                        <img class="h-56 w-full object-cover " :src="'/' +venue.image ">
                    </div>
                    <div class="p-8">
                        <div class="uppercase tracking-wide text-sm text-indigo-500 font-semibold">{{venue.name}}</div>
                        <a href="#" class="block mt-1 text-lg leading-tight font-medium text-black hover:underline">{{venue.location}}</a>
                        <p class="mt-2 text-gray-500">{{description}}.</p>
                    </div>
                </div>
            </div>
        </router-link>

    </div>
</template>

<script>
    export default {
        name: "VenueTemplate",
        props: ['venue'],

        computed: {

            description() {
                return this.venue.description.substring(0,20) +'...'
            }
        }
    }
</script>

<style scoped>

</style>
