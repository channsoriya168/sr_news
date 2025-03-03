<template>
    <Modal type="slideover">
        <div class="w-full max-w-lg p-4 mx-auto bg-white rounded-lg shadow-lg">
            <h2 class="mb-4 text-lg font-semibold text-gray-700">Create Article</h2>

            <form @submit.prevent="submitForm">

                <input type="text" v-model="form.title"
                    class="w-full p-2 text-lg font-medium border-b focus:outline-none"
                    placeholder="Title of the article..." required>

                <textarea v-model="form.content"
                    class="w-full p-2 text-sm text-gray-600 border rounded-md focus:outline-none focus:ring focus:ring-gray-200"
                    rows="3" placeholder="Write something..."></textarea>

                <div v-if="imagePreview" class="relative mt-3">
                    <img :src="imagePreview" class="w-full rounded-lg">
                    <button type="button" @click="removeImage"
                        class="absolute p-1 text-white bg-black bg-opacity-50 rounded-full top-2 right-2">
                        ✕
                    </button>
                </div>

                <div class="flex items-center gap-2 mt-4">
                    <label for="image-upload"
                        class="flex items-center gap-2 px-3 py-2 text-blue-500 transition border border-blue-500 rounded-lg cursor-pointer hover:bg-blue-100">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 10l4.553-4.553a2 2 0 012.83 0l.117.117a2 2 0 010 2.83L18 12l4.553 4.553a2 2 0 010 2.83l-.117.117a2 2 0 01-2.83 0L15 14l-4.553 4.553a2 2 0 01-2.83 0l-.117-.117a2 2 0 010-2.83L12 12 7.447 7.447a2 2 0 010-2.83l.117-.117a2 2 0 012.83 0L15 10z">
                            </path>
                        </svg>
                        <span>Upload Image</span>
                    </label>
                    <input type="file" id="image-upload" class="hidden" @change="handleImageUpload">
                </div>

                <div class="flex justify-between gap-1 mt-4">
                    <div>
                        <label for="Category" class="mr-2">Category</label>
                        <select v-model="form.category_id"
                            class="w-3/4 p-2 border rounded-md focus:ring focus:ring-gray-200">
                            <option value="" disabled>Category</option>
                            <option v-for="category in categories" :key="category.id" :value="category.id">
                                {{ category.name }}
                            </option>
                        </select>
                    </div>
                    <div>
                        <label for="status" class="mr-2">Status</label>
                        <select v-model="form.status"
                            class="w-3/4 p-2 border rounded-md focus:ring focus:ring-gray-200">
                            <option value="draft">Draft</option>
                            <option value="published">Published</option>
                        </select>
                    </div>

                </div>
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
import { ref } from 'vue'

const categories = ref([])
const imagePreview = ref(null)

const fetchCategories = async () => {
    try {
        const response = await fetch(route('admin.category.index'))
        categories.value = await response.json()
    } catch (error) {
        console.error('Error fetching categories:', error)
    }
}

fetchCategories()

const form = useForm({
    title: '',
    content: '',
    category_id: '',
    img_url: '',
    status: 'draft'
})

const handleImageUpload = (event) => {
    const file = event.target.files[0]
    if (file) {
        form.img_url = file
        const reader = new FileReader()
        reader.onload = (e) => {
            imagePreview.value = e.target.result
        }
        reader.readAsDataURL(file)
    }
}

const removeImage = () => {
    form.img_url = ''
    imagePreview.value = null
}

const submitForm = () => {
    form.post(route('admin.article.store'))
}
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
