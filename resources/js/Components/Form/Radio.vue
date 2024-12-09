<script lang="ts" setup>
import {computed} from 'vue';

const model = defineModel<any>({default: false});

const props = withDefaults(
    defineProps<{
        name: string;
        label?: string;
        required?: boolean;
        value: any;
        disabled?: boolean;
    }>(),
    {
        required: false,
        disabled: false,
    },
);

const id = computed(() => {
    return `radio-${props.name}`;
});

const active = computed(() => {
    return model.value == props.value;
});
</script>

<template>
    <div class="flex flex-wrap items-center">
        <div class="relative">
            <input :id v-model="model" :disabled :name :value class="sr-only" type="radio" />
            <label
                :class="{'border-primary': active, 'mr-2': label}"
                :for="id"
                class="flex h-5 w-5 cursor-pointer items-center justify-center rounded-full border"
            >
                <span
                    :class="active && '!bg-primary'"
                    class="h-2.5 w-2.5 rounded-full bg-transparent"
                >
                </span>
            </label>
        </div>

        <label :for="id" class="flex cursor-pointer select-none items-center">{{ label }}</label>
    </div>
</template>
