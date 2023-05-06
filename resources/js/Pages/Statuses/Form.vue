<script setup>
import Button from "primevue/button";
import Title from "@/Components/Title.vue";
import { useForm } from "@inertiajs/vue3";
import InputWithLabel from "@/Components/InputWithLabel.vue";

const props = defineProps({ status: Object });

const form = useForm({
    name: props.status.name || null,
});
</script>

<template>
    <Title>{{ status ? "Редактировать статус" : "Создать статус" }}</Title>

    <form
        @submit.prevent="
            status
                ? form.patch(`/statuses/${status.id}/update`)
                : form.post('/statuses/store')
        "
    >
        <InputWithLabel
            v-model="form.name"
            inputId="name"
            :error="form.errors.name"
            class="mb-8 max-w-[300px]"
        >
            Имя
        </InputWithLabel>
        <Button type="submit">{{ status ? "Обновить" : "Создать" }}</Button>
    </form>
</template>
