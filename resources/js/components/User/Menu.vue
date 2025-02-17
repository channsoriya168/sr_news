<template>
    <v-app-bar class="relativepx-6 py-3 m-0 transition-all fw-full ">
        <!-- Left Side (Logo) -->
        <div class="text-5xl font-bold">
            <span class="text-red-500">SR</span><span>NEWS</span>
        </div>


        <!-- Right Side (Navigation Menu) -->
        <template v-slot:append>
            <div class="flex items-center">
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
        item: 'Business',
        value: 'business',
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

const openPage = (route) => {
    currentTitle.value = route.app_bar;
    router.get(route.route);
}

</script>
