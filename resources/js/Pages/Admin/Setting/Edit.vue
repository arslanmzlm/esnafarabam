<script lang="ts" setup>
import {useForm} from '@inertiajs/vue3';
import {SettingFormType} from '@/types/form';
import {SettingsResponse} from '@/types/response';
import DashboardLayout from '@/Layouts/DashboardLayout.vue';
import SettingForm from '@/Forms/SettingForm.vue';

const props = defineProps<{
    settings: SettingsResponse;
}>();

const form = useForm<SettingFormType>({
    site_title: props.settings.site_title ?? '',
    site_description: props.settings.site_description ?? '',
    whatsapp_number: props.settings.whatsapp_number ?? '',
    logo_default: props.settings.logo_default ?? '',
    logo_favicon: props.settings.logo_favicon ?? '',
    logo_dark: props.settings.logo_dark ?? '',
    logo_icon: props.settings.logo_icon ?? '',
    footer_description: props.settings.footer_description ?? '',
    footer_copyright: props.settings.footer_copyright ?? '',
    footer_end: props.settings.footer_end ?? '',
});

function submit() {
    form.post(route('admin.setting.update'));
}
</script>

<template>
    <DashboardLayout title="Site Ayarları">
        <SettingForm :form :settings @submit.prevent="submit" />
    </DashboardLayout>
</template>
