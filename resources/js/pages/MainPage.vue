<template>
    <div class="main-container">
        <div v-if="loadingData" class="loader-container">
            <DefaultLoader :loading="loadingData" color="#1A6F47"/>
        </div>
        <router-view></router-view>
    </div>

</template>

<script>
import {bus} from "../app"
import Swal from 'sweetalert2'

export default {
    name: "MainPage",

    data() {
        return {
            loadingData: false
        }
    },
    created() {

        bus.$on('loadingAction', (data) => {
            this.loadingData = data.status
        })

        bus.$on('successAction', (data) => {
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

<style lang="scss" scoped>

.main-container{
    width:100%;
    max-height:100%;
    overflow:hidden;
}

.loader-container{
    width:100%;
    height:100%;
    background-color: rgba(240, 240, 240, 0.81);
    position:absolute;
    justify-content:center;
    align-items: center;
    Z-index:1;
}

</style>
