<template>
  <div>
    <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
      <div class="mt-8 text-2xl flex justify-between">
        <div class="w-full h-full">List of products</div>

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
            <th class="w-1/16 px-4 py-2">#</th>
            <th class="w-1/4 px-4 py-2">Name</th>
            <th class="w-1/2 px-4 py-2">Description</th>
            <th class="w-1/16 px-4 py-2"></th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="product in products" :key="product.id">
            <td class="border px-4 py-2">{{ product.id }}</td>
            <td class="border px-4 py-2">{{ product.name }}</td>
            <td class="border px-4 py-2">{{ product.description }}</td>
            <td class="border px-4 py-2 text-center">
              <button
                @click="modalForm('PUT', product)"
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
                @click="deleteProduct(product.id)"
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
    :product="product"
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

import Create from "@/Pages/Products/Create";
import Edit from "@/Pages/Products/Edit";
import Form from "@/Pages/Products/Form";

export default defineComponent({
  components: {
    JetApplicationLogo,
    JetSecondaryButton,
    JetDangerButton,
    PlusIcon,
    TrashIcon,
    PencilIcon,
    Create,
    Edit,
    Form,
  },

  data() {
    return {
      showForm: false,
      showModal: false,
      showEdit: false,
      product: null,
      verb: null,
    };
  },

  methods: {
    modal() {
      this.showModal = true;
    },
    modalEdit(product) {
      this.product = product;
      this.showEdit = true;
    },
    modalForm(verb, product) {
      this.product = product;
      this.showForm = true;
      this.verb = verb;
    },
    close() {
      this.showModal = false;
    },
    closeEdit() {
      this.showEdit = false;
    },
    closeForm() {
      this.showForm = false;
    },
    deleteProduct(id) {
      Inertia.delete(`/products/` + id, {
        onBefore: () =>
          confirm("Are you sure you want to delete this product?"),
      });
    },
  },

  props: ["products"],
});
</script>
