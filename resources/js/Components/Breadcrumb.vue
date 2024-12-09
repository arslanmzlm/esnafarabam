<script lang="ts" setup>
import {Link} from '@inertiajs/vue3';
import {BreadcrumbItem} from '@/types/component';

defineProps<{
    title: string;
    items?: BreadcrumbItem[];
}>();
</script>

<template>
    <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <h1 class="text-title-md2 font-semibold text-black dark:text-white">
            {{ title }}
        </h1>

        <nav>
            <ol class="flex items-center gap-2">
                <li>
                    <Link :href="route('dashboard')" class="font-medium hover:text-primary"
                        >Anasayfa /
                    </Link>
                </li>

                <li v-for="(link, index) in items" :key="index">
                    <Link v-if="link.href" :href="link.href" class="font-medium hover:text-primary"
                        >{{ link.title }} /
                    </Link>
                    <span v-else class="font-medium text-primary">{{ link.title }}</span>
                </li>

                <li>
                    <span class="font-medium text-primary">{{ title }}</span>
                </li>
            </ol>
        </nav>
    </div>
</template>
