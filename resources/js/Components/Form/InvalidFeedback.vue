<script lang="ts" setup>
defineProps<{
    message: string;
}>();
</script>

<template>
    <div class="mt-2 text-sm text-danger">{{ message }}</div>
</template>
