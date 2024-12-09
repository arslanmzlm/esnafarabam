<script lang="ts" setup>
defineProps<{
    title?: string;
}>();
</script>

<template>
    <div
        class="rounded-sm border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark"
    >
        <div v-if="title" class="border-b border-stroke px-6 py-4 dark:border-strokedark">
            <div class="font-medium text-black dark:text-white">
                {{ title }}
            </div>
        </div>

        <div class="overflow-x-auto overflow-y-visible">
            <table class="basic-table">
                <thead>
                    <slot name="head"></slot>
                </thead>
                <tbody>
                    <slot></slot>
                </tbody>
            </table>
        </div>
    </div>
</template>
