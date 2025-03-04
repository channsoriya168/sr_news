<template>
    <HeadApp title="Author" />
    <v-app>
        <Header />
        <Buttons @create="createCallback" />
        <v-main>
            <slot></slot>
        </v-main>
        <Footer />
    </v-app>
</template>

<script setup>

import Header from '../components/Author/Header.vue';
import Footer from '../components/Author/Footer.vue';
import Buttons from '../components/Author/Buttons.vue';
import { route } from 'ziggy-js';
import { visitModal } from '@inertiaui/modal-vue';
import HeadApp from '@/components/Admin/HeadApp.vue'

const createCallback = () => {
    visitModal(route('admin.article.create'), {
        config: {
            slideover: false,
            position: 'center',
            closeExplicitly: false,
            maxWidth: '2xl',
        },

    });
};
</script>
