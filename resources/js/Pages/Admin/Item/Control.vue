<script lang="ts" setup>
import {useForm} from '@inertiajs/vue3';
import {computed} from 'vue';
import {ItemControlFormType} from '@/types/form';
import {AttributeCategory, Item, Vehicle} from '@/types/model';
import {AttributeValueResponse, EnumResponse} from '@/types/response';
import DashboardLayout from '@/Layouts/DashboardLayout.vue';
import ItemControlForm from '@/Forms/ItemControlForm.vue';

const props = defineProps<{
    item: Item;
    states: EnumResponse[];
    vehicle: Vehicle;
    attributeCategories: AttributeCategory[];
    attributeValues: AttributeValueResponse[];
}>();

const item = props.item;
const pageTitle = computed(() => `İlan Kontrol Et #${item.id}`);
const breadcrumbItems = [{title: 'İlanlar', href: route('admin.item.list')}];

const form = useForm<ItemControlFormType>({
    state: item.state,
    note: item.note,
    approved_photos: [],
    rejected_photos: [],
    deleted_photos: [],
});

function submit() {
    form.post(route('admin.item.evaluate', {id: item.id}));
}
</script>

<template>
    <DashboardLayout :breadcrumbItems :title="pageTitle">
        <ItemControlForm
            :attribute-categories
            :attribute-values
            :form
            :item
            :states
            :vehicle
            @submit.prevent="submit"
        />
    </DashboardLayout>
</template>
