<script lang="ts" setup>
import {Neighborhood} from '@/types/model';
import DashboardLayout from '@/Layouts/DashboardLayout.vue';
import DeleteButton from '@/Components/DeleteButton.vue';
import BasicTable from '@/Components/Table/BasicTable.vue';
import VButton from '@/Components/VButton.vue';
import PenSquareIcon from '@/Icons/PenSquareIcon.vue';

defineProps<{
    neighborhoods: Neighborhood[];
}>();
</script>

<template>
    <DashboardLayout title="Mahalleler">
        <div class="mb-3 text-end">
            <VButton :href="route('admin.neighborhood.create')">Mahalle Ekle</VButton>
        </div>

        <BasicTable>
            <template #head>
                <tr>
                    <th>#</th>
                    <th>İl</th>
                    <th>İlçe</th>
                    <th>Mahalle</th>
                    <th>Başlık</th>
                    <th>İşlemler</th>
                </tr>
            </template>
            <template #default>
                <tr v-for="neighborhood in neighborhoods" :key="neighborhood.id">
                    <td>{{ neighborhood.id }}</td>
                    <td>{{ neighborhood?.district?.province?.name }}</td>
                    <td>{{ neighborhood?.district?.name }}</td>
                    <td>{{ neighborhood.name }}</td>
                    <td>{{ neighborhood.title }}</td>
                    <td>
                        <div class="flex flex-wrap gap-3">
                            <DeleteButton
                                :href="route('admin.neighborhood.destroy', {id: neighborhood.id})"
                            />
                            <VButton
                                :href="route('admin.neighborhood.edit', {id: neighborhood.id})"
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
