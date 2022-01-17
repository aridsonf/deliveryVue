<template>  
    <jet-dialog-modal :show="showModal" @close="showModal = false">
        <template #title>
            Delete Account
        </template>

        <template #content>
            Are you sure you want to delete your account? Once your account is deleted, all of its resources and data will be permanently deleted.
        </template>

        <template #footer>
            <jet-secondary-button @click.native="showModal = false">
                Nevermind
            </jet-secondary-button>

            <!-- <jet-danger-button class="ml-2" @click.native="deleteTeam" :class="{ 'opacity-25': form.processing }" :disabled="form.processing"> -->
            <jet-danger-button class="ml-2" @click.native="deleteTeam">
                Delete Account
            </jet-danger-button>
        </template>
    </jet-dialog-modal>
</template>

<script>
    import { defineComponent } from 'vue'

    import JetApplicationLogo from '@/Jetstream/ApplicationLogo.vue'
    import JetSecondaryButton from '@/Jetstream/SecondaryButton.vue'
    import JetDangerButton from '@/Jetstream/SecondaryButton.vue'
    import JetDialogModal from '@/Jetstream/DialogModal.vue'

    export default defineComponent({
        components: {
            JetApplicationLogo,
            JetSecondaryButton,
            JetDangerButton,
            JetDialogModal,
        },

        // data(){
        //     return {
        //         confirmingUserDeletion: false,
        //     }
        // },
        // props: {showModal:['showModal']},
        props: ['showModal'],

        // methods:{
        //     modal(){
        //         this.showModal = true;
        //     }
        // },
        
    })
</script>
