<script setup>
import InputText from "primevue/inputtext";
import Password from "primevue/password";
import Textarea from "primevue/textarea";

defineProps({
    modelValue: String,
    type: {
        type: String,
        default: "text",
    },
    inputId: String,
    error: String,
});

const emit = defineEmits(["update:modelValue"]);
</script>

<template>
    <div class="relative flex flex-col gap-1">
        <label :for="inputId" class="text-gray-600">
            <slot />
        </label>
        <InputText
            v-if="type === 'text'"
            :id="inputId"
            type="text"
            v-model="modelValue"
            :class="{ 'p-invalid': error }"
            @update:modelValue="emit('update:modelValue', $event)"
        />
        <Password
            v-if="type === 'password'"
            :id="inputId"
            v-model="modelValue"
            :inputProps="{ name: inputId }"
            :feedback="false"
            toggleMask
            :input-style="{ width: '100%' }"
            :class="{ 'p-invalid': error }"
            @update:modelValue="emit('update:modelValue', $event)"
        />
        <Textarea
            v-if="type === 'textarea'"
            :id="inputId"
            v-model="modelValue"
            autoResize
            rows="5"
            cols="30"
            :class="{ 'p-invalid': error }"
            @update:modelValue="emit('update:modelValue', $event)"
        />
        <span v-if="error" class="absolute bottom-[-20px] text-xs text-red-500">
            {{ error }}
        </span>
    </div>
</template>
