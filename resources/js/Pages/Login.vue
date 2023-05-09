<script>
import AuthLayout from "@/Layouts/AuthLayout.vue";

export default {
    layout: AuthLayout,
};
</script>

<script setup>
import { useForm } from "@inertiajs/vue3";
import Button from "primevue/button";
import Checkbox from "primevue/checkbox";
import InputWithLabel from "@/Components/InputWithLabel.vue";

const form = useForm({
    email: null,
    password: null,
    remember_me: false,
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

        <div class="flex justify-center gap-2">
            <span class="text-gray-600">Войдите</span>
            <Link href="/register" class="text-main underline">
                или зарегистрируйтесь
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
            type="password"
            inputId="password"
            :error="form.errors.password"
        >
            Пароль
        </InputWithLabel>

        <div class="flex items-center justify-center gap-2">
            <label for="remember_me" class="text-gray-600"
                >Запомнить меня</label
            >
            <Checkbox
                v-model="form.remember_me"
                inputId="remember_me"
                :binary="true"
            />
        </div>

        <div class="flex justify-center">
            <Button type="submit" :disabled="form.processing" class="mb-3">
                Войти
            </Button>
        </div>
    </form>
</template>
