<template>
    <Modal type="slideover" v-slot="{ close }">
        <div>
            <h1>Create User</h1>
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

                <!-- Password Field -->
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" v-model="form.password" class="form-control" id="password" name="password"
                        required>
                </div>

                <!-- Role Selection -->
                <div class="form-group">
                    <label for="role">Role</label>
                    <select v-model="form.role" class="form-control" id="role" name="role" required>
                        <option v-for="role in props.roles" :key="role" :value="role">{{ role }}</option>
                    </select>
                </div>

                <!-- Email Verified Checkbox -->
                <div class="form-group">
                    <label for="email_verified_at">Email Verified</label>
                    <input type="checkbox" v-model="form.email_verified_at" id="email_verified_at"
                        name="email_verified_at">
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
import { useForm } from '@inertiajs/vue3'
import { route } from 'ziggy-js'
import { defineProps } from 'vue'

// Props from Laravel backend (must be passed from Controller)
const props = defineProps({
    roles: Array // Expecting an array of roles from Laravel
});

// Initialize form data
const form = useForm({
    name: '',
    email: '',
    password: '',
    role: props.roles.length > 0 ? props.roles[0] : '', // Default to first role
    email_verified_at: false
});

// Form submission logic
const submitForm = (close) => {
    form.email_verified_at = form.email_verified_at ? new Date().toISOString() : null;
    form.post(route('admin.user.store'));
};
</script>
