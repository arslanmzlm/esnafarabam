<script lang="ts" setup>
import {usePage} from '@inertiajs/vue3';
import {computed} from 'vue';
import ToastItem from '@/Components/Toast/ToastItem.vue';

const page = usePage();

const toasts = computed(() => page.props.toasts);

function toastLeaved(index: number) {
    delete toasts.value[index];
}
</script>

<template>
    <div
        v-if="toasts.length"
        class="fixed bottom-0 left-0 right-0 z-999999 mb-10 flex flex-col items-center justify-center gap-4"
    >
        <template v-for="(toast, index) in toasts" :key="index">
            <ToastItem
                v-if="toast"
                :message="toast.message"
                :type="toast.type"
                @leaved="toastLeaved(index)"
            />
        </template>
    </div>
</template>
