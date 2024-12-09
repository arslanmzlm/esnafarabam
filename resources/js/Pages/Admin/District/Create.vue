<script lang="ts" setup>
import {useForm} from '@inertiajs/vue3';
import {DistrictFormType} from '@/types/form';
import {Province} from '@/types/model';
import DashboardLayout from '@/Layouts/DashboardLayout.vue';
import DistrictForm from '@/Forms/DistrictForm.vue';

defineProps<{
    provinces: Province[];
}>();

const breadcrumbItems = [{title: 'İlçeler', href: route('admin.district.list')}];

const form = useForm<DistrictFormType>({
    name: '',
    province_id: 0,
    title: '',
    slug: null,
});

function submit() {
    form.post(route('admin.district.store'));
}
</script>

<template>
    <DashboardLayout :breadcrumbItems title="İl Oluştur">
        <DistrictForm :form :provinces @submit.prevent="submit" />
    </DashboardLayout>
</template>
