<script lang="ts" setup>
import {ref} from 'vue';
import ChevronDownIcon from '@/Icons/ChevronDownIcon.vue';

const props = withDefaults(
    defineProps<{
        title: string;
        active?: boolean;
    }>(),
    {
        active: false,
    },
);

const show = ref<boolean>(props.active);
</script>

<template>
    <div class="rounded border border-slate-200 dark:border-strokedark">
        <button
            :class="{'rounded-b-none border-b': show}"
            class="flex w-full items-center justify-between rounded border-slate-200 p-5 text-start font-medium text-black transition-colors hover:bg-primary hover:bg-opacity-25 dark:border-strokedark dark:text-white"
            type="button"
            @click="show = !show"
        >
            <span>{{ title }}</span>

            <span :class="show && 'rotate-180'" class="transition-transform duration-300"
                ><ChevronDownIcon class="size-5"
            /></span>
        </button>

        <slot v-if="show" />
    </div>
</template>
