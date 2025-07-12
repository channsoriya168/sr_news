<template>
    <v-app>
        <side-bar></side-bar>
        <!-- page content -->
        <v-main class="admin-main">
            <div class="content-wrapper">
                <slot></slot>
            </div>
        </v-main>
    </v-app>
</template>

<script setup>
import SideBar from "../components/Admin/Sidebar.vue";
</script>

<style scoped>
.admin-main {
    min-height: 100vh;
}

.content-wrapper {
    padding: 2rem;
    max-width: 1400px;
    margin: 0 auto;
}

.v-theme--dark .admin-main {
    background: #121212;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .content-wrapper {
        padding: 1rem;
    }
}
</style>
