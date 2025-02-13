<template>
    <v-app>
        <side-bar></side-bar>
        <!-- page content -->
        <v-main>
            <slot></slot>
        </v-main>
    </v-app>
</template>
<script setup>
import SideBar from '../components/Admin/Sidebar.vue';
</script>