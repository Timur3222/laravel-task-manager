<script setup>
import Button from "primevue/button";
import Title from "@/Components/Title.vue";
import { useForm } from "@inertiajs/vue3";
import InputWithLabel from "@/Components/InputWithLabel.vue";

const props = defineProps({ mark: Object });

const form = useForm({
    name: props.mark?.name || null,
    description: props.mark?.description || null,
});
</script>

<template>
    <Title>{{ mark ? "Редактировать метку" : "Создать метку" }}</Title>

    <form
        @submit.prevent="
            mark
                ? form.patch(`/marks/${mark.id}/update`)
                : form.post('/marks/store')
        "
    >
        <InputWithLabel
            v-model="form.name"
            inputId="name"
            :error="form.errors.name"
            class="mb-8 max-w-[400px]"
        >
            Имя
        </InputWithLabel>

        <InputWithLabel
            v-model="form.description"
            type="textarea"
            inputId="description"
            :error="form.errors.description"
            class="mb-8 max-w-[400px]"
        >
            Описание
        </InputWithLabel>

        <Button type="submit">{{ mark ? "Обновить" : "Создать" }}</Button>
    </form>
</template>
