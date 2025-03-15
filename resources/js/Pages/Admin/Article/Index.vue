<template>
    <HeadApp title="Article"></HeadApp>
    <data-table-server :showNo="true" title="Article" :serverItems="serverItems" :items-length="totalItems"
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
    articles: {
        type: Object,
        required: true,
    }
});

const serverItems = computed(() => {
    return props.articles?.data || [];
});
const totalItems = computed(() => {
    return props.articles?.total || 0;
});

const itemsPerPage = computed(() => {
    return props.articles?.per_page || 10;
});

const loading = ref(false);

const headers = [
    {
        title: 'Author',
        align: 'start',
        sortable: true,
        key: 'author',
    },
    {
        title: 'Title',
        align: 'start',
        sortable: true,
        key: 'title',
    },
    {
        title: 'Content',
        align: 'start',
        sortable: true,
        key: 'content',
    },
    {
        title: 'Category',
        align: 'start',
        sortable: true,
        key: 'category',
    },
    {
        title: 'Image Url',
        align: 'start',
        sortable: true,
        key: 'image url'
    },
    {
        title: 'Publish Date',
        align: 'start',
        sortable: true,
        key: 'author',
    },
    {
        title: 'Status',
        align: 'start',
        sortable: true,
        key: 'status',
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
    visitModal(route('admin.article.show', {
        article: item.id,
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
    visitModal(route('admin.article.edit', {
        article: item.id,
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
    visitModal(route('admin.article.delete', {
        article: item.id,
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
    visitModal(route('admin.article.create'), {
        config: {
            slideover: false,
            position: 'center',
            closeExplicitly: true,
            maxWidth: '2xl',
        },

    });
};
</script>
