<script lang="ts" setup>
import {Vehicle} from '@/types/model';
import DashboardLayout from '@/Layouts/DashboardLayout.vue';
import Badge from '@/Components/Badge.vue';
import DeleteButton from '@/Components/DeleteButton.vue';
import BasicTable from '@/Components/Table/BasicTable.vue';
import VButton from '@/Components/VButton.vue';
import PenSquareIcon from '@/Icons/PenSquareIcon.vue';

defineProps<{
    vehicles: Vehicle[];
}>();
</script>

<template>
    <DashboardLayout title="Taşıtlar">
        <div class="mb-3 text-end">
            <VButton :href="route('admin.vehicle.create')">Taşıt Ekle</VButton>
        </div>

        <BasicTable>
            <template #head>
                <tr>
                    <th>#</th>
                    <th>Taşıt Türü</th>
                    <th>Başlık</th>
                    <th>Yıl</th>
                    <th>Durum</th>
                    <th>İşlemler</th>
                </tr>
            </template>
            <template #default>
                <tr v-for="vehicle in vehicles" :key="vehicle.id">
                    <td>{{ vehicle.id }}</td>
                    <td>{{ vehicle?.type?.name }}</td>
                    <td>{{ vehicle.title }}</td>
                    <td>{{ vehicle.year }}</td>
                    <td>
                        <Badge :type="vehicle.active ? 'success' : 'error'"
                            >{{ vehicle.active ? 'Aktif' : 'Pasif' }}
                        </Badge>
                    </td>
                    <td>
                        <div class="flex flex-wrap gap-3">
                            <DeleteButton
                                :href="route('admin.vehicle.destroy', {id: vehicle.id})"
                                title="Aracı Sil"
                            />
                            <VButton
                                :href="route('admin.vehicle.edit', {id: vehicle.id})"
                                icon
                                title="Aracı Düzenle"
                            >
                                <PenSquareIcon class="size-5" />
                            </VButton>
                        </div>
                    </td>
                </tr>
            </template>
        </BasicTable>
    </DashboardLayout>
</template>
