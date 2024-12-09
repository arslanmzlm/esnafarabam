<script lang="ts" setup>
import {useForm} from '@inertiajs/vue3';
import {computed} from 'vue';
import {VehicleTypeFormType} from '@/types/form';
import {VehicleType} from '@/types/model';
import {EnumResponse} from '@/types/response';
import DashboardLayout from '@/Layouts/DashboardLayout.vue';
import VehicleTypeForm from '@/Forms/VehicleTypeForm.vue';

const props = defineProps<{
    vehicleType: VehicleType;
    stepTypes: EnumResponse[];
}>();

const vehicleType = props.vehicleType;

const pageTitle = computed(() => `Taşıt Türü Düzenle #${vehicleType.id}`);
const breadcrumbItems = [{title: 'Taşıt Türleri', href: route('admin.vehicle.type.list')}];

const form = useForm<VehicleTypeFormType>({
    active: vehicleType.active,
    name: vehicleType.name,
    title: vehicleType.title,
    slug: vehicleType.slug,
    logo: null,
    order: vehicleType.order,
    step_type: vehicleType.step_type,
});

function submit() {
    form.post(route('admin.vehicle.type.update', {id: vehicleType.id}));
}
</script>

<template>
    <DashboardLayout :breadcrumbItems :title="pageTitle">
        <VehicleTypeForm
            :form
            :logo-src="vehicleType.logo_src"
            :step-types
            @submit.prevent="submit"
        />
    </DashboardLayout>
</template>
