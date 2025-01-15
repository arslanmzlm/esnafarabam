<script lang="ts" setup>
import {useForm} from '@inertiajs/vue3';
import {computed} from 'vue';
import {RoleFormType} from '@/types/form';
import {Ability, Role} from '@/types/model';
import DashboardLayout from '@/Layouts/DashboardLayout.vue';
import RoleForm from '@/Forms/RoleForm.vue';

const props = defineProps<{
    role: Role;
    roleAbilities: number[];
    abilities: Ability[];
}>();

const role = props.role;

const pageTitle = computed(() => `Yetki Düzenle #${role.id}`);
const breadcrumbItems = [{title: 'Yetkiler', href: route('admin.role.list')}];

const form = useForm<RoleFormType>({
    name: role.name,
    admin: role.admin,
    abilities: props.roleAbilities,
});

function submit() {
    form.post(route('admin.role.update', {id: role.id}));
}
</script>

<template>
    <DashboardLayout :breadcrumbItems :title="pageTitle">
        <RoleForm :abilities :form @submit.prevent="submit" />
    </DashboardLayout>
</template>
