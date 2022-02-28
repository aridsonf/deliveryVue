<template>
  <jet-dialog-modal :show="showForm" @close="$emit('closeForm')">
    <template #title v-if="verb == 'POST'"> New Product </template>
    <template #title v-else-if="verb == 'PUT'"> Edit Product </template>
    <template #content>
      <form class="w-full max-w" @submit.prevent="submit()" id="productForm">
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
          <div class="w-full px-3">
            <label
              class="
                block
                uppercase
                tracking-wide
                text-gray-700 text-xs
                font-bold
                mb-2
              "
              for="name"
            >
              Name
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
                px-2
                leading-tight
                focus:outline-none focus:bg-white focus:border-gray-500
              "
              id="name"
              type="text"
              placeholder="name here..."
              v-model="form.name"
            />
          </div>
        </div>
        <div class="flex flex-wrap -mx-3 mb-6">
          <div class="w-full px-3">
            <label
              class="
                block
                uppercase
                tracking-wide
                text-gray-700 text-xs
                font-bold
                mb-2
              "
              for="description"
            >
              Description
            </label>
            <textarea
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
              rows="4"
              id="description"
              placeholder="description here..."
              v-model="form.description"
            ></textarea>
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
        form="productForm"
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

export default defineComponent({
  components: {
    JetApplicationLogo,
    JetSecondaryButton,
    JetDangerButton,
    JetDialogModal,
  },

  props: ["showForm", "product", "verb"],

  emits: ["closeForm"],

  setup() {
    const form = useForm({
      description: null,
      name: null,
    });

    return { form };
  },

  beforeUpdate() {
    console.log(this.verb, this.showForm, this.product);
    this.form.clearErrors();
  },

  updated() {
    this.form.success = false;
    this.form.reset();
    if (this.verb == "PUT") {
      this.form.name = this.product.name;
      this.form.description = this.product.description;
    }
  },

  methods: {
    submit() {
      if (this.verb == "POST") {
        this.form.post("/products", {
          onSuccess: () => {
            this.form.success = true;
            this.form.reset();
          },
          onError: () => {
            this.form.success = false;
          },
        });
      } else if (this.verb == "PUT") {
        this.form.put("/products/" + this.product.id, {
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
