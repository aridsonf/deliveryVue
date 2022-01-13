<template>
    <div>
        <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
            <div class="mt-8 text-2xl flex justify-between">
                <div class="w-full h-full">
                    List of products
                </div>

                <div class="">
                    <button class="bg-green-500 hover:bg-green-400 text-white font-bold py-2 px-4 border-b-4 border-green-700 hover:border-green-500 rounded-full">
                        <PlusIcon class="h-5 w-5 text-dark-500"/>
                    </button> 
                </div>
            </div>
        </div>

        <div class="bg-gray-200 bg-opacity-25 grid grid-cols-1">
            <table class="table-auto">
                <thead>
                    <tr class="text-left">
                        <th class="w-1/8 px-4 py-2">#</th>
                        <th class="w-1/4 px-4 py-2">Name</th>
                        <th class="w-1/2 px-4 py-2">Description</th>
                        <th class="w-1/4 px-4 py-2"></th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="product in products" :key="product.id">
                        <td class="border px-4 py-2">{{product.id}}</td>
                        <td class="border px-4 py-2">{{product.name}}</td>
                        <td class="border px-4 py-2">{{product.description}}</td>
                        <td class="border px-4 py-2"></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
    import { defineComponent } from 'vue'
    import { 
        PlusIcon, 
        } from '@heroicons/vue/solid'
    import JetApplicationLogo from '@/Jetstream/ApplicationLogo.vue'
    // import Button from '@/Jetstream/Button.vue'

    export default defineComponent({
        components: {
            JetApplicationLogo,
            // Button,
            PlusIcon,
        },

        props: ['products'],
    })
</script>
