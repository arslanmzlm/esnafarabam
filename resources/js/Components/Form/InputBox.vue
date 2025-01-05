<script lang="ts" setup>
import {reactive} from 'vue';
import InvalidFeedback from '@/Components/Form/InvalidFeedback.vue';

const model = defineModel<string | number | null>({required: true});

const props = withDefaults(
    defineProps<{
        type?: 'text' | 'number' | 'email' | 'password' | 'date';
        label?: string;
        required?: boolean;
        placeholder?: string;
        error?: string | null;
        prefix?: string;
        suffix?: string;
        disabled?: boolean;
    }>(),
    {
        type: 'text',
        required: false,
        disabled: false,
    },
);

const inputClasses = reactive<string[]>([]);

if (props.prefix) {
    inputClasses.push('rounded-l-none');
}

if (props.suffix) {
    inputClasses.push('rounded-r-none');
}
</script>

<template>
    <div>
        <label v-if="label" class="mb-3 block text-sm font-medium text-black dark:text-white"
            >{{ label }} <span v-if="required" class="text-danger">*</span></label
        >

        <div class="flex items-stretch">
            <div
                v-if="prefix"
                class="flex items-center justify-center rounded-l bg-slate-200 px-3 dark:bg-form-strokedark dark:text-white"
            >
                {{ prefix }}
            </div>

            <input
                v-model="model"
                :class="inputClasses"
                :placeholder
                :readonly="disabled"
                :type
                class="relative z-1 w-full rounded border-[1.5px] border-stroke bg-transparent px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary"
            />

            <div
                v-if="suffix"
                class="flex items-center justify-center rounded-r bg-slate-200 px-3 dark:bg-form-strokedark dark:text-white"
            >
                {{ suffix }}
            </div>
        </div>

        <InvalidFeedback v-if="error" :message="error" />
    </div>
</template>
