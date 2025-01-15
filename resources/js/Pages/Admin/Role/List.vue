<script lang="ts" setup>
import {Role} from '@/types/model';
import DashboardLayout from '@/Layouts/DashboardLayout.vue';
import DeleteButton from '@/Components/DeleteButton.vue';
import BasicTable from '@/Components/Table/BasicTable.vue';
import VButton from '@/Components/VButton.vue';
import PenSquareIcon from '@/Icons/PenSquareIcon.vue';

defineProps<{
    roles: Role[];
}>();
</script>

<template>
    <DashboardLayout title="Yetkiler">
        <div class="mb-3 text-end">
            <VButton :href="route('admin.role.create')">Yetki Ekle</VButton>
        </div>

        <BasicTable>
            <template #head>
                <tr>
                    <th>#</th>
                    <th>Yetki</th>
                    <th>Admin</th>
                    <th>İşlemler</th>
                </tr>
            </template>
            <template #default>
                <tr v-for="(role, index) in roles" :key="index">
                    <td>{{ role.id }}</td>
                    <td>{{ role.name }}</td>
                    <td>{{ role.admin ? 'Evet' : 'Hayır' }}</td>
                    <td>
                        <div class="flex flex-wrap gap-3">
                            <DeleteButton :href="route('admin.role.destroy', {id: role.id})" />

                            <VButton :href="route('admin.role.edit', {id: role.id})" icon>
                                <PenSquareIcon class="size-5" />
                            </VButton>
                        </div>
                    </td>
                </tr>
            </template>
        </BasicTable>
    </DashboardLayout>
</template>
