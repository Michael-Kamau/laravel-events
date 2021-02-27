<template>
    <div>
        <h1>Artists Menu</h1>
        <div class="flex flex-wrap p-2">
            <div class="menu-item">
                <p>Categories</p>
            </div>
            <!--            <div class="menu-item">-->
            <!--                Artists-->
            <!--            </div>-->
            <!--            <div class="menu-item">-->
            <!--                Menu-->
            <!--            </div>-->
        </div>

        <div>
            <div class="mb-3 pt-0">
                <input type="text" placeholder="Category"
                       class="px-3 py-3 placeholder-gray-400 text-gray-700 relative bg-white bg-white rounded text-sm shadow outline-none focus:outline-none focus:shadow-outline " v-model="form.genre"/>
            </div>
            <div>
                <button
                    class="bg-blue-500 text-white active:bg-blue-600 font-bold uppercase text-xs px-4 py-2 rounded-full shadow hover:shadow-md outline-none focus:outline-none mr-1 mb-1"
                    type="button" style="transition: all .15s ease" @click="addGenre()">
                    <i class="fa fa-plus-circle"></i>
                </button>
            </div>
            <div class="shadow p-2 rounded flex flex-wrap space-x-2">

                <p class="rounded-full bg-gray-400 p-1 w-auto " v-for="genre in genres"> {{genre.name}} <i class="fa fa-times" aria-hidden="true"></i>
                </p>
<!--                <p class="rounded-full bg-gray-400 p-1 w-auto"> One man <i class="fa fa-times" aria-hidden="true"></i>-->
<!--                </p>-->
<!--                <p class="rounded-full bg-gray-400 p-1 w-auto "> One man <i class="fa fa-times" aria-hidden="true"></i>-->
<!--                </p>-->

            </div>
        </div>
    </div>
</template>

<script>
    import axios from "axios";

    export default {
        name: "ArtistMenu",

        mounted(){
            this.fetchGenres()
        },

        data() {
            return {
                genres: [],
                form: {

                }
            }

        },

        methods: {
            fetchGenres(){
                axios.get(`/api/artists/genres`)
                    .then(response => {
                        console.log(response)
                        this.genres= response.data.data
                    }).catch(e => {
                    console.log(e)
                })
            },
            addGenre() {
                axios.post(`/api/artists/genres`, this.form)
                    .then(response => {
                        this.fetchGenres()
                        this.form={}
                    }).catch(e => {
                    console.log(e)
                })
            },

            deleteGenre(){

            }
        }
    }
</script>

<style scoped lang="scss">
    .menu-item {
        @apply py-2 px-4 bg-white rounded shadow m-2;

        &:hover {
            @apply bg-gray-100 shadow;
        }
    }

</style>
