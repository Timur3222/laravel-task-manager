<script setup>
import Button from "primevue/button";
import { usePage } from "@inertiajs/vue3";
import { computed } from "vue";

const authUser = computed(() => usePage().props.authUser);
</script>

<template>
    <main>
        <header class="py-3 shadow-md">
            <div
                class="mx-auto flex max-w-screen-xl items-center justify-between"
            >
                <Link href="/" class="text-xl font-semibold text-gray-600"
                    >Менеджер задач</Link
                >
                <div class="flex gap-3">
                    <Link href="/tasks">
                        <Button label="Задачи" link />
                    </Link>
                    <Link href="/statuses">
                        <Button label="Статусы" link />
                    </Link>
                    <Link href="/marks">
                        <Button label="Метки" link />
                    </Link>
                </div>
                <div v-if="!authUser" class="flex gap-3">
                    <Link href="/login">
                        <Button>Вход</Button>
                    </Link>
                    <Link href="/register">
                        <Button>Регистрация</Button>
                    </Link>
                </div>
                <div v-else class="flex items-center gap-5">
                    <div class="space-x-2 text-gray-600">
                        <span class="pi pi-user"></span>
                        <span>{{ authUser.name }}</span>
                    </div>
                    <Link href="/logout" method="post">
                        <Button>Выйти</Button>
                    </Link>
                </div>
            </div>
        </header>
        <div class="mx-auto max-w-screen-xl py-10">
            <slot />
        </div>
    </main>
</template>
