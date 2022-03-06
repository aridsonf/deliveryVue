<template>
  <div>
    <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
      <div class="mt-8 text-2xl flex justify-between">
        <div class="w-full h-full">List of stocks</div>

        <div class="">
          <button
            @click="modalForm('POST', null)"
            class="
              bg-green-500
              hover:bg-green-400
              text-white
              font-bold
              py-2
              px-4
              border-b-4 border-green-700
              hover:border-green-500
              rounded-full
            "
          >
            <PlusIcon class="h-5 w-5 text-dark-500" />
          </button>
        </div>
      </div>
    </div>

    <div class="bg-gray-200 bg-opacity-25 grid grid-cols-1">
      <table class="table-auto">
        <thead>
          <tr class="text-left">
            <th class="px-4 py-2">#</th>
            <th class="px-4 py-2">Product</th>
            <th class="px-4 py-2">Balance</th>
            <th class="px-4 py-2">Reserved</th>
            <th class="px-4 py-2">Validate</th>
            <th class="px-4 py-2">Value</th>
            <th class="px-4 py-2"></th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="stock in stocks" :key="stock.id">
            <td class="border px-4 py-2">{{ stock.id }}</td>
            <td class="border px-4 py-2">{{ stock.rel_products.name }}</td>
            <td class="border px-4 py-2">{{ stock.balance }}</td>
            <td class="border px-4 py-2">{{ stock.reserved }}</td>
            <td class="border px-4 py-2">{{ stock.validate_date }}</td>
            <td class="border px-4 py-2">{{ stock.value }}</td>
            <td class="border px-4 py-2 text-center">
              <button
                @click="modalForm('PUT', stock)"
                class="
                  bg-yellow-500
                  hover:bg-yellow-400
                  text-white
                  font-bold
                  py-2
                  px-4
                  border-b-4 border-yellow-700
                  hover:border-yellow-500
                  rounded-full
                "
              >
                <PencilIcon class="h-5 w-5 text-dark-500" />
              </button>
              <button
                @click="deleteStock(stock.id)"
                class="
                  bg-red-500
                  hover:bg-red-400
                  text-white
                  font-bold
                  py-2
                  px-4
                  border-b-4 border-red-700
                  hover:border-red-500
                  rounded-full
                "
              >
                <TrashIcon class="h-5 w-5 text-dark-500" />
              </button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>

  <Form
    :showForm="showForm"
    :verb="verb"
    :stock="stock"
    @close-form="closeForm()"
  ></Form>
</template>

<script>
import { defineComponent } from "vue";
import { Inertia } from "@inertiajs/inertia";

import { PlusIcon } from "@heroicons/vue/solid";
import { TrashIcon } from "@heroicons/vue/solid";
import { PencilIcon } from "@heroicons/vue/solid";

import JetApplicationLogo from "@/Jetstream/ApplicationLogo.vue";
import JetSecondaryButton from "@/Jetstream/SecondaryButton.vue";
import JetDangerButton from "@/Jetstream/SecondaryButton.vue";

import Form from "@/Pages/Stocks/Form";

export default defineComponent({
  components: {
    JetApplicationLogo,
    JetSecondaryButton,
    JetDangerButton,
    PlusIcon,
    TrashIcon,
    PencilIcon,
    Form,
  },

  data() {
    return {
      showForm: false,
      stock: null,
      verb: null,
    };
  },

  methods: {
    modalForm(verb, stock) {
      this.stock = stock;
      this.showForm = true;
      this.verb = verb;
    },
    closeForm() {
      this.showForm = false;
    },
    deleteStock(id) {
      Inertia.delete(`/stocks/` + id, {
        onBefore: () => confirm("Are you sure you want to delete this stock?"),
      });
    },
  },

  props: ["stocks"],
});
</script>
