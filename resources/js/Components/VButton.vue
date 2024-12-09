<script lang="ts" setup>
import {Link} from '@inertiajs/vue3';
import {reactive} from 'vue';

const props = withDefaults(
    defineProps<{
        type?: 'button' | 'submit' | 'reset';
        href?: string;
        theme?: 'success' | 'danger' | 'error' | 'info' | 'warning';
        block?: boolean;
        icon?: boolean;
        size?: 'xs' | 'sm' | 'md' | 'lg';
        rounded?: boolean;
        title?: string;
        disabled?: boolean;
    }>(),
    {
        type: 'button',
        block: false,
        icon: false,
        size: 'md',
        rounded: true,
        disabled: false,
    },
);

const classes = reactive<string[]>([
    'justify-center',
    'font-medium',
    'hover:bg-opacity-90',
    'disabled:cursor-not-allowed',
    'disabled:bg-opacity-50',
    'disabled:hover:bg-opacity-50',
]);

if (props.block) {
    classes.push('flex', 'w-full', 'p-3');
} else if (props.icon) {
    classes.push('inline-flex', 'items-center', 'p-4', 'text-center');
} else {
    classes.push('inline-flex', 'items-center', 'text-center');
}

if (!props.icon) {
    if (props.size === 'xs') {
        classes.push('px-3', 'py-1.5', 'text-xs');
    } else if (props.size === 'sm') {
        classes.push('px-4', 'py-2.5', 'text-sm');
    } else if (props.size === 'lg') {
        classes.push('px-6.5', 'py-3.5', 'text-lg');
    } else {
        classes.push('px-4.5', 'py-3');
    }
}

if (props.rounded) {
    classes.push('rounded');
}

if (props.theme === 'success') {
    classes.push('bg-success', 'text-white');
} else if (props.theme === 'danger' || props.theme === 'error') {
    classes.push('bg-danger', 'text-white');
} else if (props.theme === 'info') {
    classes.push('bg-info', 'text-white');
} else if (props.theme === 'warning') {
    classes.push('bg-warning', 'text-white');
} else {
    classes.push('bg-primary', 'text-white');
}
</script>

<template>
    <Link v-if="href" :class="classes" :disabled :href :title preserve-state>
        <slot></slot>
    </Link>

    <button v-else :class="classes" :disabled :title :type>
        <slot></slot>
    </button>
</template>
