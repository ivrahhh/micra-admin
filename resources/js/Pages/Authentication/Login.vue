<script setup>
import FormLabel from '@/Components/FormLabel.vue';
import Submit from '@/Components/Submit.vue';
import TextBox from '@/Components/TextBox.vue';
import Authentication from '@/Layouts/Authentication.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

const form = useForm({
    email: null,
    password: null,
    remember: false,
})

const authenticate = () => {
    form.post(route('authenticate'), {
        onFinish: () => form.reset('password'),
        preserveScroll: true,
    })
}
</script>

<template>
    <Head 
        title="Log in"
    />

    <Authentication>
        <div class="w-96 bg-white rounded-lg shadow ring-1 ring-black ring-opacity-5">
            <form @submit.prevent="authenticate" class="flex flex-col gap-4 p-4">
                <div class="group space-y-2">
                    <FormLabel for="email" value="Email Address" />                    
                    <TextBox type="text" id="email" v-model="form.email" autocomplete="email" aria-autocomplete="email" />
                    <span class="text-xs text-violet-600">{{ form.errors.email }}</span>
                </div>

                <div class="group space-y-2">
                    <FormLabel for="password" value="Password" />                    
                    <TextBox type="password" id="password" v-model="form.password" autocomplete="password" aria-autocomplete="password" />
                    <span class="text-xs text-violet-600">{{ form.errors.password }}</span>
                </div>

                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-1">
                        <input type="checkbox" id="remember" v-model="form.remember" value="true" class="peer text-violet-600 h-3.5 w-3.5 rounded focus:ring-transparent" />
                        <FormLabel for="remember" value="Remember Me" />
                    </div>
                    
                    <Link :href="route('password.request')" class="text-sm text-violet-600 underline">Forgot Password?</Link>
                </div>

                <Submit label="Log in" :loading="form.processing" />
            </form>
        </div>
    </Authentication>
</template>