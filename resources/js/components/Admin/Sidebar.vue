<template>
    <v-navigation-drawer
        v-model="drawer"
        permanent
        :width="280"
        class="sidebar-modern"
        elevation="0"
    >
        <!-- Logo/Brand Section -->
        <div class="sidebar-header">
            <div class="logo-container">
                <v-icon size="40" color="primary">mdi-newspaper-variant</v-icon>
                <div class="brand-text">
                    <h2 class="brand-title">SR News</h2>
                    <p class="brand-subtitle">Admin Panel</p>
                </div>
            </div>
        </div>

        <!-- Navigation Menu -->
        <v-list class="sidebar-menu" nav>
            <div
                v-for="(item, index) in items"
                :key="index"
                class="menu-item-wrapper"
            >
                <!-- Group with Sub-items -->
                <v-list-group
                    v-if="item.sub_items"
                    :value="item.value"
                    class="menu-group"
                >
                    <template v-slot:activator="{ props }">
                        <v-list-item
                            v-bind="props"
                            :title="item.title"
                            :prepend-icon="item.icon"
                            class="menu-item group-activator"
                            :class="{ active: isActive(item) }"
                        >
                            <template v-slot:append>
                                <v-icon size="16">mdi-chevron-down</v-icon>
                            </template>
                        </v-list-item>
                    </template>

                    <v-list-item
                        v-for="(sub_item, subIndex) in item.sub_items"
                        :key="subIndex"
                        :prepend-icon="sub_item.icon"
                        :title="sub_item.title"
                        @click="openPage(sub_item)"
                        :value="sub_item.value"
                        class="menu-item sub-item"
                        :class="{ active: isActive(sub_item) }"
                    ></v-list-item>
                </v-list-group>

                <!-- Single Menu Item -->
                <v-list-item
                    v-else
                    :prepend-icon="item.icon"
                    :title="item.title"
                    @click="openPage(item)"
                    :value="item.value"
                    class="menu-item"
                    :class="{ active: isActive(item) }"
                >
                    <template v-slot:prepend>
                        <v-icon :icon="item.icon" class="menu-icon"></v-icon>
                    </template>
                </v-list-item>
            </div>
        </v-list>

        <!-- Footer Section -->
        <div class="sidebar-footer">
            <v-divider class="mb-4"></v-divider>
            <div class="user-info">
                <v-avatar size="32" color="primary">
                    <v-icon>mdi-account</v-icon>
                </v-avatar>
                <div class="user-details">
                    <p class="user-name">Admin User</p>
                    <p class="user-role">Administrator</p>
                </div>
            </div>
        </div>
    </v-navigation-drawer>
</template>

<script setup>
import { ref, computed } from "vue";
import { router, usePage } from "@inertiajs/vue3";
import { route } from "ziggy-js";

const drawer = ref(true);
const currentTitle = ref("dashboard");
const page = usePage();

const items = ref([
    {
        title: "Dashboard",
        icon: "mdi-view-dashboard",
        value: "dashboard",
        route: "dashboard",
    },
    {
        title: "Categories",
        icon: "mdi-folder-multiple",
        value: "category",
        route: "admin.category.index",
    },
    {
        title: "Articles",
        icon: "mdi-newspaper",
        value: "article",
        route: "admin.article.index",
    },
    {
        title: "Users",
        icon: "mdi-account-multiple",
        value: "users",
        route: "admin.users.index",
    },
    {
        title: "Settings",
        icon: "mdi-cog",
        value: "settings",
        sub_items: [
            {
                title: "General",
                icon: "mdi-cog-outline",
                value: "general",
                route: "admin.settings.general",
            },
            {
                title: "User Roles",
                icon: "mdi-account-key",
                value: "roles",
                route: "admin.settings.roles",
            },
            {
                title: "System",
                icon: "mdi-server",
                value: "system",
                route: "admin.settings.system",
            },
        ],
    },
]);

const isActive = (item) => {
    const currentRoute = page.component;
    const routeName = route().current();

    // Check if current route matches item route
    if (item.route && routeName === item.route) {
        return true;
    }

    // Check for partial matches (e.g., admin.category.* routes)
    if (item.route && routeName && routeName.startsWith(item.route)) {
        return true;
    }

    return false;
};

const openPage = (item) => {
    currentTitle.value = item.app_bar || item.title;
    if (item.route) {
        router.get(route(item.route));
    }
};
</script>

<style scoped>
.sidebar-modern {
    background: linear-gradient(
        135deg,
        #1a1a2e 0%,
        #16213e 50%,
        #0f3460 100%
    ) !important;
    border-right: none !important;
    color: white;
}

.sidebar-header {
    padding: 24px 20px;
    border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    margin-bottom: 16px;
}

.logo-container {
    display: flex;
    align-items: center;
    gap: 12px;
}

.brand-text {
    flex: 1;
}

.brand-title {
    font-size: 1.5rem;
    font-weight: 700;
    margin: 0;
    color: white;
    letter-spacing: -0.5px;
}

.brand-subtitle {
    font-size: 0.875rem;
    color: rgba(255, 255, 255, 0.7);
    margin: 0;
    font-weight: 400;
}

.sidebar-menu {
    padding: 0 12px;
    background: transparent !important;
}

.menu-item-wrapper {
    margin-bottom: 4px;
}

.menu-item {
    border-radius: 12px !important;
    margin: 2px 0 !important;
    color: rgba(255, 255, 255, 0.8) !important;
    transition: all 0.3s ease !important;
    min-height: 48px !important;
}

.menu-item:hover {
    background: rgba(255, 255, 255, 0.1) !important;
    color: white !important;
    transform: translateX(4px);
}

.menu-item.active {
    background: rgba(255, 255, 255, 0.15) !important;
    color: white !important;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
}

.menu-item.sub-item {
    margin-left: 16px !important;
    font-size: 0.9rem !important;
}

.menu-icon {
    color: inherit !important;
}

.group-activator {
    font-weight: 600 !important;
}

.sidebar-footer {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    padding: 20px;
    background: rgba(0, 0, 0, 0.1);
    backdrop-filter: blur(10px);
}

.user-info {
    display: flex;
    align-items: center;
    gap: 12px;
}

.user-details {
    flex: 1;
}

.user-name {
    font-size: 0.9rem;
    font-weight: 600;
    color: white;
    margin: 0;
    line-height: 1.2;
}

.user-role {
    font-size: 0.75rem;
    color: rgba(255, 255, 255, 0.7);
    margin: 0;
    line-height: 1.2;
}

/* Dark theme adjustments */
.v-theme--dark .sidebar-modern {
    background: linear-gradient(135deg, #1a1a2e 0%, #16213e 50%, #0f3460 100%);
}

/* Override Vuetify list styles */
:deep(.v-list) {
    background: transparent !important;
}

:deep(.v-list-item) {
    color: inherit !important;
}

:deep(.v-list-item__prepend) {
    color: inherit !important;
}

:deep(.v-list-item-title) {
    color: inherit !important;
    font-weight: 500 !important;
}

/* Group expand/collapse animation */
:deep(.v-list-group__items) {
    background: rgba(0, 0, 0, 0.1) !important;
    border-radius: 8px;
    margin: 4px 0;
}
</style>
