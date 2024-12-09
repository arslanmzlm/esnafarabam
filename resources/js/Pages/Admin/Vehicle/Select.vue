<script lang="ts" setup>
import {router} from '@inertiajs/vue3';
import {VehicleType} from '@/types/model';
import DashboardLayout from '@/Layouts/DashboardLayout.vue';
import VehicleSelector from '@/Forms/VehicleSelector.vue';

defineProps<{
    vehicleTypes: VehicleType[];
}>();

const breadcrumbItems = [{title: 'İlanlar', href: route('admin.vehicle.list')}];

function submit(vehicle_id: number) {
    router.get(route('admin.item.create', {id: vehicle_id}));
}
</script>

<template>
    <DashboardLayout :breadcrumbItems title="Taşıt Seçimi">
        <VehicleSelector :vehicle-types @submit="submit" />
    </DashboardLayout>
</template>
