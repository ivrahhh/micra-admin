<script setup>
import FormLabel from '@/Components/FormLabel.vue';
import Submit from '@/Components/Submit.vue';
import TextBox from '@/Components/TextBox.vue';
import Toast from '@/Components/Toast.vue';
import Authentication from '@/Layouts/Authentication.vue';
import { useToastStore } from '@/Stores/toast';
import { Head, Link, useForm, usePage } from '@inertiajs/vue3';
import { computed } from 'vue';

const store = useToastStore()
const form = useForm({
    email: null,
})

const success = computed(() => {
    return usePage().props.notifications.success
})

const sendRequest = () => {
    form.post(route('password.email'), {
        onSuccess: () => {
            form.reset()
            if(store.getSuccessNotification === 'reset-link-sent') {
                store.openToast()
            }
        }
    })
}
</script>

<template>
    <Head title="Forgot Password" />

    <Authentication>
        <div class="w-96 bg-white rounded-lg shadow ring-1 ring-black ring-opacity-5">
            <form @submit.prevent="sendRequest" class="flex flex-col gap-4 p-4">
                <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
                    Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.
                </div>
                <div class="group space-y-2">
                    <FormLabel for="email" value="Email Address" />
                    <TextBox type="text" id="email" v-model="form.email" aria-autocomplete="email" autocomplete="email" />
                    <span class="text-xs text-violet-600">{{ form.errors.email }}</span>
                </div>
                <div class="flex flex-col items-center gap-2">
                    <Submit label="Send Reset Link" :loading="form.processing" />
                    <Link :href="route('login')" class="text-sm text-violet-600 underline">Back to Login</Link>
                </div>
            </form>
        </div>
    </Authentication>
    <Transition
        enter-active-class="transition ease-out duration-200"
        enter-from-class="translate-x-full opacity-0"
        enter-to-class="translate-x-0 opacity-100"
        leave-active-class="transition ease-in duration-200"
        leave-from-class="scale-100 opacity-100"
        leave-to-class="scale-90 opacity-0"
    >
        <Toast 
            title="Request Password Reset"
            message="We have emailed your password reset link."
            v-if="store.active"
            @close="store.closeToast()"
        />
    </Transition>
</template>