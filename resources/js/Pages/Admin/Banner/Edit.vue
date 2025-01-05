<script lang="ts" setup>
import {useForm} from '@inertiajs/vue3';
import {computed} from 'vue';
import {BannerFormType} from '@/types/form';
import {Banner} from '@/types/model';
import {EnumResponse} from '@/types/response';
import DashboardLayout from '@/Layouts/DashboardLayout.vue';
import BannerForm from '@/Forms/BannerForm.vue';

const props = defineProps<{
    banner: Banner;
    bannerFields: EnumResponse[];
}>();

const banner = props.banner;

const pageTitle = computed(() => `Banner Düzenle #${banner.id}`);
const breadcrumbItems = [{title: 'Bannerlar', href: route('admin.banner.list')}];

const form = useForm<BannerFormType>({
    active: banner.active,
    field: banner.field,
    title: banner.title,
    alt_title: banner.alt_title,
    sub_title: banner.sub_title,
    body: banner.body,
    excerpt: banner.excerpt,
    link_label: banner.link_label,
    link: banner.link,
    image: null,
    mobile_image: null,
    alt: banner.alt,
    options: banner.options,
});

function submit() {
    form.post(route('admin.banner.update', {id: banner.id}));
}
</script>

<template>
    <DashboardLayout :breadcrumbItems :title="pageTitle">
        <BannerForm
            :banner-fields
            :form
            :image-src="banner.image_src"
            :mobile-image-src="banner.mobile_image_src"
            is-edit
            @submit.prevent="submit"
        />
    </DashboardLayout>
</template>
