<script setup>
import FormLabel from '@/Components/FormLabel.vue';
import Submit from '@/Components/Submit.vue';
import TextBox from '@/Components/TextBox.vue';
import Authentication from '@/Layouts/Authentication.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';


const form = useForm({
    email: null,
})

const sendRequest = () => {
    form.post(route('password.email'), {
        onSuccess: () => {
            form.reset()
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
</template>