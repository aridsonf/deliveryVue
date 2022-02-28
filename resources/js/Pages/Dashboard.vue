<template>
    <app-layout title="Dashboard">
        <template #header>
            <h2 class="font-semibold flex text-xl text-gray-800 leading-tight">
                <HomeIcon class="h-5 w-5 text-dark-500" />&nbsp;
                Home
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <index :user="user" />
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
    import { defineComponent } from 'vue'
    import AppLayout from '@/Layouts/AppLayout.vue'
    import Index from '@/Pages/Dashboard/Index.vue'
    import { 
        HomeIcon 
        } from '@heroicons/vue/solid'

    export default defineComponent({
        components: {
            AppLayout,
            Index,
            HomeIcon,
        },

        props: ['user'],
    })
</script>
