<script lang="ts" setup>
import InvalidFeedback from '@/Components/Form/InvalidFeedback.vue';

const model = defineModel<string | null>({required: true});

withDefaults(
    defineProps<{
        rows?: string | number;
        label?: string;
        required?: boolean;
        placeholder?: string;
        error?: string | null;
        disabled?: boolean;
    }>(),
    {
        rows: 4,
        required: false,
        disabled: false,
    },
);
</script>

<template>
    <div>
        <label v-if="label" class="mb-3 block text-sm font-medium text-black dark:text-white"
            >{{ label }} <span v-if="required" class="text-danger">*</span></label
        >

        <textarea
            v-model="model"
            :disabled
            :placeholder
            :rows
            class="w-full rounded-lg border-[1.5px] border-stroke bg-transparent px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary"
        ></textarea>

        <InvalidFeedback v-if="error" :message="error" />
    </div>
</template>
