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

<style>
.ql-editor {
    @apply space-y-5;

    h1,
    h2,
    h3,
    h4,
    h5,
    h6 {
        @apply font-bold text-black;
        line-height: 1.25;
    }

    h1 {
        font-size: 2rem;
    }

    h2 {
        font-size: 1.8rem;
    }

    h3 {
        font-size: 1.6rem;
    }

    h4 {
        font-size: 1.4rem;
    }

    h5 {
        font-size: 1.2rem;
    }

    h6 {
        font-size: 1rem;
    }
}
</style>
