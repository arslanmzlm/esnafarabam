<script lang="ts" setup>
import {useForm} from '@inertiajs/vue3';
import {UserFormType} from '@/types/form';
import {Province} from '@/types/model';
import DashboardLayout from '@/Layouts/DashboardLayout.vue';
import UserForm from '@/Forms/UserForm.vue';

defineProps<{
    provinces: Province[];
}>();

const breadcrumbItems = [{title: 'Kullanıcılar', href: route('admin.user.list')}];

const form = useForm<UserFormType>({
    username: '',
    email: '',
    phone: '',
    password: '',
    password_confirmation: '',
    name: '',
    surname: '',
    company: '',
    company_phone: '',
    address: '',
    tax_identity: '',
    province_id: 0,
    district_id: 0,
});

function submit() {
    form.post(route('admin.user.store'));
}
</script>

<template>
    <DashboardLayout :breadcrumbItems title="Kullanıcı Oluştur">
        <UserForm :form :provinces @submit.prevent="submit" />
    </DashboardLayout>
</template>
