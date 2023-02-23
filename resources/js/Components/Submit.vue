<script setup>
defineProps({
    label: String,
    loading: Boolean,
})
</script>

<template>
    <button 
        type="submit"
        :disabled="loading"
        class="flex items-center justify-center w-full rounded-lg px-4 py-2 text-sm text-white bg-violet-600 
                transition ease-in-out duration-200 hover:bg-violet-700 disabled:opacity-75"
    >
        <span v-if="loading">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="h-5 w-5 fill-white animate-spin">
                <path d="M222.7 32.1c5 16.9-4.6 34.8-21.5 39.8C121.8 95.6 64 169.1 64 256c0 106 86 192 192 192s192-86 192-192c0-86.9-57.8-160.4-137.1-184.1c-16.9-5-26.6-22.9-21.5-39.8s22.9-26.6 39.8-21.5C434.9 42.1 512 140 512 256c0 141.4-114.6 256-256 256S0 397.4 0 256C0 140 77.1 42.1 182.9 10.6c16.9-5 34.8 4.6 39.8 21.5z"/>
            </svg>
        </span>
        <span v-else>
            <slot>{{ label }}</slot>
        </span>
    </button>
</template>