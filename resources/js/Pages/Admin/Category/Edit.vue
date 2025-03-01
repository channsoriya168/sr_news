<template>
    <Modal v-slot="{ close }">
        <div>
            <h1>Edit Category</h1>
            <form @submit.prevent="submitForm">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" v-model="form.name" class="form-control" id="name" name="name">
                </div>
                <div class="form-group">
                    <label for="code">Description</label>
                    <input type="text" v-model="form.description" class="form-control" id="description"
                        name="description">
                </div>
                <button type="submit" @click="close"
                    class="mt-4 duration-200 ease-in-out transform border-none hover:scale-105 btn btn-primary bg-gradient-to-r from-gray-200 to-red-500">Submit</button>
            </form>
        </div>
    </Modal>
</template>

<script setup>
import { defineProps } from 'vue';
import { useForm } from '@inertiajs/vue3';
import { route } from 'ziggy-js';

const props = defineProps({
    category: {
        type: Object,
        required: true,
    }
});

const form = useForm({
    name: props.category.name,
    description: props.category.description,
});

const submitForm = () => {
    form.put(route('admin.category.update', props.category.id));
}
</script>
