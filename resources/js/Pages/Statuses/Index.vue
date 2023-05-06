<script setup>
import Button from "primevue/button";
import { usePage } from "@inertiajs/vue3";
import { useToast } from "primevue/usetoast";
import { ref } from "vue";
import dayjs from "dayjs";
import Title from "@/Components/Title.vue";
import Dialog from "primevue/dialog";

defineProps({ statuses: Array });

const toast = useToast();
const message = usePage().props.flash.message;

const dialogVisible = ref(false);

const onDeleteClick = (status) => {
    if (status.author_id !== usePage().props.authUser.id) {
        toast.add({
            severity: "error",
            detail: "Нет прав на это действие",
            life: 3000,
        });
    } else {
        dialogVisible.value = true;
    }
};

if (message) {
    toast.add({
        severity: "success",
        detail: message,
        life: 3000,
    });
}
</script>

<template>
    <Title>Статусы</Title>

    <Link href="/statuses/create" class="mb-6 block">
        <Button>Создать статус</Button>
    </Link>

    <div v-if="statuses.length">
        <div
            class="mb-2 grid grid-cols-[100px_minmax(0,_1fr)_minmax(0,_1fr)] border-b-2 border-gray-400 font-semibold text-gray-600"
        >
            <div>ID</div>
            <div>Имя</div>
            <div>Дата создания</div>
        </div>
        <div
            v-for="(status, i) in statuses"
            :key="i"
            class="mb-1 grid grid-cols-[100px_minmax(0,_1fr)_minmax(0,_1fr)] border-b border-dashed border-gray-300 text-gray-600"
        >
            <div>{{ status.id }}</div>
            <div>{{ status.name }}</div>
            <div class="flex gap-16">
                <span>
                    {{ dayjs(status.created_at).format("DD.MM.YYYY") }}
                </span>
                <div>
                    <Link :href="`/statuses/${status.id}/edit`">
                        <span
                            class="pi pi-file-edit mr-3 hover:text-main"
                        ></span>
                    </Link>
                    <button type="button" @click="onDeleteClick(status)">
                        <span class="pi pi-trash hover:text-red-500"></span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <Dialog
        v-model:visible="dialogVisible"
        modal
        :draggable="false"
        header="Подтвердите действие"
        :style="{ width: '20vw' }"
    >
        <p>Удалить статус?</p>
        <template #footer>
            <Button
                label="Удалить"
                icon="pi pi-check"
                @click="visible = false"
                autofocus
            />
            <Button
                label="Отмена"
                icon="pi pi-times"
                @click="visible = false"
                text
            />
        </template>
    </Dialog>
</template>
