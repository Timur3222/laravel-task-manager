<script setup>
import Title from "@/Components/Title.vue";

defineProps({ task: Object });
</script>

<template>
    <Title class="mr-3 inline-block">{{ task.name }}</Title>
    <Link :href="`/tasks/${task.id}/edit`">
        <span
            class="pi pi-file-edit !text-xl text-gray-600 hover:text-main"
        ></span>
    </Link>

    <div class="space-y-2 text-gray-600">
        <p><b class="font-semibold">Статус</b>: {{ task.status }}</p>
        <p><b class="font-semibold">Описание</b>: {{ task.description }}</p>
        <p class="font-semibold">Метки:</p>
        <div class="flex gap-1">
            <div
                v-for="(mark, i) in JSON.parse(task.marks)"
                :key="i"
                class="flex items-center gap-1 rounded-full bg-[#dbffdb] px-3 py-1 font-semibold text-main"
            >
                <span class="pi pi-tag"></span>
                {{ mark }}
            </div>
        </div>
    </div>
</template>
