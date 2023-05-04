<script>
import AuthLayout from "@/Layouts/AuthLayout.vue";

export default {
    layout: AuthLayout,
};
</script>

<script setup>
import { useForm } from "@inertiajs/vue3";
import InputText from "primevue/inputtext";
import Password from "primevue/password";
import Button from "primevue/button";

const form = useForm({
    name: null,
    email: null,
    password: null,
    password_confirmation: null,
});
</script>

<template>
    <form
        class="max-w-md flex-grow space-y-5 rounded-md bg-white p-6 shadow-md"
        @submit.prevent="form.post('/users')"
    >
        <div class="flex justify-center">
            <Link href="/">
                <span class="text-4xl font-semibold text-gray-600"
                    >Менеджер задач</span
                >
            </Link>
        </div>

        <div class="flex flex-col gap-1">
            <label for="name" class="text-gray-600">Имя</label>
            <InputText id="name" type="text" v-model="form.name" />
            <span v-if="form.errors.name" class="text-xs text-red-500">{{
                form.errors.name
            }}</span>
        </div>

        <div class="flex flex-col gap-1">
            <label for="email" class="text-gray-600">E-mail</label>
            <InputText id="email" type="text" v-model="form.email" />
            <span v-if="form.errors.email" class="text-xs text-red-500">{{
                form.errors.email
            }}</span>
        </div>

        <div class="flex flex-col gap-1">
            <label for="password" class="text-gray-600">Пароль</label>
            <Password
                id="password"
                v-model="form.password"
                :inputProps="{ name: 'password' }"
                :feedback="false"
                toggleMask
                :input-style="{ width: '100%' }"
            />
            <span v-if="form.errors.password" class="text-xs text-red-500">{{
                form.errors.password
            }}</span>
        </div>

        <div class="flex flex-col gap-1">
            <label for="password_confirmation" class="text-gray-600"
                >Подтвердите пароль</label
            >
            <Password
                id="password_confirmation"
                v-model="form.password_confirmation"
                :inputProps="{ name: 'password_confirmation' }"
                :feedback="false"
                toggleMask
                :input-style="{ width: '100%' }"
            />
        </div>

        <div class="flex justify-center">
            <Button type="submit" :disabled="form.processing"
                >Зарегистрироваться</Button
            >
        </div>

        <div class="flex justify-center">
            <Link href="/login">
                <Button label="Уже зарегистрированы?" link />
            </Link>
        </div>
    </form>
</template>
