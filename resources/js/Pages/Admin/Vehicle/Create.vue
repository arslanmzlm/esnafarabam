<script lang="ts" setup>
import {useForm} from '@inertiajs/vue3';
import {Fuel, Gear} from '@/types/enums';
import {VehicleFormType} from '@/types/form';
import {Brand, VehicleType} from '@/types/model';
import {EnumResponse} from '@/types/response';
import DashboardLayout from '@/Layouts/DashboardLayout.vue';
import VehicleForm from '@/Forms/VehicleForm.vue';

defineProps<{
    vehicleTypes: VehicleType[];
    brands: Brand[];
    gears: EnumResponse[];
    fuels: EnumResponse[];
}>();

const breadcrumbItems = [{title: 'Taşıtlar', href: route('admin.vehicle.list')}];

const form = useForm<VehicleFormType>({
    active: true,
    vehicle_type_id: 0,
    title: '',
    slug: null,
    brand_id: 0,
    stock_code: '',
    year: 0,
    series: '',
    model: '',
    submodel: '',
    gear: Gear.MANUAL,
    fuel: Fuel.PETROL,
    engine_power: 0,
    engine_size: 0,
});

function submit() {
    form.post(route('admin.vehicle.store'));
}
</script>

<template>
    <DashboardLayout :breadcrumbItems title="Taşıt Oluştur">
        <VehicleForm :brands :form :fuels :gears :vehicle-types @submit.prevent="submit" />
    </DashboardLayout>
</template>
