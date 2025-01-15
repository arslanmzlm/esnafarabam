<script lang="ts" setup>
import {computed} from 'vue';
import InvalidFeedback from '@/Components/Form/InvalidFeedback.vue';

defineEmits(['input']);

const props = withDefaults(
    defineProps<{
        label?: string;
        required?: boolean;
        accept?: string;
        error?: string | null;
    }>(),
    {
        required: false,
    },
);

const mimes = computed(() => {
    if (props.accept === 'image') {
        return 'image/jpeg,image/png,image/webp,image/svg+xml,image/x-icon';
    }

    return props.accept;
});
</script>

<template>
    <div>
        <label v-if="label" class="mb-3 block text-sm font-medium text-black dark:text-white"
            >{{ label }} <span v-if="required" class="text-danger">*</span></label
        >

        <input
            :accept="mimes"
            class="w-full cursor-pointer rounded-lg border-[1.5px] border-stroke bg-transparent font-normal outline-none transition file:mr-5 file:border-collapse file:cursor-pointer file:border-0 file:border-r file:border-solid file:border-stroke file:bg-whiter file:px-5 file:py-3 file:hover:bg-primary file:hover:bg-opacity-10 focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:file:border-form-strokedark dark:file:bg-white/30 dark:file:text-white dark:focus:border-primary"
            type="file"
            @input="$emit('input', $event)"
        />

        <InvalidFeedback v-if="error" :message="error" />
    </div>
</template>
