<script lang="ts" setup>
import {useForm} from '@inertiajs/vue3';
import {computed} from 'vue';
import {NeighborhoodFormType} from '@/types/form';
import {District, Neighborhood} from '@/types/model';
import DashboardLayout from '@/Layouts/DashboardLayout.vue';
import NeighborhoodForm from '@/Forms/NeighborhoodForm.vue';

const props = defineProps<{
    neighborhood: Neighborhood;
    districts: District[];
}>();

const neighborhood = props.neighborhood;
const pageTitle = computed(() => `Mahalleyi Düzenle #${neighborhood.id}`);
const breadcrumbItems = [{title: 'Mahalleler', href: route('admin.neighborhood.list')}];

const form = useForm<NeighborhoodFormType>({
    name: neighborhood.name,
    district_id: neighborhood.district_id,
    title: neighborhood.title,
    slug: neighborhood.slug,
});

function submit() {
    form.post(route('admin.neighborhood.update', {id: neighborhood.id}));
}
</script>

<template>
    <DashboardLayout :breadcrumbItems :title="pageTitle">
        <NeighborhoodForm :districts :form @submit.prevent="submit" />
    </DashboardLayout>
</template>
