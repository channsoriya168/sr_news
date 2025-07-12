<template>
    <HeadApp title="Create Category" />
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Create Category</h1>
        <v-breadcrumbs :items="breadcrumbs">
            <template v-slot:item="{ item, index }">
                <v-breadcrumbs-item :href="item.href" :disabled="item.disabled">
                    <v-icon
                        v-if="item.icon"
                        :color="index === 0 ? 'primary' : undefined"
                        >{{ item.icon }}</v-icon
                    >
                    <span v-else>{{ item.title }}</span>
                </v-breadcrumbs-item>
            </template>
        </v-breadcrumbs>

        <CategoryForm />
    </div>
</template>

<script setup>
import { useForm } from "@inertiajs/vue3";
import { route } from "ziggy-js";
import CategoryForm from "../../../components/Admin/CategoryForm.vue";

const form = useForm({
    name: "",
    description: "",
});

const breadcrumbs = [
    { icon: "mdi-home", disabled: false, href: route("admin.category.index") },
    { title: "Category", disabled: true, href: "#" },
];

const submitForm = () => {
    form.post(route("admin.category.store"), {
        onSuccess: () => {
            // Modal will close automatically on successful redirect
        },
        onError: () => {
            // Handle errors if needed
        },
    });
};
</script>
