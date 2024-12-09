<script lang="ts" setup>
import {useForm} from '@inertiajs/vue3';
import {computed} from 'vue';
import {AttributeCategoryFormType} from '@/types/form';
import {AttributeCategory, VehicleType} from '@/types/model';
import {EnumResponse} from '@/types/response';
import DashboardLayout from '@/Layouts/DashboardLayout.vue';
import AttributeCategoryForm from '@/Forms/AttributeCategoryForm.vue';

const props = defineProps<{
    category: AttributeCategory;
    types: EnumResponse[];
    vehicleTypes: VehicleType[];
}>();

const category = props.category;
const pageTitle = computed(() => `Kategoriyi Düzenle #${category.id}`);
const breadcrumbItems = [
    {title: 'Özellik Kategorileri', href: route('admin.attribute.category.list')},
];

const form = useForm<AttributeCategoryFormType>({
    type: category.type,
    vehicle_type_id: category.vehicle_type_id,
    name: category.name,
    order: category.order,
    description: category.description,
});

function submit() {
    form.post(route('admin.attribute.category.update', {id: category.id}));
}
</script>

<template>
    <DashboardLayout :breadcrumbItems :title="pageTitle">
        <AttributeCategoryForm :form :types :vehicle-types is-edit @submit.prevent="submit" />
    </DashboardLayout>
</template>
