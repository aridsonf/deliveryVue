<template>
  <jet-dialog-modal :show="showModal" @close="showModal = false">
    <template #title> New Product </template>
    <template #content>
      <form class="w-full max-w">
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
              for="grid-name"
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
              id="grid-name"
              type="text"
              placeholder="name here..."
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
              for="grid-description"
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
              id="grid-password"
              placeholder="description here..."
            ></textarea>
          </div>
        </div>
      </form>
    </template>

    <template #footer>
      <jet-secondary-button @click="this.$parent.$data.showModal = false">
        Cancel
      </jet-secondary-button>

      <!-- <jet-danger-button class="ml-2" @click.native="deleteTeam" :class="{ 'opacity-25': form.processing }" :disabled="form.processing"> -->
      <jet-danger-button class="ml-2"> Create </jet-danger-button>
    </template>
  </jet-dialog-modal>
</template>

<script>
import { defineComponent } from "vue";

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

  props: ["showModal"],
});
</script>
