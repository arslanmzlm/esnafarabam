<script lang="ts" setup>
import {useForm} from '@inertiajs/vue3';
import {computed} from 'vue';
import {ItemFormType} from '@/types/form';
import {AttributeCategory, Item, Province, Vehicle} from '@/types/model';
import {AttributeValueResponse} from '@/types/response';
import DashboardLayout from '@/Layouts/DashboardLayout.vue';
import ItemForm from '@/Forms/ItemForm.vue';

const props = defineProps<{
    item: Item;
    vehicle: Vehicle;
    attributeCategories: AttributeCategory[];
    attributeValues: AttributeValueResponse[];
    provinces: Province[];
}>();

const item = props.item;
const pageTitle = computed(() => `İlan Düzenle #${item.id}`);
const breadcrumbItems = [{title: 'İlanlar', href: route('admin.item.list')}];

const form = useForm<ItemFormType>({
    title: item.title,
    price: item.price,
    kilometer: item.kilometer,
    description: item.description,
    province_id: item.province_id,
    district_id: item.district_id,
    neighborhood_id: item.neighborhood_id,
    attributes: props.attributeValues,
    photos: item.photos ?? [],
});

function submit() {
    form.post(route('admin.item.update', {id: item.id}));
}
</script>

<template>
    <DashboardLayout :breadcrumbItems :title="pageTitle">
        <ItemForm :attribute-categories :form :provinces :vehicle @submit.prevent="submit" />
    </DashboardLayout>
</template>
