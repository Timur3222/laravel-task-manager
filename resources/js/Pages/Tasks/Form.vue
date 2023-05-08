<script setup>
import Button from "primevue/button";
import Dropdown from "primevue/dropdown";
import MultiSelect from "primevue/multiselect";
import Title from "@/Components/Title.vue";
import { useForm } from "@inertiajs/vue3";
import InputWithLabel from "@/Components/InputWithLabel.vue";

const props = defineProps({
    task: Object,
    statuses: Array,
    users: Array,
    marks: Array,
});

const form = useForm({
    name: props.task?.name || null,
    description: props.task?.description || null,
    status: props.task?.status || null,
    doer_id: props.task?.doer_id || null,
    marks: (props.task?.marks && JSON.parse(props.task?.marks)) || null,
});
</script>

<template>
    <Title>{{ task ? "Редактировать задачу" : "Создать задачу" }}</Title>

    <form
        class="space-y-6"
        @submit.prevent="
            task
                ? form.patch(`/tasks/${task.id}/update`)
                : form.post('/tasks/store')
        "
    >
        <InputWithLabel
            v-model="form.name"
            inputId="name"
            :error="form.errors.name"
            class="max-w-[400px]"
        >
            Имя
        </InputWithLabel>

        <InputWithLabel
            v-model="form.description"
            type="textarea"
            inputId="description"
            :error="form.errors.description"
            class="max-w-[400px]"
        >
            Описание
        </InputWithLabel>

        <div class="relative flex flex-col gap-1">
            <label for="status" class="text-gray-600"> Статус </label>
            <Dropdown
                v-model="form.status"
                :options="props.statuses"
                inputId="status"
                optionLabel="name"
                optionValue="name"
                placeholder="Выберите статус"
                class="max-w-[400px]"
                :class="{ 'p-invalid': form.errors.status }"
            />

            <span
                v-if="form.errors.status"
                class="absolute bottom-[-20px] text-xs text-red-500"
            >
                {{ form.errors.status }}
            </span>
        </div>

        <div class="relative flex flex-col gap-1">
            <label for="doer" class="text-gray-600"> Исполнитель </label>
            <Dropdown
                v-model="form.doer_id"
                :options="props.users"
                inputId="doer"
                optionLabel="name"
                optionValue="id"
                :showClear="true"
                placeholder="Выберите исполнителя"
                class="max-w-[400px]"
            />
        </div>

        <div class="relative flex flex-col gap-1">
            <label for="marks" class="text-gray-600"> Метки </label>
            <MultiSelect
                v-model="form.marks"
                :options="props.marks"
                inputId="marks"
                optionLabel="name"
                optionValue="name"
                placeholder="Выберите метки"
                class="max-w-[400px]"
            />
        </div>

        <Button type="submit">{{ task ? "Обновить" : "Создать" }}</Button>
    </form>
</template>
