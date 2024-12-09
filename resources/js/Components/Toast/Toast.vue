<script lang="ts" setup>
import {usePage} from '@inertiajs/vue3';
import ToastItem from '@/Components/Toast/ToastItem.vue';

const page = usePage();
const toasts = page.props.toasts;

function toastLeaved(index: number) {
    delete toasts[index];
}
</script>

<template>
    <div
        class="fixed bottom-0 left-0 right-0 z-999999 mb-10 flex flex-col items-center justify-center gap-4"
    >
        <ToastItem
            v-for="(toast, index) in toasts"
            :key="index"
            :message="toast.message"
            :type="toast.type"
            @leaved="toastLeaved(index)"
        />
    </div>
</template>
