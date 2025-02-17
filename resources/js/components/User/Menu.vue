<template>
    <v-app-bar class="py-3 m-0 transition-all relativepx-6 fw-full ">
        <!-- Left Side (Logo) -->
        <div class="text-5xl font-bold">
            <span class="text-red-500">SR</span><span>NEWS</span>
        </div>


        <!-- Right Side (Navigation Menu) -->
        <template v-slot:append>
            <div class="flex items-center">
                <v-btn @click="navigateToHome" class="mx-2 text-lg">Home</v-btn>
                <v-menu v-for="(item, index) in items" :key="index" open-on-hover>
                    <template v-slot:activator="{ props }">
                        <v-btn v-bind="props" variant="text" class="mx-2 text-lg">
                            {{ item.item }}
                            <v-icon right>mdi-chevron-down</v-icon>
                        </v-btn>
                    </template>
                    <v-list>
                        <v-list-item v-for="(sub, i) in item.subItems" :key="i" @click="handleClick(sub)"
                            class="cursor-pointer">
                            <v-list-item-title>{{ sub.item }}</v-list-item-title>
                        </v-list-item>
                    </v-list>
                </v-menu>
            </div>
        </template>

    </v-app-bar>
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
            {
                item: 'World',
            },
            {
                item: 'Local'
            }
        ]
    },
    {
        item: 'Entertainment',
        value: 'entertainment',
        subItems: [
            {
                item: 'Games',
                value: 'games',
                route: 'news/entertainment/games'

            },
            {
                item: 'Celebrity'
            }
        ]
    },
    {
        item: 'Sports',
        value: 'sports',
    },
    {
        item: 'Technology',
        value: 'technology',
    },
    {
        item: 'Health',
        value: 'health',
    },
    {
        item: 'Travel',
        value: 'travel',
    },
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
