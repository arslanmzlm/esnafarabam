<script lang="ts" setup>
import {kebabCase} from 'lodash';
import {watch} from 'vue';
import InputBox from '@/Components/Form/InputBox.vue';

const model = defineModel<string | null>({required: true});

withDefaults(
    defineProps<{
        label?: string;
        required?: boolean;
        placeholder?: string;
        error?: string | null;
    }>(),
    {
        required: false,
    },
);

watch(
    () => model.value,
    (value) => {
        if (value) {
            model.value = kebabCase(value);
        }
    },
);
</script>

<template>
    <InputBox v-model.trim="model" :error :label :placeholder :required />
</template>
