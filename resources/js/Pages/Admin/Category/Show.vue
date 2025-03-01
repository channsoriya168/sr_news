<template>
    <Modal>
        <div class="overflow-hidden rounded-lg shadow-lg bg-gradient-to-r from-gray-200 to-red-300">
            <div class="py-2 text-center text-white bg-red-500">
                <h2 class="text-xl font-bold uppercase">Category</h2>
            </div>
            <div class="p-4">
                <h2 class="text-lg font-bold text-white-800">Name: {{ props.category.name }}</h2>
                <p class="mt-2 text-white-700">Description: {{ props.category.description }}</p>
            </div>
        </div>
    </Modal>
</template>

<script setup>
import { defineProps } from 'vue';

const props = defineProps({
    category: {
        type: Object,
        required: true,
    }
});
</script>
