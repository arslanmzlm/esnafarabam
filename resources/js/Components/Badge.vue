<script lang="ts" setup>
import {reactive} from 'vue';

const props = withDefaults(
    defineProps<{
        type?: 'success' | 'error' | 'warning' | 'info';
    }>(),
    {
        type: 'success',
    },
);

const classes = reactive<string[]>([]);

switch (props.type) {
    case 'success':
        classes.push('bg-success', 'text-success');
        break;
    case 'error':
        classes.push('bg-error', 'text-error');
        break;
    case 'warning':
        classes.push('bg-warning', 'text-warning');
        break;
    case 'info':
        classes.push('bg-info', 'text-info');
        break;
}
</script>

<template>
    <div
        :class="classes"
        class="inline-flex rounded-full bg-opacity-10 px-3 py-1 text-sm font-medium"
    >
        <slot></slot>
    </div>
</template>
