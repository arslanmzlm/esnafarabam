<script lang="ts" setup>
import {useForm} from '@inertiajs/vue3';
import {UserFormType} from '@/types/form';
import {Province, Role} from '@/types/model';
import DashboardLayout from '@/Layouts/DashboardLayout.vue';
import UserForm from '@/Forms/UserForm.vue';

defineProps<{
    provinces: Province[];
    roles: Role[];
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
    role_id: null,
});

function submit() {
    form.post(route('admin.user.store'));
}
</script>

<template>
    <DashboardLayout :breadcrumbItems title="Kullanıcı Oluştur">
        <UserForm :form :provinces :roles @submit.prevent="submit" />
    </DashboardLayout>
</template>
