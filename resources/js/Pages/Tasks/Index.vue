<script setup>
import Button from "primevue/button";
import Dropdown from "primevue/dropdown";
import { usePage } from "@inertiajs/vue3";
import { useToast } from "primevue/usetoast";
import { ref, computed, watch } from "vue";
import dayjs from "dayjs";
import Title from "@/Components/Title.vue";
import Dialog from "primevue/dialog";

defineProps({ tasks: Array, statuses: Array, users: Array });

const toast = useToast();
const message = computed(() => usePage().props.flash.message);
const authUser = usePage().props.authUser;

const dialogVisible = ref(false);
const taskToDelete = ref(null);

const getQueryParam = (param) => {
    return new URLSearchParams(window.location.search).get(param);
};

const selectedStatus = ref(getQueryParam("status"));
const selectedAuthor = ref(+getQueryParam("author_id") || null);
const selectedDoer = ref(+getQueryParam("doer_id") || null);

const queryParams = computed(() => {
    const result = {};
    if (selectedStatus.value) {
        result.status = selectedStatus.value;
    }
    if (selectedAuthor.value) {
        result.author_id = selectedAuthor.value;
    }
    if (selectedDoer.value) {
        result.doer_id = selectedDoer.value;
    }
    return result;
});

const onDeleteClick = (task) => {
    if (task.author_id !== authUser.id) {
        toast.add({
            severity: "error",
            detail: "У вас нет прав на это действие",
            life: 3000,
        });
    } else {
        dialogVisible.value = true;
        taskToDelete.value = task.id;
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
    <Title>Задачи</Title>

    <Link v-if="authUser" href="/tasks/create" class="mb-6 block w-fit">
        <Button>Создать задачу</Button>
    </Link>

    <div class="mb-6 flex gap-5">
        <Dropdown
            v-model="selectedStatus"
            :options="statuses"
            optionLabel="name"
            optionValue="name"
            :showClear="true"
            placeholder="Статус"
            class="min-w-[250px]"
        />
        <Dropdown
            v-model="selectedAuthor"
            :options="users"
            optionLabel="name"
            optionValue="id"
            :showClear="true"
            placeholder="Автор"
            class="min-w-[250px]"
        />
        <Dropdown
            v-model="selectedDoer"
            :options="users"
            optionLabel="name"
            optionValue="id"
            :showClear="true"
            placeholder="Исполнитель"
            class="min-w-[250px]"
        />

        <Link href="/tasks" :data="queryParams">
            <Button label="Применить" />
        </Link>
    </div>

    <div v-if="tasks.length">
        <div
            class="mb-2 grid grid-cols-[40px_minmax(0,_1fr)_minmax(0,_1fr)_minmax(0,_1fr)_minmax(0,_1fr)_minmax(0,_1fr)] border-b-2 border-gray-400 font-semibold text-gray-600"
        >
            <div>ID</div>
            <div>Статус</div>
            <div>Имя</div>
            <div>Автор</div>
            <div>Исполнитель</div>
            <div>Дата создания</div>
        </div>
        <div
            v-for="(task, i) in tasks"
            :key="i"
            class="mb-4 grid grid-cols-[40px_minmax(0,_1fr)_minmax(0,_1fr)_minmax(0,_1fr)_minmax(0,_1fr)_minmax(0,_1fr)] border-b border-dashed border-gray-300 text-gray-600"
        >
            <div>{{ task.id }}</div>
            <div>{{ task.status }}</div>
            <Link :href="`/tasks/${task.id}`" class="text-main hover:underline">{{
                task.name
            }}</Link>
            <div>
                {{ users.find((user) => user.id === task.author_id).name }}
            </div>
            <div>
                {{
                    users.find((user) => user.id === task.doer_id)?.name ||
                    "Не назначено"
                }}
            </div>
            <div class="flex gap-24">
                <span>
                    {{ dayjs(task.created_at).format("DD.MM.YYYY") }}
                </span>
                <div v-if="authUser">
                    <Link :href="`/tasks/${task.id}/edit`">
                        <span
                            class="pi pi-file-edit mr-3 hover:text-main"
                        ></span>
                    </Link>
                    <button type="button" @click="onDeleteClick(task)">
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
        <p>Удалить задачу?</p>
        <template #footer>
            <Link :href="`/tasks/${taskToDelete}`" method="delete">
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
