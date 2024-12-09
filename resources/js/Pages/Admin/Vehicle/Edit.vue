<script lang="ts" setup>
import {useForm} from '@inertiajs/vue3';
import {computed} from 'vue';
import {VehicleFormType} from '@/types/form';
import {AttributeCategory, Brand, Vehicle, VehicleType} from '@/types/model';
import {AttributeValueResponse, EnumResponse} from '@/types/response';
import DashboardLayout from '@/Layouts/DashboardLayout.vue';
import VehicleForm from '@/Forms/VehicleForm.vue';

const props = defineProps<{
    vehicle: Vehicle;
    vehicleTypes: VehicleType[];
    brands: Brand[];
    gears: EnumResponse[];
    fuels: EnumResponse[];
    attributeCategories: AttributeCategory[];
    attributeValues: AttributeValueResponse[];
}>();

const vehicle = props.vehicle;
const pageTitle = computed(() => `Taşıt Düzenle #${vehicle.id}`);
const breadcrumbItems = [{title: 'Taşıtlar', href: route('admin.vehicle.list')}];

const form = useForm<VehicleFormType>({
    active: vehicle.active,
    vehicle_type_id: vehicle.vehicle_type_id,
    brand_id: vehicle.brand_id,
    title: vehicle.title,
    slug: vehicle.slug,
    stock_code: vehicle.stock_code,
    year: vehicle.year,
    series: vehicle.series,
    model: vehicle.model,
    submodel: vehicle.submodel,
    gear: vehicle.gear,
    fuel: vehicle.fuel,
    engine_power: vehicle.engine_power,
    engine_size: vehicle.engine_size,
    attributes: props.attributeValues,
});

function submit() {
    form.post(route('admin.vehicle.update', {id: vehicle.id}));
}
</script>

<template>
    <DashboardLayout :breadcrumbItems :title="pageTitle">
        <VehicleForm
            :attribute-categories
            :attribute-values
            :brands
            :form
            :fuels
            :gears
            :vehicle-types
            is-edit
            @submit.prevent="submit"
        />
    </DashboardLayout>
</template>
