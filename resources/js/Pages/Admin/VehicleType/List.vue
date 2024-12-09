<script lang="ts" setup>
import {VehicleType} from '@/types/model';
import DashboardLayout from '@/Layouts/DashboardLayout.vue';
import Badge from '@/Components/Badge.vue';
import DeleteButton from '@/Components/DeleteButton.vue';
import BasicTable from '@/Components/Table/BasicTable.vue';
import VButton from '@/Components/VButton.vue';
import PenSquareIcon from '@/Icons/PenSquareIcon.vue';

defineProps<{
    vehicleTypes: VehicleType[];
}>();
</script>

<template>
    <DashboardLayout title="Taşıt Türleri">
        <div class="mb-3 text-end">
            <VButton :href="route('admin.vehicle.type.create')">Tür Ekle</VButton>
        </div>

        <BasicTable>
            <template #head>
                <tr>
                    <th>#</th>
                    <th class="w-0"></th>
                    <th>Tür</th>
                    <th>Durum</th>
                    <th>Sıra</th>
                    <th>Taşıt Sayısı</th>
                    <th>İlan Sayısı</th>
                    <th>İşlemler</th>
                </tr>
            </template>
            <template #default>
                <tr v-for="(vehicleType, index) in vehicleTypes" :key="index">
                    <td>{{ vehicleType.id }}</td>
                    <td>
                        <img
                            v-if="vehicleType.logo && vehicleType.logo_src"
                            :src="vehicleType.logo_src"
                            alt="Taşıt Türü Logosu"
                            class="max-h-16 max-w-50"
                        />
                    </td>
                    <td>{{ vehicleType.name }}</td>
                    <td>
                        <Badge :type="vehicleType.active ? 'success' : 'error'"
                            >{{ vehicleType.active ? 'Aktif' : 'Pasif' }}
                        </Badge>
                    </td>
                    <td>{{ vehicleType.order }}</td>
                    <td></td>
                    <td>0</td>
                    <td>
                        <div class="flex flex-wrap gap-3">
                            <DeleteButton
                                :href="route('admin.vehicle.type.destroy', {id: vehicleType.id})"
                            />
                            <VButton
                                :href="route('admin.vehicle.type.edit', {id: vehicleType.id})"
                                icon
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
