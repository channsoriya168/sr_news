<template>
    <HeadApp title="Category" />

    <v-container fluid>
        <v-card class="data-table-card" elevation="2">
            <v-card-title
                class="table-header d-flex justify-space-between align-center"
            >
                <h3>ប្រភេទនែព័ត៍មាន</h3>
                <v-btn
                    @click="createCallback"
                    color="primary"
                    prepend-icon="mdi-plus"
                    variant="elevated"
                >
                    បង្កើត
                </v-btn>
            </v-card-title>

            <v-data-table-server
                :headers="headers"
                :items="serverItems"
                :items-length="totalItems"
                :loading="loading"
                :items-per-page="itemsPerPage"
                :items-per-page-options="[5, 10, 25, 50]"
                @update:options="loadItems"
                class="custom-data-table"
                item-value="id"
                 elevation="0"
            >
                <template v-slot:[`item.actions`]="{ item }">
                    <div class="action-buttons">
                        <v-btn
                            icon="mdi-eye"
                            variant="text"
                            size="small"
                            color="info"
                            @click="viewCallback(item)"
                        ></v-btn>
                        <v-btn
                            icon="mdi-pencil"
                            variant="text"
                            size="small"
                            color="primary"
                            @click="editCallback(item)"
                        ></v-btn>
                        <v-btn
                            icon="mdi-delete"
                            variant="text"
                            size="small"
                            color="error"
                            @click="deleteCallback(item)"
                        ></v-btn>
                    </div>
                </template>

                <template v-slot:loading>
                    <div class="loading-state">
                        <v-progress-circular
                            indeterminate
                            color="primary"
                            size="64"
                        ></v-progress-circular>
                        <p class="mt-4">Loading categories...</p>
                    </div>
                </template>

                <template v-slot:no-data>
                    <div class="no-data-state">
                        <i class="mdi mdi-folder-open-outline no-data-icon"></i>
                        <h4>No categories found</h4>
                        <p>Get started by creating your first category</p>
                        <v-btn
                            @click="createCallback"
                            color="primary"
                            variant="elevated"
                            prepend-icon="mdi-plus"
                            class="mt-4"
                        >
                            Create Category
                        </v-btn>
                    </div>
                </template>
            </v-data-table-server>
        </v-card>
    </v-container>
</template>

<script setup>
import { computed, ref } from "vue";
import { router } from "@inertiajs/vue3";
import { route } from "ziggy-js";
import HeadApp from "@/components/Admin/HeadApp.vue";

const props = defineProps({
    categories: {
        type: Object,
        required: true,
    },
});

const loading = ref(false);

const serverItems = computed(() => {
    return props.categories?.data || [];
});

const totalItems = computed(() => {
    return props.categories?.total || 0;
});

const itemsPerPage = computed(() => {
    return props.categories?.per_page || 10;
});

// Simple headers for the data table
const headers = [
    {
        title: "ល.រ",
        align: "start",
        sortable: false,
        key: "id",
        width: "80px",
    },
    {
        title: "ឈ្មោះ",
        align: "start",
        sortable: true,
        key: "name",
    },
    {
        title: "",
        align: "start",
        sortable: false,
        key: "description",
    },
    {
        title: "Actions",
        align: "center",
        sortable: false,
        key: "actions",
        width: "150px",
    },
];


// Format date function
const formatDate = (dateString) => {
    if (!dateString) return "-";
    return new Date(dateString).toLocaleDateString("en-US", {
        year: "numeric",
        month: "short",
        day: "numeric",
    });
};

/**
 * Load items from the server
 */
function loadItems({ page, itemsPerPage, sortBy }) {
    loading.value = true;

    router.reload({
        data: {
            page,
            itemsPerPage,
            sortBy: sortBy?.[0]?.key,
            sortOrder: sortBy?.[0]?.order,
        },
        onFinish: () => {
            loading.value = false;
        },
    });
}

// Callback functions
const viewCallback = (item) => {
    router.get(
        route("admin.category.show", {
            category: item.id,
        }),
        {},
        {
            preserveState: false,
            preserveScroll: false,
        },
    );
};

const editCallback = (item) => {
    router.get(
        route("admin.category.edit", {
            category: item.id,
        }),
        {},
        {
            preserveState: false,
            preserveScroll: false,
        },
    );
};

const deleteCallback = (item) => {
    router.get(
        route("admin.category.delete", {
            category: item.id,
        }),
        {},
        {
            preserveState: false,
            preserveScroll: false,
        },
    );
};

const createCallback = () => {
    router.get(
        route("admin.category.create"),
        {},
        {
            preserveState: false,
            preserveScroll: false,
        },
    );
};
</script>

<style scoped>
/* Data Table Card */
.data-table-card {
    border-radius: 8px;
    border: 1px solid rgba(0, 0, 0, 0.12);
}

.table-header {
    padding: 16px 24px;
    border-bottom: 1px solid rgba(0, 0, 0, 0.12);
    background: #fafafa;
}

.table-header h3 {
    font-size: 1.5rem;
    font-weight: 500;
    margin: 0;
    color: #333;
}

/* Action Buttons */
.action-buttons {
    display: flex;
    gap: 4px;
    justify-content: center;
}

/* Loading State */
.loading-state {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    padding: 40px 20px;
    color: #666;
}

/* No Data State */
.no-data-state {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    padding: 40px 20px;
    text-align: center;
}

.no-data-icon {
    font-size: 48px;
    color: #ddd;
    margin-bottom: 16px;
}

.no-data-state h4 {
    color: #333;
    margin-bottom: 8px;
    font-weight: 500;
}

.no-data-state p {
    color: #666;
    margin-bottom: 24px;
}
</style>
