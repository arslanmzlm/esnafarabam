<script lang="ts" setup>
import {useForm} from '@inertiajs/vue3';
import {computed} from 'vue';
import {PageFormType} from '@/types/form';
import {Page} from '@/types/model';
import {EnumResponse} from '@/types/response';
import DashboardLayout from '@/Layouts/DashboardLayout.vue';
import PageForm from '@/Forms/PageForm.vue';

const props = defineProps<{
    page: Page;
    pageCategories: EnumResponse[];
}>();

const page = props.page;

const pageTitle = computed(() => `Sayfa Düzenle #${page.id}`);
const breadcrumbItems = [{title: 'Sayfalar', href: route('admin.page.list')}];

const form = useForm<PageFormType>({
    active: page.active,
    category: page.category,
    title: page.title,
    slug: page.slug,
    body: page.body,
    meta_title: page.meta_title,
    meta_description: page.meta_description,
    meta_keywords: page.meta_keywords,
});

function submit() {
    form.post(route('admin.page.update', {id: page.id}));
}
</script>

<template>
    <DashboardLayout :breadcrumbItems :title="pageTitle">
        <PageForm :form :page-categories @submit.prevent="submit" />
    </DashboardLayout>
</template>
