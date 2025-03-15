<template>
    <Modal type="slideover">
        <div class="w-full max-w-lg p-4 mx-auto bg-white rounded-lg shadow-lg">
            <h2 class="mb-4 text-lg font-semibold text-gray-700">Create Article</h2>

            <form @submit.prevent="submitForm">

                <!-- Title Input -->
                <input type="text" v-model="form.title" id="title" name="title"
                    class="w-full p-2 text-lg font-medium border-b focus:outline-none"
                    placeholder="Title of the article..." required>

                <!-- Content Textarea -->
                <textarea v-model="form.content" id="content" name="content"
                    class="w-full p-2 text-sm text-gray-600 border rounded-md focus:outline-none focus:ring focus:ring-gray-200"
                    rows="3" placeholder="Write content..."></textarea>

                <!-- Image Preview -->
                <div v-if="imagePreview" class="relative mt-3">
                    <img :src="imagePreview" class="w-full rounded-lg">
                    <button type="button" @click="removeImage"
                        class="absolute p-1 text-white bg-black bg-opacity-50 rounded-full top-2 right-2">
                        ✕
                    </button>
                </div>

                <!-- Image Upload -->
                <div class="flex items-center gap-2 mt-4">
                    <label for="img_upload"
                        class="flex items-center gap-2 px-3 py-2 text-blue-500 transition border border-blue-500 rounded-lg cursor-pointer hover:bg-blue-100">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 10l4.553-4.553a2 2 0 012.83 0l.117.117a2 2 0 010 2.83L18 12l4.553 4.553a2 2 0 010 2.83l-.117.117a2 2 0 01-2.83 0L15 14l-4.553 4.553a2 2 0 01-2.83 0l-.117-.117a2 2 0 010-2.83L12 12 7.447 7.447a2 2 0 010-2.83l.117-.117a2 2 0 012.83 0L15 10z">
                            </path>
                        </svg>
                        <span>Upload Image</span>
                    </label>
                    <input type="file" id="img_upload" name="img_upload" class="hidden" @change="handleImageUpload">
                </div>

                <!-- Category and Status -->
                <div class="flex justify-between gap-1 mt-4">
                    <div class="pt-4 mb-4">
                        <label for="category" class="mr-2">Category</label>
                        <select v-model="form.category_id" name="category" id="category"
                            class="w-3/4 p-2 border rounded-md focus:ring focus:ring-gray-200">
                            <option v-for="category in categories" :key="category.id" :value="category.id">
                                {{ category.name }}
                            </option>
                        </select>
                    </div>
                    <!--author-->
                    <div class="pt-4 mb-4">
                        <label for="author" class="mr-2">Author</label>
                        <select v-model="form.author_id" name="author" id="author"
                            class="w-3/4 p-2 border rounded-md focus:ring focus:ring-gray-200">
                            <option v-for="author in authors" :key="author.id" :value="author.id">
                                {{ author.name }}
                            </option>
                        </select>
                    </div>
                </div>

                <div class="flex items-center justify-between gap-1 align-item">
                    <!-- Published Date -->
                    <div class="pt-4 mb-4">
                        <label for="published_date" class="block text-black">Published Date</label>
                        <input type="date" v-model="form.published_date" id="published_date" name="published_date"
                            class="w-full p-2 border rounded">
                    </div>
                    <!-- Status -->
                    <div class="pt-4 mb-4">
                        <label for="status" class="mr-2">Status</label>
                        <select v-model="form.status" name="status" id="status"
                            class="w-3/4 p-2 border rounded-md focus:ring focus:ring-gray-200">
                            <option v-for="status in props.statuses" :key="status" :value="status">
                                {{ status }}
                            </option>
                        </select>
                    </div>
                </div>

                <!-- Submit Button -->
                <button type="submit"
                    class="w-full py-2 mt-4 font-semibold text-white transition bg-blue-500 rounded-lg hover:bg-blue-600">
                    Post
                </button>
            </form>
        </div>
    </Modal>
</template>


<script setup>
import { useForm } from '@inertiajs/vue3'
import { route } from 'ziggy-js'
import { watch, ref, defineProps } from 'vue'

const props = defineProps({
    statuses: Array,
    categories: Array,
    authors: Array,
});

const imagePreview = ref(null);

const form = useForm({
    title: '',
    content: '',
    author_id: null,
    category_id: null,
    img_upload: null,
    published_date: '',
    status: null,
});

const handleImageUpload = (event) => {
    const file = event.target.files[0];
    if (file) {
        form.img_upload = file;
        const reader = new FileReader();
        reader.onload = (e) => {
            imagePreview.value = e.target.result;
        };
        reader.readAsDataURL(file);
    }
};

const removeImage = () => {
    form.img_url = null;
    imagePreview.value = null;
};

watch(() => props.categories, (newCategories) => {
    if (newCategories.length > 0 && form.category_id === null) {
        form.category_id = newCategories[0].id;
    }
}, { immediate: true });

watch(() => props.statuses, (newStatuses) => {
    if (newStatuses.length > 0 && form.status === null) {
        form.status = newStatuses[0];
    }
}, { immediate: true });

watch(() => props.authors, (newAuthors) => {
    if (newAuthors.length > 0 && form.author_id === null) {
        form.author_id = newAuthors[0].id;
    }
}, { immediate: true });


const submitForm = () => {
    form.post(route('admin.article.store'));
};
</script>



<style scoped>
.modal-content-wrapper {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 9999;
}
</style>
