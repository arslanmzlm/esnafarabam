<script lang="ts" setup>
import {computed} from 'vue';

const icon = computed(() => {
    return window.logo_icon;
});
</script>

<template>
    <div class="bg-gray-100 flex min-h-screen flex-col items-center pt-6 sm:justify-center sm:pt-0">
        <div>
            <a href="/">
                <img :src="icon" alt="Logo" class="text-gray-500 h-20 w-20 fill-current" />
            </a>
        </div>

        <main class="mt-6 w-full px-2">
            <slot />
        </main>
    </div>
</template>
