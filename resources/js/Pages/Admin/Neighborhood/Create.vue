<script lang="ts" setup>
import {useForm} from '@inertiajs/vue3';
import {NeighborhoodFormType} from '@/types/form';
import {District} from '@/types/model';
import DashboardLayout from '@/Layouts/DashboardLayout.vue';
import NeighborhoodForm from '@/Forms/NeighborhoodForm.vue';

defineProps<{
    districts: District[];
}>();

const breadcrumbItems = [{title: 'İlçeler', href: route('admin.neighborhood.list')}];

const form = useForm<NeighborhoodFormType>({
    name: '',
    district_id: 0,
    title: '',
    slug: null,
});

function submit() {
    form.post(route('admin.neighborhood.store'));
}
</script>

<template>
    <DashboardLayout :breadcrumbItems title="İl Oluştur">
        <NeighborhoodForm :districts :form @submit.prevent="submit" />
    </DashboardLayout>
</template>
