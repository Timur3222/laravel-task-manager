<script setup>
import InputText from "primevue/inputtext";
import Password from "primevue/password";

defineProps({
    modelValue: String,
    inputId: String,
    error: String,
    password: {
        type: Boolean,
        default: false,
    },
});

const emit = defineEmits(["update:modelValue"]);
</script>

<template>
    <div class="relative flex flex-col gap-1">
        <label :for="inputId" class="text-gray-600">
            <slot />
        </label>
        <Password
            v-if="password"
            :id="inputId"
            v-model="modelValue"
            :inputProps="{ name: inputId }"
            :feedback="false"
            toggleMask
            :input-style="{ width: '100%' }"
            @update:modelValue="emit('update:modelValue', $event)"
        />
        <InputText
            v-else
            :id="inputId"
            type="text"
            v-model="modelValue"
            @update:modelValue="emit('update:modelValue', $event)"
        />
        <span v-if="error" class="absolute bottom-[-20px] text-xs text-red-500">
            {{ error }}
        </span>
    </div>
</template>
