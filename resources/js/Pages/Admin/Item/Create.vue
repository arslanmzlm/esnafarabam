<script lang="ts" setup>
import {useForm} from '@inertiajs/vue3';
import {ItemFormType} from '@/types/form';
import {AttributeCategory, Province, Vehicle} from '@/types/model';
import DashboardLayout from '@/Layouts/DashboardLayout.vue';
import ItemForm from '@/Forms/ItemForm.vue';

const props = defineProps<{
    vehicle: Vehicle;
    attributeCategories: AttributeCategory[];
    provinces: Province[];
}>();

const breadcrumbItems = [{title: 'İlanlar', href: route('admin.item.list')}];

const form = useForm<ItemFormType>({
    vehicle_id: props.vehicle.id,
    title: props.vehicle.title,
    price: 0,
    kilometer: 0,
    description: '',
    province_id: 0,
    district_id: 0,
    neighborhood_id: 0,
    attributes: [],
    photos: [],
});

props.attributeCategories.forEach((attributeCategory) => {
    attributeCategory.attributes?.forEach((attribute) => {
        form.attributes.push({
            id: null,
            attribute_id: attribute.id,
            value: null,
        });
    });
});

function submit() {
    form.post(route('admin.item.store'));
}
</script>

<template>
    <DashboardLayout :breadcrumbItems title="İlan Oluştur">
        <ItemForm :attribute-categories :form :provinces :vehicle @submit.prevent="submit" />
    </DashboardLayout>
</template>
