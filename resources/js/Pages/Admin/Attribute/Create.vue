<script lang="ts" setup>
import {useForm} from '@inertiajs/vue3';
import {AttributeInput} from '@/types/enums';
import {AttributeFormType} from '@/types/form';
import {AttributeCategory, VehicleType} from '@/types/model';
import {AttributeInputEnumResponse, EnumResponse} from '@/types/response';
import DashboardLayout from '@/Layouts/DashboardLayout.vue';
import AttributeForm from '@/Forms/AttributeForm.vue';

const props = defineProps<{
    categories: AttributeCategory[];
    vehicleTypes: VehicleType[];
    types: EnumResponse[];
    inputs: AttributeInputEnumResponse[];
    category_id?: number;
}>();

const breadcrumbItems = [{title: 'Özellikler', href: route('admin.attribute.list')}];

const form = useForm<AttributeFormType>({
    active: true,
    attribute_category_id: props.category_id ?? 0,
    input: AttributeInput.TEXT,
    name: '',
    description: '',
    unit: '',
    values: [],
    order: null,
    required: true,
    hidden: false,
});

function submit() {
    form.post(route('admin.attribute.store'));
}
</script>

<template>
    <DashboardLayout :breadcrumbItems title="Özellik Oluştur">
        <AttributeForm :categories :form :inputs :types :vehicle-types @submit.prevent="submit" />
    </DashboardLayout>
</template>
