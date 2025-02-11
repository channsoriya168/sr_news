<template>
    <v-app>
        <Menu />
        <v-main>
            <v-container>
                <slot />
            </v-container>
        </v-main>
        <Footer />
    </v-app>
</template>
<script setup>
import Footer from '../components/User/Footer.vue';
import Menu from '../components/User/Menu.vue';
</script>