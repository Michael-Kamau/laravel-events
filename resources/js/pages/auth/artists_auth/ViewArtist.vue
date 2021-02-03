<template>
    <div class="m-2 p-4 rounded-lg shadow">
        <h1 class="text-3xl font-bold pt-8 lg:pt-0 text-gray-700">My Profile</h1>

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
                    <div>
                        <label class="text-1xl font-bold pt-8 lg:pt-0 text-gray-700 " for="cars">Add category:</label>

                        <select name="cars" id="cars">
                            <option value="volvo">Volvo</option>
                            <option value="saab">Saab</option>
                            <option value="mercedes">Mercedes</option>
                            <option value="audi">Audi</option>
                        </select>
                    </div>


                </div>
                <div class="shadow p-1 rounded flex flex-wrap space-x-2">
                    <p class="rounded-full bg-gray-400 p-1 w-auto "> One man <i class="fa fa-times" aria-hidden="true"></i></p>
                    <p class="rounded-full bg-gray-400 p-1 w-auto"> One man <i class="fa fa-times" aria-hidden="true"></i></p>
                    <p class="rounded-full bg-gray-400 p-1 w-auto "> One man <i class="fa fa-times" aria-hidden="true"></i></p>

                </div>


                <div class="flex">

                    <div class="pt-12 pb-8 mx-2 justify-center">
                        <button class="bg-yellow-700 hover:bg-yellow-900 text-white font-bold py-2 px-4 rounded-full">
                            1
                        </button>
                        <p class="text-gray-700 text-center font-bold">Bookings</p>
                    </div>

                    <div class="pt-12 pb-8 mx-2 justify-center">
                        <button class="bg-blue-700 hover:bg-blue-900 text-white font-bold py-2 px-4 rounded-full">
                            1
                        </button>
                        <p class="text-gray-700 text-center font-bold">confirmed</p>
                    </div>

                    <div class="pt-12 pb-8 mx-2 justify-center">
                        <button class="bg-green-700 hover:bg-green-900 text-white font-bold py-2 px-4 rounded-full">
                            1
                        </button>
                        <p class="text-gray-700 text-center font-bold">Paid</p>
                    </div>


                </div>

            </div>
        </div>


    </div>
</template>

<script>
    export default {
        name: "ViewArtist"
    }
</script>

<style scoped>

</style>
