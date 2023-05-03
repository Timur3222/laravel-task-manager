<script setup>
import Button from "primevue/button";
</script>

<template>
    <main>
        <header class="py-3 shadow-md">
            <div
                class="mx-auto flex max-w-screen-xl items-center justify-between"
            >
                <Link href="/" class="text-xl font-semibold"
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
                <div class="flex gap-3">
                    <Link href="/login">
                        <Button>Вход</Button>
                    </Link>
                    <Link href="/register">
                        <Button>Регистрация</Button>
                    </Link>
                </div>
            </div>
        </header>
        <div class="mx-auto max-w-screen-xl py-10">
            <slot />
        </div>
    </main>
</template>
