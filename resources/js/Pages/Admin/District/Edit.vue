<script lang="ts" setup>
import {useForm} from '@inertiajs/vue3';
import {computed} from 'vue';
import {DistrictFormType} from '@/types/form';
import {District, Province} from '@/types/model';
import DashboardLayout from '@/Layouts/DashboardLayout.vue';
import DistrictForm from '@/Forms/DistrictForm.vue';

const props = defineProps<{
    district: District;
    provinces: Province[];
}>();

const district = props.district;
const pageTitle = computed(() => `İlçeyi Düzenle #${district.id}`);
const breadcrumbItems = [{title: 'İlçeler', href: route('admin.district.list')}];

const form = useForm<DistrictFormType>({
    name: district.name,
    province_id: district.province_id,
    title: district.title,
    slug: district.slug,
});

function submit() {
    form.post(route('admin.district.update', {id: district.id}));
}
</script>

<template>
    <DashboardLayout :breadcrumbItems :title="pageTitle">
        <DistrictForm :form :provinces @submit.prevent="submit" />
    </DashboardLayout>
</template>
