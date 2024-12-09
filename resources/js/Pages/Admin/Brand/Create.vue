<script lang="ts" setup>
import {useForm} from '@inertiajs/vue3';
import {BrandFormType} from '@/types/form';
import DashboardLayout from '@/Layouts/DashboardLayout.vue';
import BrandForm from '@/Forms/BrandForm.vue';

const breadcrumbItems = [{title: 'Markalar', href: route('admin.brand.list')}];

const form = useForm<BrandFormType>({
    active: true,
    name: '',
    title: '',
    slug: '',
    logo: null,
    order: null,
});

function submit() {
    form.post(route('admin.brand.store'));
}
</script>

<template>
    <DashboardLayout :breadcrumbItems title="Marka Oluştur">
        <BrandForm :form @submit.prevent="submit" />
    </DashboardLayout>
</template>
