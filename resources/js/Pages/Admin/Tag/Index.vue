<template>
    <HeadApp title="Tag"></HeadApp>
    <data-table-server :showNo="true" title="Tag" :serverItems="serverItems" :items-length="totalItems"
        :headers="headers" :loading="loading" :items-per-page="itemsPerPage" item-value="id" @update:options="loadItems"
        :has-create="true" @view="viewCallback" @delete="deleteCallback" @edit="editCallback"
        @create="createCallback" />
</template>

<script setup>
import { computed, ref } from 'vue'
import { router } from '@inertiajs/vue3';
import { route } from 'ziggy-js';
import { visitModal } from '@inertiaui/modal-vue';
import HeadApp from '@/components/Admin/HeadApp.vue'

const props = defineProps({
    tags: {
        type: Object,
        required: true,
    }
});

const serverItems = computed(() => {
    return props.tags?.data || [];
});
const totalItems = computed(() => {
    return props.tags?.total || 0;
});

const itemsPerPage = computed(() => {
    return props.tags?.per_page || 10;
});

const loading = ref(false);

const headers = [
    {
        title: 'Name',
        align: 'start',
        sortable: true,
        key: 'name',
    },
    {
        title: 'Created At',
        align: 'start',
        sortable: true,
        key: 'created_at',
    },
    {
        title: 'Updated At',
        align: 'start',
        sortable: true,
        key: 'updated_at',
    },
];


/**
 * Load items from the server
 *
 * @param {Object} options
 * @param {Number} options.page
 * @param {Number} options.itemsPerPage
 * @param {Array} options.sortBy
 *
 * @return {void}
 */
function loadItems({ page, itemsPerPage }) {
    router.reload({
        data: {
            page,
            itemsPerPage,
        },
    });
}

const viewCallback = (item) => {
    visitModal(route('admin.tag.show', {
        tag: item.id,
    }), {
        method: 'get',
        config: {
            slideover: false,
            position: 'center',
            closeExplicitly: true,
            maxWidth: '2xl',
        },
    });

};

const editCallback = (item) => {
    visitModal(route('admin.tag.edit', {
        tag: item.id,
    }), {
        method: 'get',
        config: {
            slideover: true,
            position: 'right',
            closeExplicitly: true,
            maxWidth: '2xl',
        },
    });
};

const deleteCallback = (item) => {
    visitModal(route('admin.tag.delete', {
        tag: item.id,
    }), {
        config: {
            slideover: false,
            position: 'center',
            closeExplicitly: true,
            maxWidth: '2xl',
        },

    });

};

const createCallback = () => {
    visitModal(route('admin.tag.create'), {
        config: {
            slideover: true,
            position: 'right',
            closeExplicitly: true,
            maxWidth: '2xl',
        },

    });
};
</script>
