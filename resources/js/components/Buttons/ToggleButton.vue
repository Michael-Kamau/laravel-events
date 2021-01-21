<template>
    <div class="flex justify-between items-center" @click="toggleActive">
        <div class="w-8 h-5 flex items-center bg-gray-300 rounded-full p-1 duration-300 ease-in-out" :class="{ 'bg-green-400': active}">
            <div class="bg-white w-4 h-4 rounded-full shadow-md transform duration-300 ease-in-out" :class="{ 'translate-x-3': active}"></div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "ToggleButton",
        props : ['active'],

        data() {
            return {
                details: [],
            };
        },

        methods :{
            toggleActive(){
                this.$emit('toggle-active');
            },
        }
    }
</script>

<style scoped>
    .toggle__dot {
        top: -.25rem;
        left: -.25rem;
        transition: all 0.3s ease-in-out;
    }

    input:checked ~ .toggle__dot {
        transform: translateX(100%);
        background-color: #48bb78;
    }
</style>
