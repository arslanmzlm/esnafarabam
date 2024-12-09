<script lang="ts" setup>
import HeaderArea from '@/Parts/Header/HeaderArea.vue';
import SidebarArea from '@/Parts/Sidebar/SidebarArea.vue';
import {Head} from '@inertiajs/vue3';
import {BreadcrumbItem} from '@/types/component';
import Breadcrumb from '@/Components/Breadcrumb.vue';
import Toast from '@/Components/Toast/Toast.vue';

defineProps<{
    title: string;
    breadcrumbItems?: BreadcrumbItem[];
}>();
</script>

<template>
    <Head :title />

    <!-- ===== Page Wrapper Start ===== -->
    <div class="flex h-screen overflow-hidden">
        <!-- ===== Sidebar Start ===== -->
        <SidebarArea />
        <!-- ===== Sidebar End ===== -->

        <!-- ===== Content Area Start ===== -->
        <div class="relative flex flex-1 flex-col overflow-y-auto overflow-x-hidden">
            <!-- ===== Header Start ===== -->
            <HeaderArea />
            <!-- ===== Header End ===== -->

            <!-- ===== Main Content Start ===== -->
            <main>
                <div class="mx-auto max-w-screen-2xl p-4 md:p-6 2xl:p-10">
                    <Breadcrumb v-if="title || breadcrumbItems" :items="breadcrumbItems" :title />
                    <slot></slot>
                </div>
            </main>
            <!-- ===== Main Content End ===== -->
        </div>
    </div>
    <!-- ===== Page Wrapper End ===== -->

    <Toast />
</template>
