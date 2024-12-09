<script lang="ts" setup>
import {ref} from 'vue';
import CircleCheckIcon from '@/Icons/CircleCheckIcon.vue';
import CircleInformationIcon from '@/Icons/CircleInformationIcon.vue';
import CircleXMarkIcon from '@/Icons/CircleXMarkIcon.vue';
import TriangleExclamation from '@/Icons/TriangleExclamation.vue';
import XMarkIcon from '@/Icons/XMarkIcon.vue';

const props = defineProps<{
    type?: 'success' | 'error' | 'warning' | 'info';
    message: string;
}>();

const show = ref(true);
let color: string;
let icon: any;

switch (props.type) {
    case 'error':
        color = 'bg-error';
        icon = CircleXMarkIcon;
        break;
    case 'warning':
        color = 'bg-warning';
        icon = TriangleExclamation;
        break;
    case 'info':
        color = 'bg-info';
        icon = CircleInformationIcon;
        break;
    default:
        color = 'bg-success';
        icon = CircleCheckIcon;
        break;
}

defineEmits(['leaved']);

setTimeout(() => {
    show.value = false;
}, 4000);
</script>

<template>
    <transition appear @after-leave="$emit('leaved')">
        <div
            v-if="show"
            class="max-w-100 rounded-lg bg-white py-4 pl-4 pr-4.5 shadow-2 dark:bg-meta-4"
        >
            <div class="flex items-center justify-between gap-5">
                <div
                    :class="color"
                    class="flex h-10 w-full max-w-10 items-center justify-center rounded-full p-2"
                >
                    <component :is="icon" class="size-6 text-white"></component>
                </div>

                <div>
                    <p class="text-sm font-medium">
                        {{ message }}
                    </p>
                </div>

                <button class="hover:opacity-75" type="button" @click="show = false">
                    <XMarkIcon class="size-6" />
                </button>
            </div>
        </div>
    </transition>
</template>

<style scoped>
.v-enter-active,
.v-leave-active {
    transition:
        opacity 0.5s ease,
        transform 0.5s ease;
}

.v-enter-from,
.v-leave-to {
    opacity: 0;
    transform: scale(75%);
}
</style>
