<script setup>
defineProps({
    label: String,
    loading: Boolean,
})
</script>

<template>
    <button 
        type="submit"
        class="block w-full rounded-lg px-4 py-2 text-sm text-white bg-violet-600 
                transition ease-in-out duration-200 hover:bg-violet-700"
    >
        <slot>{{ label }}</slot>
    </button>
</template>