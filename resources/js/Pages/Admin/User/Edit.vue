<script lang="ts" setup>
import {useForm} from '@inertiajs/vue3';
import {computed} from 'vue';
import {UserFormType} from '@/types/form';
import {Province, Role, User} from '@/types/model';
import DashboardLayout from '@/Layouts/DashboardLayout.vue';
import UserForm from '@/Forms/UserForm.vue';

const props = defineProps<{
    user: User;
    provinces: Province[];
    roles: Role[];
}>();

const user = props.user;
const pageTitle = computed(() => `Kullanıcıyı Düzenle #${user.id}`);
const breadcrumbItems = [{title: 'Kullanıcılar', href: route('admin.user.list')}];

const form = useForm<UserFormType>({
    username: user.username,
    email: user.email,
    phone: user.phone,
    password: '',
    password_confirmation: '',
    name: user.profile?.name ?? '',
    surname: user.profile?.surname ?? '',
    company: user.profile?.company ?? '',
    company_phone: user.profile?.company_phone ?? '',
    address: user.profile?.address ?? '',
    tax_identity: user.profile?.tax_identity ?? '',
    province_id: user.profile?.province_id ?? 0,
    district_id: user.profile?.district_id ?? 0,
    role_id: user.role_id,
});

function submit() {
    form.post(route('admin.user.update', {id: user.id}));
}
</script>

<template>
    <DashboardLayout :breadcrumbItems :title="pageTitle">
        <UserForm :form :provinces :roles @submit.prevent="submit" />
    </DashboardLayout>
</template>
