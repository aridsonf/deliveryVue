<template>
  <div>
    <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
      <div class="mt-8 text-2xl">Welcome {{ user.name }}!</div>
    </div>

    <div class="bg-gray-200 bg-opacity-25 grid grid-cols-1">
      <div class="p-6 text-center">
        <a
          href="/products"
          class="
            inline-flex
            items-center
            bg-blue-500
            hover:bg-blue-400
            text-white
            font-bold
            py-2
            px-4
            border-b-4 border-blue-700
            hover:border-blue-500
            rounded
          "
        >
          <CollectionIcon class="h-5 w-5 text-dark-500" />&nbsp;Products
        </a>
      </div>

      <div class="p-6 text-center">
        <button
          class="
            inline-flex
            items-center
            bg-blue-500
            hover:bg-blue-400
            text-white
            font-bold
            py-2
            px-4
            border-b-4 border-blue-700
            hover:border-blue-500
            rounded
          "
        >
          <ShoppingCartIcon class="h-5 w-5 text-dark-500" />&nbsp;Cart
        </button>
      </div>
    </div>
  </div>
</template>

<script>
import { defineComponent } from "vue";
import { CollectionIcon, ShoppingCartIcon } from "@heroicons/vue/solid";
import JetApplicationLogo from "@/Jetstream/ApplicationLogo.vue";
// import Button from '@/Jetstream/Button.vue'

export default defineComponent({
  components: {
    JetApplicationLogo,
    // Button,
    CollectionIcon,
    ShoppingCartIcon,
  },

  props: ["user"],
});
</script>
