<script setup>
import { onMounted, ref } from 'vue';

const props = defineProps({
    title: String,
    message: String,
    duration: {
        type: Number,
        default: 3,
    },
    persistent: {
        type: Boolean,
        default: false,
    },
})

const toast = ref(null)
const emits = defineEmits(['close'])

onMounted(() => {
    if(!props.persistent) {
        let timer = setTimeout(() => emits('close'), props.duration * 1000)
        
        toast.value.addEventListener('mouseover', () => {
            clearTimeout(timer)            
        })

        toast.value.addEventListener('mouseout', () => {
            timer = setTimeout(() => emits('close'), props.duration * 1000)
        })
    }
})
</script>

<template>
    <div class="fixed top-8 right-8 w-96 bg-white rounded-lg shadow-lg ring-1 ring-black ring-opacity-5" ref="toast">
        <div class="flex items-center justify-between px-4 py-2">
            <div class="flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.75" stroke="currentColor" class="w-5 h-5 text-green-600">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span class="text-sm font-semibold">{{ title }}</span>
            </div>
            <button type="button" @click="$emit('close')">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4 text-gray-400 hover:text-gray-900 transition ease-in-out duration-200">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        <div class="text-sm p-4 text-gray-600">
            {{ message }}
        </div>
    </div>
</template>