<script lang="ts" setup>
import {reactive} from 'vue';

const props = defineProps<{
    value: string | number | null;
    label?: string;
    prefix?: string;
    suffix?: string;
}>();

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
        <div v-if="label" class="mb-3 text-sm font-medium text-black dark:text-white">
            {{ label }}
        </div>

        <div class="flex items-stretch">
            <div
                v-if="prefix"
                class="flex items-center justify-center rounded-l bg-slate-200 px-3 dark:bg-form-strokedark dark:text-white"
            >
                {{ prefix }}
            </div>

            <div
                :class="inputClasses"
                class="relative z-1 w-full rounded border-[1.5px] border-stroke bg-transparent bg-whiter px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-strokedark dark:text-white dark:focus:border-primary"
            >
                {{ value }}
            </div>

            <div
                v-if="suffix"
                class="flex items-center justify-center rounded-r bg-slate-200 px-3 dark:bg-form-strokedark dark:text-white"
            >
                {{ suffix }}
            </div>
        </div>
    </div>
</template>
