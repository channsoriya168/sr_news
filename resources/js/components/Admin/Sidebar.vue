<template>

    <v-navigation-drawer v-model="drawer" floating permanent :width="300" class="sidebar" elevation-10>

        <v-list density="compact" nav>
            <v-list-item class="d-flex flex-column">
                <v-avatar size="200">
                    <v-img src="/assets/images/Rupp_logo.png"></v-img>
                </v-avatar>
                <v-list-item-title class="text-center">Chann Soriya</v-list-item-title>
                <v-list-item-subtitle class="text-center">admin</v-list-item-subtitle>
            </v-list-item>
            <div v-for="(item, index) in items" :key="index">
                <v-list-group v-if="item.sub_items" :value="item.value">
                    <template v-slot:activator="{ props }">
                        <v-list-item active-class="active-item" :height="50" v-bind="props" :title="item.title"
                            :prependIcon="item.icon"></v-list-item>
                    </template>
                    <v-list-item active-class="active-item" :height="50" v-for="(sub_item, index) in item.sub_items"
                        :key="index" :prepend-icon="sub_item.icon" :title="sub_item.title" @click="openPage(sub_item)"
                        :value="sub_item.value"></v-list-item>
                </v-list-group>
                <v-list-item active-class="active-item" :height="50" v-else :prepend-icon="item.icon"
                    :title="item.title" @click="openPage(item)" :value="item.value"></v-list-item>
            </div>
        </v-list>
    </v-navigation-drawer>

    <v-app-bar elevation-0 class="bg-slate-400" app>
        <template v-slot:prepend>
            <v-btn icon @click="drawer = !drawer">
                <v-icon>{{ drawer ? 'mdi-arrow-left' : 'mdi-menu' }}</v-icon>
            </v-btn>
        </template>
        <v-toolbar-title>{{ currentTitle }}</v-toolbar-title>

        <v-spacer></v-spacer>

        <v-btn icon>
            <v-icon>mdi-magnify</v-icon>
        </v-btn>

        <v-btn icon>
            <v-icon>mdi-heart</v-icon>
        </v-btn>

        <v-btn icon>
            <v-icon>mdi-dots-vertical</v-icon>
        </v-btn>
    </v-app-bar>

</template>


<script setup>

import { ref } from 'vue';
import { router } from '@inertiajs/vue3';
import { route } from 'ziggy-js';

const drawer = ref(true);
const currentTitle = ref('dashboard');
const items = ref([
    {
        title: 'dashboard',
        app_bar: "Admin Dashboard",
        icon: 'mdi-view-dashboard',
        value: 'dashboard',
        route: 'dashboard'
    },
    {
        title: 'Authors',
        app_bar: "Author Dashboard",
        icon: 'mdi-view-dashboard',
        value: 'author',
        route: 'author.index'
    },
    {
        title: 'Category',
        app_bar: "Category Dashboard",
        icon: 'mdi-view-grid',
        value: 'category',
        route: 'admin.category.index'
    },
    {
        title: 'setting',
        icon: 'mdi-cog',
        sub_items: [
            {
                title: 'dashboard',
                icon: 'mdi-view-dashboard',
                value: 'dashboard1',
                route: 'dashboard'
            },
            {
                title: 'Authors',
                icon: 'mdi-view-dashboard',
                value: 'author2',
                route: 'author.index'
            },
        ]
    }
]);
const openPage = (item) => {
    currentTitle.value = item.app_bar || item.title;
    router.get(route(item.route));
}

</script>

<style scoped>
.active-item {
    background-color: rgba(0, 0, 0, 0.107);
}

.sidebar {
    border-right: 1px solid rgba(0, 0, 0, 0.12);
}
</style>
