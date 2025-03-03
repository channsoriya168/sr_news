<template>
    <div class="flex w-full gap-2 p-4 shadow-[0_-4px_6px_-1px_rgba(0,0,0,0.1),0_4px_6px_-1px_rgba(0,0,0,0.1)]">
        <button
            class="flex-1 text-green-500 transition border-2 border-green-500 border-solid rounded-lg h-14 hover:bg-green-500 hover:text-white" @click="createItem()">
            + Article
        </button>
        <button
            class="flex-1 text-blue-400 transition border-2 border-blue-400 border-solid rounded-lg h-14 hover:bg-blue-400 hover:text-white">
            Article List
        </button>
        <button
            class="flex-1 text-red-500 transition border-2 border-red-500 border-solid rounded-lg h-14 hover:bg-red-500 hover:text-white">
            Archived/Deleted
        </button>
    </div>
</template>

<script setup>

const emits = defineEmits(['create']);

const createItem = () => {
    emits('create');
};
</script>
