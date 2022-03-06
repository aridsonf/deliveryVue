<template>
  <app-layout title="Dashboard">
    <template #header>
      <div class="flex justify-between">
        <div class="col p-2">
          <h2 class="font-semibold flex text-xl text-gray-800 leading-tight">
            <CollectionIcon class="h-5 w-5 text-dark-500" />&nbsp; Stocks
          </h2>
        </div>

        <div class="col text-right">
          <a
            href="/dashboard"
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
              rounded-full
            "
          >
            <HomeIcon class="h-5 w-5" />
          </a>
        </div>
      </div>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
          <list :stocks="stocks" />
        </div>
      </div>
    </div>
  </app-layout>
</template>

<script>
import { defineComponent } from "vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import List from "@/Pages/Stocks/List.vue";
import { CollectionIcon, HomeIcon } from "@heroicons/vue/solid";

export default defineComponent({
  components: {
    AppLayout,
    List,
    CollectionIcon,
    HomeIcon,
  },

  props: ["stocks"],
});
</script>
