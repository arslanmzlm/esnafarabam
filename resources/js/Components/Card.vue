<script lang="ts" setup>
import {reactive} from 'vue';

const props = withDefaults(
    defineProps<{
        title?: string;
        fluid?: boolean;
    }>(),
    {
        fluid: false,
    },
);

const classes = reactive<string[]>([]);

if (!props.fluid) {
    classes.push('p-6');
}
</script>

<template>
    <div
        class="rounded-sm border border-stroke bg-white shadow-sm dark:border-strokedark dark:bg-boxdark"
    >
        <div v-if="title" class="border-b border-stroke px-6 py-4 dark:border-strokedark">
            <div class="text-title-md font-bold text-black dark:text-white">
                {{ title }}
            </div>
        </div>

        <div :class="classes" class="space-y-5">
            <slot></slot>
        </div>
    </div>
</template>
