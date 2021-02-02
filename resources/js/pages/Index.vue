<template>
    <div>

<!--        <div class="bg-rose-300 ...">-->
<!--            <img class="object-fill h-72 w-full ..." src="/homepage.jpg">-->
<!--        </div>-->
        <div class="bg-auto bg-cover h-75" style="background-image: url(/images/homepage/events2.jpg)">
            <!--            <img class="w-screen h-auto" src="/netflix.jpg" alt="">-->
            <div class=" w-full h-full text-center text-white pt-12 items-center justify-center p-6" style="background: rgba(0,0,0,0.6)">
                <h1 class="'text-white text-5xl m-12 text-uppercase italic ">All Events Finder</h1>
                <div class="hide grid gap-4 md:grid-cols-3 md:grid-cols-1 p-4 pb-8">
                    <img class="transform md:rotate-45 rounded-md" src="/images/homepage/events.jpg">
                    <img class="transform md:-rotate-12 rounded-md" src="/images/homepage/venues.jpg">
                    <img class="transform md:rotate-45 rounded-md" src="/images/homepage/artists.jpg">
                </div>
                <div class="rounded p-4 bg-black mt-8 bg-opacity-50">
                    <h1 class="text-gray text-2xl">As an events company we are a very curative in bringing you the right
                        crowd or parsons to your event whether social event or cooperate event
                        plus we make it easier for you to reach your target audience as we have
                        made it possible for like-minded minds to notify/alert each other when
                        your event comes up.</h1>
                </div>


            </div>

        </div>

        <div class="flex mb-4 flex-wrap mx-auto items-center justify-center">


            <div class="w-2/7 m-2 ">
                <div class="max-w-sm rounded overflow-hidden shadow-lg border text-gray-900">
                    <img class="" src="/homepage.jpg" alt="">
                    <div class="p-8">
                        <div class="uppercase tracking-wide text-sm text-indigo-500 font-semibold">Events</div>
                        <p href="#" class="block mt-1 text-md leading-tight font-medium text-gray-600">Add and view upcoming events.</p>
                    </div>
                </div>

            </div>

            <div class="w-2/7 m-2 ">
                <div class="max-w-sm rounded overflow-hidden shadow-lg border text-gray-900">
                    <img class="" src="/venues.jpg" alt="">
                    <div class="p-8">
                        <div class="uppercase tracking-wide text-sm text-indigo-500 font-semibold">Venues</div>
                        <p href="#" class="block mt-1 text-md leading-tight font-medium text-gray-600">Upload &amp; View outdoor and indoor venues.</p>
                    </div>
                </div>

            </div>

            <div class="w-2/7 m-2 ">
                <div class="max-w-sm rounded overflow-hidden shadow-lg border text-gray-900">
                    <img class="" src="/artist.jpg" alt="">
                    <div class="p-8">
                        <div class="uppercase tracking-wide text-sm text-indigo-500 font-semibold">Artists</div>
                        <p href="#" class="block mt-1 text-md leading-tight font-medium text-gray-600">Book Performing artists for your event.</p>
                    </div>
                </div>

            </div>




        </div>


    </div>

</template>

<script>
    export default {
        name: "HomeComponent.vue"
    }
</script>

<style scoped>

</style>
