<template>
    <Modal type="slideover" v-slot="{ close }">
        <div>
            <h1>Edit User</h1>
            <form @submit.prevent="submitForm(close)">
                <!-- Name Field -->
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" v-model="form.name" class="form-control" id="name" name="name" required>
                </div>

                <!-- Email Field -->
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" v-model="form.email" class="form-control" id="email" name="email" required>
                </div>

                <!-- Role Selection -->
                <div class="form-group">
                    <label for="role">Role</label>
                    <select v-model="form.role" class="form-control" id="role" name="role" required>
                        <option v-for="role in props.roles" :key="role" :value="role">{{ role }}</option>
                    </select>
                </div>

                <!-- Submit Button -->
                <button type="submit"
                    class="mt-4 duration-200 ease-in-out transform border-none hover:scale-105 btn btn-primary bg-gradient-to-r from-gray-200 to-red-500">
                    Submit
                </button>
            </form>
        </div>
    </Modal>
</template>

<script setup>
import { defineProps } from 'vue';
import { useForm } from '@inertiajs/vue3';
import { route } from 'ziggy-js';

const props = defineProps({
    user: {
        type: Object,
        required: true,
    },
    roles: Array
});

const form = useForm({
    name: props.user.name,
    email: props.user.email,
    role: props.user.role
});

const submitForm = (close) => {
    form.put(route('admin.user.update', props.user.id), {
        onSuccess: () => {
            close();
        },
        onError: () => {
            console.error('Failed to update user');
        }
    });
}
</script>