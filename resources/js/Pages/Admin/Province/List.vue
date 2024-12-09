<script lang="ts" setup>
import {Province} from '@/types/model';
import DashboardLayout from '@/Layouts/DashboardLayout.vue';
import DeleteButton from '@/Components/DeleteButton.vue';
import BasicTable from '@/Components/Table/BasicTable.vue';
import VButton from '@/Components/VButton.vue';
import PenSquareIcon from '@/Icons/PenSquareIcon.vue';

defineProps<{
    provinces: Province[];
}>();
</script>

<template>
    <DashboardLayout title="İller">
        <div class="mb-3 text-end">
            <VButton :href="route('admin.province.create')">İl Ekle</VButton>
        </div>

        <BasicTable>
            <template #head>
                <tr>
                    <th>#</th>
                    <th>İl</th>
                    <th>Kod</th>
                    <th>Başlık</th>
                    <th>İşlemler</th>
                </tr>
            </template>
            <template #default>
                <tr v-for="province in provinces" :key="province.id">
                    <td>{{ province.id }}</td>
                    <td>{{ province.name }}</td>
                    <td>{{ province.code }}</td>
                    <td>{{ province.title }}</td>
                    <td>
                        <div class="flex flex-wrap gap-3">
                            <DeleteButton
                                :href="route('admin.province.destroy', {id: province.id})"
                            />
                            <VButton :href="route('admin.province.edit', {id: province.id})" icon>
                                <PenSquareIcon class="size-5" />
                            </VButton>
                        </div>
                    </td>
                </tr>
            </template>
        </BasicTable>
    </DashboardLayout>
</template>
