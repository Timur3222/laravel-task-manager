<script setup>
import { usePage } from "@inertiajs/vue3";
import { useToast } from "primevue/usetoast";

const toast = useToast();
const message = usePage().props.flash.message;

if (message) {
    toast.add({
        severity: "success",
        detail: message,
        life: 3000,
    });
}
</script>

<template>
    <h1 class="mb-4 text-6xl font-semibold text-gray-600">Привет!</h1>
    <p class="text-xl text-gray-600">
        Это простой менеджер задач на Laravel + Inertia
    </p>
</template>
