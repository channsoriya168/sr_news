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
import Menu from '../components/Admin/Menu.vue'
import Footer from '../components/Admin/Footer.vue'
</script>