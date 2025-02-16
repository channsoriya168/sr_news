<template>
    <v-app>
        <Menu />
        <v-main>
            <slot></slot>
        </v-main>
        <Footer />
    </v-app>
</template>
<script setup>

import Menu from '@/components/User/Menu.vue';
import Footer from '../components/User/Footer.vue';

</script>
