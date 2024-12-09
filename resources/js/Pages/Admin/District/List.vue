<script lang="ts" setup>
import {District} from '@/types/model';
import DashboardLayout from '@/Layouts/DashboardLayout.vue';
import DeleteButton from '@/Components/DeleteButton.vue';
import BasicTable from '@/Components/Table/BasicTable.vue';
import VButton from '@/Components/VButton.vue';
import PenSquareIcon from '@/Icons/PenSquareIcon.vue';

defineProps<{
    districts: District[];
}>();
</script>

<template>
    <DashboardLayout title="İlçeler">
        <div class="mb-3 text-end">
            <VButton :href="route('admin.district.create')">İlçe Ekle</VButton>
        </div>

        <BasicTable>
            <template #head>
                <tr>
                    <th>#</th>
                    <th>İl</th>
                    <th>İlçe</th>
                    <th>Başlık</th>
                    <th>İşlemler</th>
                </tr>
            </template>
            <template #default>
                <tr v-for="district in districts" :key="district.id">
                    <td>{{ district.id }}</td>
                    <td>{{ district?.province?.name }}</td>
                    <td>{{ district.name }}</td>
                    <td>{{ district.title }}</td>
                    <td>
                        <div class="flex flex-wrap gap-3">
                            <DeleteButton
                                :href="route('admin.district.destroy', {id: district.id})"
                            />
                            <VButton :href="route('admin.district.edit', {id: district.id})" icon>
                                <PenSquareIcon class="size-5" />
                            </VButton>
                        </div>
                    </td>
                </tr>
            </template>
        </BasicTable>
    </DashboardLayout>
</template>
