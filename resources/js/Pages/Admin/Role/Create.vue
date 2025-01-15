<script lang="ts" setup>
import {useForm} from '@inertiajs/vue3';
import {RoleFormType} from '@/types/form';
import {Ability} from '@/types/model';
import DashboardLayout from '@/Layouts/DashboardLayout.vue';
import RoleForm from '@/Forms/RoleForm.vue';

defineProps<{
    abilities: Ability[];
}>();

const breadcrumbItems = [{title: 'Yetkiler', href: route('admin.role.list')}];

const form = useForm<RoleFormType>({
    name: '',
    admin: false,
    abilities: [],
});

function submit() {
    form.post(route('admin.role.store'));
}
</script>

<template>
    <DashboardLayout :breadcrumbItems title="Yetki Oluştur">
        <RoleForm :abilities :form @submit.prevent="submit" />
    </DashboardLayout>
</template>
