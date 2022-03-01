<template>
  <jet-dialog-modal :show="showForm" @close="$emit('closeForm')">
    <template #title v-if="verb == 'POST'"> New Stock </template>
    <template #title v-else-if="verb == 'PUT'"> Edit Stock </template>
    <template #content>
      <form class="w-full max-w" @submit.prevent="submit()" id="stockForm">
        <div role="alert" v-if="form.hasErrors">
          <div class="bg-red-500 text-white font-bold rounded-t px-4 py-2">
            Error
          </div>
          <div
            class="
              border border-t-0 border-red-400
              rounded-b
              bg-red-100
              px-4
              py-3
              text-red-700
            "
          >
            <ul
              class="list-disc px-3"
              v-for="error in form.errors"
              :key="error"
            >
              <li>{{ error }}</li>
            </ul>
          </div>
        </div>
        <br />
        <div class="flex flex-wrap -mx-3 mb-6">
          <div class="w-1/2 px-3">
            <label
              class="
                block
                uppercase
                tracking-wide
                text-gray-700 text-xs
                font-bold
                mb-2
              "
              for="product"
            >
              Product
            </label>
            <select
              class="
                appearance-none
                block
                w-full
                bg-gray-200
                text-gray-700
                border border-gray-200
                rounded
                py-3
                px-2
                leading-tight
                focus:outline-none focus:bg-white focus:border-gray-500
              "
              id="product"
              v-model="form.fk_product"
            >
              <option class="bg-gray-200 text-gray-700 leading-tight" value="">
                Select a product...
              </option>
              <option
                class="bg-gray-200 text-gray-700 leading-tight"
                v-for="product in products"
                :value="product.id"
                :key="product.id"
              >
                {{ product.name }}
              </option>
            </select>
          </div>
          <div class="w-1/2 px-3">
            <label
              class="
                block
                uppercase
                tracking-wide
                text-gray-700 text-xs
                font-bold
                mb-2
              "
              for="value"
            >
              Value
            </label>
            <input
              class="
                appearance-none
                block
                w-full
                bg-gray-200
                text-gray-700
                border border-gray-200
                rounded
                py-3
                px-4
                mb-3
                leading-tight
                focus:outline-none focus:bg-white focus:border-gray-500
              "
              type="text"
              id="value"
              placeholder="Value here..."
              v-model="form.value"
            />
          </div>
        </div>
        <div class="flex flex-wrap -mx-3 mb-6">
          <div class="w-1/2 px-3">
            <label
              class="
                block
                uppercase
                tracking-wide
                text-gray-700 text-xs
                font-bold
                mb-2
              "
              for="inbound"
            >
              Stock quantity
            </label>
            <input
              class="
                appearance-none
                block
                w-full
                bg-gray-200
                text-gray-700
                border border-gray-200
                rounded
                py-3
                px-4
                mb-3
                leading-tight
                focus:outline-none focus:bg-white focus:border-gray-500
              "
              type="number"
              min="0"
              id="inbound"
              placeholder="Stock quantity here..."
              v-model="form.inbound"
            />
          </div>
          <div class="w-1/2 px-3">
            <label
              class="
                block
                uppercase
                tracking-wide
                text-gray-700 text-xs
                font-bold
                mb-2
              "
              for="validate_date"
            >
              Validate date
            </label>
            <input
              class="
                appearance-none
                block
                w-full
                bg-gray-200
                text-gray-700
                border border-gray-200
                rounded
                py-3
                px-4
                mb-3
                leading-tight
                focus:outline-none focus:bg-white focus:border-gray-500
              "
              type="date"
              id="validate_date"
              placeholder="Validate date here..."
              v-model="form.validate_date"
            />
          </div>
        </div>
      </form>
      <div role="alert" v-if="form.success">
        <div class="bg-green-500 text-white font-bold rounded-t px-4 py-2">
          <p v-if="verb == 'POST'">Successfully created!</p>
          <p v-else-if="verb == 'PUT'">Successfully updated!</p>
        </div>
      </div>
    </template>

    <template #footer>
      <jet-secondary-button @click="$emit('closeForm')">
        Cancel
      </jet-secondary-button>

      <jet-danger-button
        class="ml-2"
        :type="'submit'"
        form="stockForm"
        :disabled="form.processing"
      >
        <p v-if="verb == 'POST'">Create</p>
        <p v-else-if="verb == 'PUT'">Update</p>
      </jet-danger-button>
    </template>
  </jet-dialog-modal>
</template>

    <script>
import { defineComponent } from "vue";
import { useForm } from "@inertiajs/inertia-vue3";

import JetApplicationLogo from "@/Jetstream/ApplicationLogo.vue";
import JetSecondaryButton from "@/Jetstream/SecondaryButton.vue";
import JetDangerButton from "@/Jetstream/SecondaryButton.vue";
import JetDialogModal from "@/Jetstream/DialogModal.vue";

import axios from "axios";

export default defineComponent({
  components: {
    JetApplicationLogo,
    JetSecondaryButton,
    JetDangerButton,
    JetDialogModal,
  },

  props: ["showForm", "stock", "verb"],

  emits: ["closeForm"],

  data() {
    return {
      products: null,
    };
  },

  created() {
    axios.get("/stocks/create").then((res) => {
      this.products = res.data;
    });
  },

  setup() {
    const form = useForm({
      fk_product: "",
      value: null,
      validate_date: null,
      inbound: null,
    });

    return { form };
  },

  beforeUpdate() {
    console.log(this.verb, this.showForm, this.stock, this.products, this.form);
    this.form.clearErrors();
  },

  updated() {
    this.form.success = false;
    this.form.reset();
    if (this.verb == "PUT") {
      this.form.fk_product = this.stock.fk_product;
      this.form.validate_date = this.stock.validate_date;
      this.form.inbound = this.stock.inbound;
      this.form.value = this.stock.value;
    }
  },

  methods: {
    submit() {
      if (this.verb == "POST") {
        this.form.post("/stocks", {
          onSuccess: () => {
            this.form.success = true;
            this.form.reset();
          },
          onError: () => {
            this.form.success = false;
          },
        });
      } else if (this.verb == "PUT") {
        this.form.put("/stocks/" + this.stock.id, {
          onSuccess: () => {
            this.form.success = true;
          },
          onError: () => {
            this.form.success = false;
          },
        });
      }
    },
  },
});
</script>
