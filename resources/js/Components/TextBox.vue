<script setup>
defineProps({
    modelValue: String,
})

defineEmits(['update:modelValue'])
</script>

<template>
    <input 
        :value="modelValue"
        @change="$emit('update:modelValue', $event.target.value)"
        class="block w-full rounded-lg text-sm bg-gray-50 border-gray-300
                focus:ring-1 focus:ring-violet-600 focus:border-violet-600 focus:text-violet-600"
    />
</template>