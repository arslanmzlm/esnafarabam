<script lang="ts" setup>
import {useForm} from '@inertiajs/vue3';
import {StepType} from '@/types/enums';
import {VehicleTypeFormType} from '@/types/form';
import {EnumResponse} from '@/types/response';
import DashboardLayout from '@/Layouts/DashboardLayout.vue';
import VehicleTypeForm from '@/Forms/VehicleTypeForm.vue';

defineProps<{
    stepTypes: EnumResponse[];
}>();

const breadcrumbItems = [{title: 'Taşıt Türleri', href: route('admin.vehicle.type.list')}];

const form = useForm<VehicleTypeFormType>({
    active: true,
    name: '',
    title: '',
    slug: '',
    logo: null,
    order: null,
    step_type: StepType.YEAR,
});

function submit() {
    form.post(route('admin.vehicle.type.store'));
}
</script>

<template>
    <DashboardLayout :breadcrumbItems title="Taşıt Türü Oluştur">
        <VehicleTypeForm :form :step-types @submit.prevent="submit" />
    </DashboardLayout>
</template>
