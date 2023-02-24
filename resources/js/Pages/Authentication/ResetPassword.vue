<script setup>
import FormLabel from '@/Components/FormLabel.vue';
import Submit from '@/Components/Submit.vue';
import TextBox from '@/Components/TextBox.vue';
import Authentication from '@/Layouts/Authentication.vue';
import { Head, useForm } from '@inertiajs/vue3';

const props = defineProps({
    email: String,
    token: String,
})

const form = useForm({
    email: props.email,
    token: props.token,
    password: null,
    password_confirmation: null,
})

const resetPassword = () => {
    form.post(route('password.update'), {
        onFinish: () => form.reset('password','password_confirmation')
    })
}
</script>

<template>
    <Head 
        title="Log in"
    />

    <Authentication>
        <div class="w-96 bg-white rounded-lg shadow ring-1 ring-black ring-opacity-5">
            <form @submit.prevent="resetPassword" class="flex flex-col gap-4 p-4">
                <div class="group space-y-2">
                    <FormLabel for="email" value="Email Address" />
                    <TextBox type="text" id="email" v-model="form.email" aria-readonly="true" readonly="true" />
                    <span class="text-xs text-violet-600">{{ form.errors.email }}</span>
                </div>
                
                <div class="group space-y-2">
                    <FormLabel for="password" value="Password" />
                    <TextBox type="password" id="password" v-model="form.password" aria-autocomplete="new-password" autocomplete="new-password" />
                    <span class="text-xs text-violet-600">{{ form.errors.password }}</span>
                </div>
                
                <div class="group space-y-2">
                    <FormLabel for="password_confirmation" value="Confirm Password" />
                    <TextBox type="password" id="password_confirmation" v-model="form.password_confirmation" />
                    <span class="text-xs text-violet-600">{{ form.errors.password_confirmation }}</span>
                </div>

                <Submit label="Reset Password" :loading="form.processing" />
            </form>
        </div>
    </Authentication>
</template>