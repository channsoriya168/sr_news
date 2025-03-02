<template>
    <v-app>
        <Header />
        <v-main>
            <slot></slot>
        </v-main>
        <Footer/>
    </v-app>
</template>

<script setup>

import Header from '../components/Author/Header.vue';
import Footer from '../components/Author/Footer.vue';

</script>
