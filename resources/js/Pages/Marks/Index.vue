<script setup>
import Button from "primevue/button";
import { usePage } from "@inertiajs/vue3";
import { useToast } from "primevue/usetoast";
import { ref, computed, watch } from "vue";
import dayjs from "dayjs";
import Title from "@/Components/Title.vue";
import Dialog from "primevue/dialog";

defineProps({ marks: Array });

const toast = useToast();
const message = computed(() => usePage().props.flash.message);
const authUser = usePage().props.authUser;

const dialogVisible = ref(false);
const markToDelete = ref(null);

const onDeleteClick = (mark) => {
    if (mark.author_id !== authUser.id) {
        toast.add({
            severity: "error",
            detail: "У вас нет прав на это действие",
            life: 3000,
        });
    } else {
        dialogVisible.value = true;
        markToDelete.value = mark.id;
    }
};

watch(message, (value) => {
    if (value) {
        toast.add({
            severity: "success",
            detail: value,
            life: 3000,
        });
    }
});

if (message.value) {
    toast.add({
        severity: "success",
        detail: message.value,
        life: 3000,
    });
}
</script>

<template>
    <Title>Метки</Title>

    <Link v-if="authUser" href="/marks/create" class="mb-6 block w-fit">
        <Button>Создать метку</Button>
    </Link>

    <div v-if="marks.length">
        <div
            class="mb-2 grid grid-cols-[40px_minmax(0,_200px)_minmax(0,_1fr)_minmax(0,_280px)] border-b-2 border-gray-400 font-semibold text-gray-600"
        >
            <div>ID</div>
            <div>Имя</div>
            <div>Описание</div>
            <div>Дата создания</div>
        </div>
        <div
            v-for="(mark, i) in marks"
            :key="i"
            class="mb-4 grid grid-cols-[40px_minmax(0,_200px)_minmax(0,_1fr)_minmax(0,_280px)] border-b border-dashed border-gray-300 text-gray-600"
        >
            <div>{{ mark.id }}</div>
            <div>{{ mark.name }}</div>
            <div class="pr-3">{{ mark.description }}</div>
            <div class="flex gap-24">
                <span>
                    {{ dayjs(mark.created_at).format("DD.MM.YYYY") }}
                </span>
                <div v-if="authUser">
                    <Link :href="`/marks/${mark.id}/edit`">
                        <span
                            class="pi pi-file-edit mr-3 hover:text-main"
                        ></span>
                    </Link>
                    <button type="button" @click="onDeleteClick(mark)">
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
        <p>Удалить метку?</p>
        <template #footer>
            <Link :href="`/marks/${markToDelete}`" method="delete">
                <Button
                    label="Удалить"
                    icon="pi pi-check"
                    @click="dialogVisible = false"
                    autofocus
                />
            </Link>
            <Button
                label="Отмена"
                icon="pi pi-times"
                @click="dialogVisible = false"
                text
            />
        </template>
    </Dialog>
</template>
