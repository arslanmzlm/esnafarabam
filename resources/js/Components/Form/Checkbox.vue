<script lang="ts" setup>
import {computed} from 'vue';

const model = defineModel();

const props = withDefaults(
    defineProps<{
        name: string;
        label?: string;
        required?: boolean;
        value?: string | number | boolean;
        size?: 'sm' | 'md' | 'lg';
        weight?: 'light' | 'normal' | 'medium' | 'bold';
        disabled?: boolean;
    }>(),
    {
        required: false,
        value: true,
        size: 'md',
        weight: 'normal',
        disabled: false,
    },
);

const id = computed(() => {
    return `checkbox-${props.name}`;
});

const active = computed(() => {
    if (Array.isArray(model.value)) {
        return model.value.includes(props.value);
    } else {
        return model.value;
    }
});

const iconClasses = computed(() => {
    const classes = [];

    if (active.value) {
        classes.push('border-primary', 'bg-gray', 'text-primary', 'dark:bg-transparent');
    }

    if (!props.disabled) {
        classes.push('cursor-pointer');
    }

    switch (props.size) {
        case 'sm':
            classes.push('size-4');
            break;
        case 'lg':
            classes.push('size-6');
            break;
        default:
            classes.push('size-5');
            break;
    }

    return classes;
});

const labelClasses = computed(() => {
    const classes = [];

    if (active.value) {
        classes.push('text-primary', 'dark:text-white');
    }

    if (!props.disabled) {
        classes.push('cursor-pointer');
    }

    switch (props.size) {
        case 'sm':
            classes.push('text-sm');
            break;
        case 'lg':
            classes.push('text-lg');
            break;
        default:
            classes.push('text-base');
            break;
    }

    classes.push(`font-${props.weight}`);

    return classes;
});
</script>

<template>
    <div class="flex flex-wrap items-center">
        <div class="relative">
            <input :id v-model="model" :disabled :name :value class="sr-only" type="checkbox" />
            <label
                :class="iconClasses"
                :for="id"
                class="checkbox-icon mr-2 flex items-center justify-center rounded border"
            >
                <span :class="active && '!opacity-100'" class="opacity-0">
                    <svg
                        fill="none"
                        height="8"
                        viewBox="0 0 11 8"
                        width="11"
                        xmlns="http://www.w3.org/2000/svg"
                    >
                        <path
                            class="fill-current stroke-current"
                            d="M10.0915 0.951972L10.0867 0.946075L10.0813 0.940568C9.90076 0.753564 9.61034 0.753146 9.42927 0.939309L4.16201 6.22962L1.58507 3.63469C1.40401 3.44841 1.11351 3.44879 0.932892 3.63584C0.755703 3.81933 0.755703 4.10875 0.932892 4.29224L0.932878 4.29225L0.934851 4.29424L3.58046 6.95832C3.73676 7.11955 3.94983 7.2 4.1473 7.2C4.36196 7.2 4.55963 7.11773 4.71406 6.9584L10.0468 1.60234C10.2436 1.4199 10.2421 1.1339 10.0915 0.951972ZM4.2327 6.30081L4.2317 6.2998C4.23206 6.30015 4.23237 6.30049 4.23269 6.30082L4.2327 6.30081Z"
                            stroke-width="0.4"
                        ></path>
                    </svg>
                </span>
            </label>
        </div>

        <label :class="labelClasses" :for="id" class="flex select-none items-center">{{
            label
        }}</label>
    </div>
</template>
