<template>
    <Modal v-slot="{ close }">
        <div>
            <h1>Edit Tag</h1>
            <form @submit.prevent="submitForm">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" v-model="form.name" class="form-control" id="name" name="name">
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
    tag: {
        type: Object,
        required: true,
    }
});

const form = useForm({
    name: props.tag.name,
});

const submitForm = () => {
    form.put(route('admin.tag.update', props.tag.id));
}
</script>
