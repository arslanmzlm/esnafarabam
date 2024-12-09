<script lang="ts" setup>
import {useForm} from '@inertiajs/vue3';
import {ProvinceFormType} from '@/types/form';
import DashboardLayout from '@/Layouts/DashboardLayout.vue';
import ProvinceForm from '@/Forms/ProvinceForm.vue';

const breadcrumbItems = [{title: 'İller', href: route('admin.province.list')}];

const form = useForm<ProvinceFormType>({
    name: '',
    code: 0,
    title: '',
    slug: null,
});

function submit() {
    form.post(route('admin.province.store'));
}
</script>

<template>
    <DashboardLayout :breadcrumbItems title="İl Oluştur">
        <ProvinceForm :form @submit.prevent="submit" />
    </DashboardLayout>
</template>
