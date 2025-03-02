<template>
    <header class="sticky top-0 px-6 py-4 shadow-lg bg-gradient-to-b from-red-600 to-black shadow-gray-300">
        <!-- Left Side (Logo) -->
        <div class="text-5xl font-bold">
            <span class="text-red-300">SR</span><span class="text-white">NEWS</span>
        </div>

        <!-- Right Side (Navigation Menu) -->
        <div class="flex items-center pt-4 ml-auto space-x-6">
            <button @click="navigateToHome" class="text-lg text-white">Home</button>
            <div v-for="(item, index) in items" :key="index" class="relative">
                <button class="text-lg text-white">
                    {{ item.item }}
                </button>
                <!-- Dropdown menu -->
                <div v-if="item.subItems" class="absolute left-0 text-white bg-black shadow-md top-full">
                    <ul>
                        <li v-for="(sub, i) in item.subItems" :key="i" @click="handleClick(sub)"
                            class="px-4 py-2 cursor-pointer">
                            {{ sub.item }}
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </header>
</template>

<script setup>
import { ref } from 'vue';
import { router } from '@inertiajs/vue3';

const home = ref({
    value: 'home',
    route: '/'
});

const items = ref([
    {
        item: 'News',
        value: 'news',
        subItems: [
            { item: 'World' },
            { item: 'Local' }
        ]
    },
    {
        item: 'Entertainment',
        value: 'entertainment',
        subItems: [
            { item: 'Games', route: 'news/entertainment/games' },
            { item: 'Celebrity' }
        ]
    },
    {
        item: 'Sports',
        value: 'sports'
    },
    {
        item: 'Technology',
        value: 'technology'
    },
    {
        item: 'Health',
        value: 'health'
    },
    {
        item: 'Travel',
        value: 'travel'
    }
]);

const handleClick = (sub) => {
    if (sub.route) {
        router.get(`/${sub.route}`);
    }
};

const navigateToHome = () => {
    router.get(home.value.route);
};
</script>

<style scoped>
/* For the header, you can add any specific custom styles */
header {
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    /* Light shadow for the header */
}

header .text-white {
    color: white;
    /* Ensure text is white */
}

/* Dropdown styles */
header .relative:hover .absolute {
    display: block;
}

header .absolute {
    display: none;
    position: absolute;
    top: 100%;
    left: 0;
    background-color: black;
    border-radius: 8px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.3);
}

header .absolute ul {
    list-style-type: none;
    padding: 0;
    margin: 0;
}

header .absolute li:hover {
    background-color: #444;
}
</style>
