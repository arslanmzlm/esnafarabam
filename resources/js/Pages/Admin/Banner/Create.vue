<script lang="ts" setup>
import {useForm} from '@inertiajs/vue3';
import {BannerField} from '@/types/enums';
import {BannerFormType} from '@/types/form';
import {EnumResponse} from '@/types/response';
import DashboardLayout from '@/Layouts/DashboardLayout.vue';
import BannerForm from '@/Forms/BannerForm.vue';

defineProps<{
    bannerFields: EnumResponse[];
}>();

const breadcrumbItems = [{title: 'Bannerlar', href: route('admin.banner.list')}];

const form = useForm<BannerFormType>({
    active: false,
    field: BannerField.HOMEPAGE_SLIDER,
    title: '',
    alt_title: null,
    sub_title: null,
    body: null,
    excerpt: null,
    link_label: null,
    link: null,
    image: null,
    mobile_image: null,
    alt: null,
    options: null,
});

function submit() {
    form.post(route('admin.banner.store'));
}
</script>

<template>
    <DashboardLayout :breadcrumbItems title="Banner Oluştur">
        <BannerForm :banner-fields :form @submit.prevent="submit" />
    </DashboardLayout>
</template>
