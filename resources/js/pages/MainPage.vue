<template>
    <router-view></router-view>
</template>

<script>
import {bus} from "../app"
import Swal from 'sweetalert2'

export default {
    name: "MainPage",

    created(){

        bus.$on('successAction',(data)=>{
            Swal.fire({
                title: 'Success',
                text: data.message,
                icon: 'success',
                confirmButtonText: 'Close'
            })

        })
    }

}
</script>

<style scoped>

</style>
