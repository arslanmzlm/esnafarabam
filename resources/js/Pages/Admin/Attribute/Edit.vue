<script lang="ts" setup>
import {useForm} from '@inertiajs/vue3';
import {computed} from 'vue';
import {AttributeFormType} from '@/types/form';
import {Attribute, AttributeCategory, VehicleType} from '@/types/model';
import {AttributeInputEnumResponse, EnumResponse} from '@/types/response';
import DashboardLayout from '@/Layouts/DashboardLayout.vue';
import AttributeForm from '@/Forms/AttributeForm.vue';

const props = defineProps<{
    attribute: Attribute;
    categories: AttributeCategory[];
    vehicleTypes: VehicleType[];
    types: EnumResponse[];
    inputs: AttributeInputEnumResponse[];
}>();

const attribute = props.attribute;
const pageTitle = computed(() => `Özelliği Düzenle #${attribute.id}`);
const breadcrumbItems = [{title: 'Özellikler', href: route('admin.attribute.list')}];

const form = useForm<AttributeFormType>({
    active: attribute.active,
    attribute_category_id: attribute.attribute_category_id,
    input: attribute.input,
    name: attribute.name,
    description: attribute.description,
    unit: attribute.unit,
    values: attribute?.values ?? [],
    order: attribute.order,
    required: attribute.required,
    hidden: attribute.hidden,
});

function submit() {
    form.post(route('admin.attribute.update', {id: attribute.id}));
}
</script>

<template>
    <DashboardLayout :breadcrumbItems :title="pageTitle">
        <AttributeForm :categories :form :inputs :types :vehicle-types @submit.prevent="submit" />
    </DashboardLayout>
</template>
