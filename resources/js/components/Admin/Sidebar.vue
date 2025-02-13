<template>

    <v-navigation-drawer floating permanent :width="300" class="sidebar" elevation-10>

        <v-list density="compact" nav>
            <v-list-adapter>
                <!-- image -->
                <v-list-item>
                    <v-list-item-avatar>
                        <v-img src="https://cdn.vuetifyjs.com/images/logos/logo.svg"></v-img>
                    </v-list-item-avatar>
                    <v-list-item-content class="d-flex f-d-c justify-content-center flex-column align-items-center">
                        <v-list-item-title class="title">Chann Soriya</v-list-item-title>
                        <v-list-item-subtitle>admin</v-list-item-subtitle>
                    </v-list-item-content>
                </v-list-item>
            </v-list-adapter>
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
        <v-toolbar-title>{{ currentTitle }}</v-toolbar-title>
    </v-app-bar>
</template>
<script setup>
import { ref } from 'vue';
import { router } from '@inertiajs/vue3'
const currentTitle = ref('dashboard');
const items = ref([
    {
        title: 'dashboard',
        app_bar: "Amin Dashboard",
        icon: 'mdi-view-dashboard',
        value: 'dashboard',
        route: '/admin/dashboard'
    },
    {
        title: 'Authors',
        app_bar: "Author Dashboard",
        icon: 'mdi-view-dashboard',
        value: 'author',
        route: '/admin/author'
    },
    {
        title: 'setting',
        icon: 'mdi-cog',
        value: 'setting',
        sub_items: [
            {
                title: 'dashboard',
                icon: 'mdi-view-dashboard',
                value: 'dashboard',
                route: '/admin/dashboard'
            },
            {
                title: 'Authors',
                icon: 'mdi-view-dashboard',
                value: 'author',
                route: '/admin/author'
            },
        ]


    }
]);
const openPage = (route) => {
    currentTitle.value = route.app_bar;
    router.get(route.route);
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
