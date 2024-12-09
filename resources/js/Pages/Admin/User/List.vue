<script lang="ts" setup>
import {User} from '@/types/model';
import DashboardLayout from '@/Layouts/DashboardLayout.vue';
import DeleteButton from '@/Components/DeleteButton.vue';
import BasicTable from '@/Components/Table/BasicTable.vue';
import VButton from '@/Components/VButton.vue';
import PenSquareIcon from '@/Icons/PenSquareIcon.vue';

defineProps<{
    users: User[];
}>();
</script>

<template>
    <DashboardLayout title="Kullanıcılar">
        <div class="mb-3 text-end">
            <VButton :href="route('admin.user.create')">Kullanıcı Ekle</VButton>
        </div>

        <BasicTable>
            <template #head>
                <tr>
                    <th>#</th>
                    <th>Kullanıcı Adı</th>
                    <th>E-Posta Adresi</th>
                    <th>Telefon Numarası</th>
                    <th>İşlemler</th>
                </tr>
            </template>
            <template #default>
                <tr v-for="user in users" :key="user.id">
                    <td>{{ user.id }}</td>
                    <td>{{ user.username }}</td>
                    <td>{{ user.email }}</td>
                    <td>{{ user.phone_formatted ?? user.phone }}</td>
                    <td>
                        <div class="flex flex-wrap gap-3">
                            <DeleteButton :href="route('admin.user.destroy', {id: user.id})" />
                            <VButton :href="route('admin.user.edit', {id: user.id})" icon>
                                <PenSquareIcon class="size-5" />
                            </VButton>
                        </div>
                    </td>
                </tr>
            </template>
        </BasicTable>
    </DashboardLayout>
</template>
