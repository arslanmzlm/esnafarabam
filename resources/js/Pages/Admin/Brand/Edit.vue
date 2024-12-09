<script lang="ts" setup>
import {useForm} from '@inertiajs/vue3';
import {computed} from 'vue';
import {BrandFormType} from '@/types/form';
import {Brand} from '@/types/model';
import DashboardLayout from '@/Layouts/DashboardLayout.vue';
import BrandForm from '@/Forms/BrandForm.vue';

const props = defineProps<{
    brand: Brand;
}>();

const brand = props.brand;
const pageTitle = computed(() => `Marka Düzenle #${brand.id}`);
const breadcrumbItems = [{title: 'Markalar', href: route('admin.brand.list')}];

const form = useForm<BrandFormType>({
    active: brand.active,
    name: brand.name,
    title: brand.title,
    slug: brand.slug,
    logo: null,
    order: brand.order,
});

function submit() {
    form.post(route('admin.brand.update', {id: brand.id}));
}
</script>

<template>
    <DashboardLayout :breadcrumbItems :title="pageTitle">
        <BrandForm :form :logo-src="brand.logo_src" @submit.prevent="submit" />
    </DashboardLayout>
</template>
