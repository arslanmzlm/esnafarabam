<script lang="ts" setup>
import {useForm} from '@inertiajs/vue3';
import {PageCategory} from '@/types/enums';
import {PageFormType} from '@/types/form';
import {EnumResponse} from '@/types/response';
import DashboardLayout from '@/Layouts/DashboardLayout.vue';
import PageForm from '@/Forms/PageForm.vue';

defineProps<{
    pageCategories: EnumResponse[];
}>();

const breadcrumbItems = [{title: 'Sayfalar', href: route('admin.page.list')}];

const form = useForm<PageFormType>({
    active: false,
    category: PageCategory.COMMERCIAL,
    title: '',
    slug: null,
    body: null,
    meta_title: null,
    meta_description: null,
    meta_keywords: null,
});

function submit() {
    form.post(route('admin.page.store'));
}
</script>

<template>
    <DashboardLayout :breadcrumbItems title="Sayfa Oluştur">
        <PageForm :form :page-categories @submit.prevent="submit" />
    </DashboardLayout>
</template>
