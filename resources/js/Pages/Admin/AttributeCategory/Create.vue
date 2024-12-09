<script lang="ts" setup>
import {useForm} from '@inertiajs/vue3';
import {AttributeType} from '@/types/enums';
import {AttributeCategoryFormType} from '@/types/form';
import {VehicleType} from '@/types/model';
import {EnumResponse} from '@/types/response';
import DashboardLayout from '@/Layouts/DashboardLayout.vue';
import AttributeCategoryForm from '@/Forms/AttributeCategoryForm.vue';

defineProps<{
    types: EnumResponse[];
    vehicleTypes: VehicleType[];
}>();

const breadcrumbItems = [
    {title: 'Özellik Kategorileri', href: route('admin.attribute.category.list')},
];

const form = useForm<AttributeCategoryFormType>({
    type: AttributeType.VEHICLE,
    vehicle_type_id: null,
    name: '',
    order: null,
    description: null,
});

function submit() {
    form.post(route('admin.attribute.category.store'));
}
</script>

<template>
    <DashboardLayout :breadcrumbItems title="Özellik Kategorisi Oluştur">
        <AttributeCategoryForm :form :types :vehicle-types @submit.prevent="submit" />
    </DashboardLayout>
</template>
