<template>
    <!-- Two columns -->
    <div class="flex mb-4">
        <!--            <h4>Navbar</h4>-->
        <!--            <a class="block mt-4 lg:inline-block lg:mt-0 text-teal-200 hover:text-white mr-4">-->
        <!--                <router-link to="/event">Event</router-link>-->
        <!--            </a>-->
        <!--            <a class="block mt-4 lg:inline-block lg:mt-0 text-teal-200 hover:text-white mr-4">-->
        <!--                <router-link to="/Erroserous">Erraneous</router-link>-->
        <!--            </a>-->


        <div
            class="overflow-hidden shadow-lg border-t-4 bg-white mb-4 rounded-b-lg rounded-t border-red-light  w-1/5 bg-gray-400">
            <div class="px-6 py-4 mb-2 mt-4 mb-8">
                <div class="uppercase tracking-wide text-c2 mb-4">Dashboard</div>
                <a class="block mt-4 lg:inline-block lg:mt-0 text-teal-200 hover:text-white mr-4">
                    <router-link to="/events/event">Corporate Events</router-link>
                </a>
                <a class="block mt-4 lg:inline-block lg:mt-0 text-teal-200 hover:text-white mr-4">
                    <router-link to="/events/Erroserous">Social Events</router-link>
                </a>
                <br>
                <a class="block mt-4 lg:inline-block lg:mt-0 text-teal-200 hover:text-white mr-4">
                    <router-link to="/events/event">All Events</router-link>
                </a>
            </div>
        </div>


        <div class="w-4/5 bg-gray-500 ">
            <h1>Content</h1>
            <router-view></router-view>

        </div>
    </div>

</template>

<script>
    export default {
        name: "EventsHome"
    }
</script>

<style scoped>

</style>
