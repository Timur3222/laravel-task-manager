<script>
import AuthLayout from "@/Layouts/AuthLayout.vue";

export default {
    layout: AuthLayout,
};
</script>

<script setup>
import { useForm } from "@inertiajs/vue3";
import Button from "primevue/button";
import InputWithLabel from "@/Components/InputWithLabel.vue";

const form = useForm({
    email: null,
    password: null,
});
</script>

<template>
    <form
        class="max-w-md flex-grow space-y-8 rounded-md bg-white p-6 shadow-md"
        @submit.prevent="form.post('/users/authenticate')"
    >
        <div class="flex justify-center">
            <Link href="/">
                <span class="text-4xl font-semibold text-gray-600"
                    >Менеджер задач</span
                >
            </Link>
        </div>

        <InputWithLabel
            v-model="form.email"
            inputId="email"
            :error="form.errors.email"
        >
            E-mail
        </InputWithLabel>

        <InputWithLabel
            v-model="form.password"
            inputId="password"
            :error="form.errors.password"
            :password="true"
        >
            Пароль
        </InputWithLabel>

        <div class="flex justify-center">
            <Button type="submit" :disabled="form.processing"> Войти </Button>
        </div>
    </form>
</template>
