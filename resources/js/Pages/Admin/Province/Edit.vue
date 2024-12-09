<script lang="ts" setup>
import {useForm} from '@inertiajs/vue3';
import {computed} from 'vue';
import {ProvinceFormType} from '@/types/form';
import {Province} from '@/types/model';
import DashboardLayout from '@/Layouts/DashboardLayout.vue';
import ProvinceForm from '@/Forms/ProvinceForm.vue';

const props = defineProps<{
    province: Province;
}>();

const province = props.province;
const pageTitle = computed(() => `İli Düzenle #${province.id}`);
const breadcrumbItems = [{title: 'İller', href: route('admin.province.list')}];

const form = useForm<ProvinceFormType>({
    name: province.name,
    code: province.code,
    title: province.title,
    slug: province.slug,
});

function submit() {
    form.post(route('admin.province.update', {id: province.id}));
}
</script>

<template>
    <DashboardLayout :breadcrumbItems :title="pageTitle">
        <ProvinceForm :form @submit.prevent="submit" />
    </DashboardLayout>
</template>
