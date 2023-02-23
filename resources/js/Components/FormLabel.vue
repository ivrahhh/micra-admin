<script setup>
defineProps({
    value: String,
})
</script>

<template>
    <label class="flex items-center gap-1 text-sm group-focus-within:text-violet-600 peer-checked:text-violet-600">
        <slot>{{ value }}</slot>
    </label>
</template>