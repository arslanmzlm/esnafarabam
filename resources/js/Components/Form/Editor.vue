<script lang="ts" setup>
import '@vueup/vue-quill/dist/vue-quill.snow.css';
import {QuillEditor} from '@vueup/vue-quill';
import InvalidFeedback from '@/Components/Form/InvalidFeedback.vue';

withDefaults(
    defineProps<{
        label?: string;
        required?: boolean;
        error?: string | null;
    }>(),
    {
        required: false,
    },
);

const toolbar = [
    [{header: [2, 3, 4, 5, 6, false]}],
    [{size: ['small', false, 'large', 'huge']}],
    ['bold', 'italic', 'underline', 'strike'],
    [{align: []}],
    [{color: []}, {background: []}],
    ['link', 'video'],
    [{list: 'ordered'}, {list: 'bullet'}],
    ['clean'],
];

const model = defineModel<string | null>({required: true});
</script>

<template>
    <div>
        <label v-if="label" class="mb-3 block text-sm font-medium text-black dark:text-white"
            >{{ label }} <span v-if="required" class="text-danger">*</span></label
        >

        <QuillEditor v-model:content="model" :toolbar content-type="html" theme="snow" />

        <div><small>Görsel eklemek için görselin URL'ini yapıştırın.</small></div>

        <InvalidFeedback v-if="error" :message="error" />
    </div>
</template>
