<script lang="ts" setup>
import {Attribute} from '@/types/model';
import DashboardLayout from '@/Layouts/DashboardLayout.vue';
import Badge from '@/Components/Badge.vue';
import DeleteButton from '@/Components/DeleteButton.vue';
import BasicTable from '@/Components/Table/BasicTable.vue';
import VButton from '@/Components/VButton.vue';
import PenSquareIcon from '@/Icons/PenSquareIcon.vue';

defineProps<{
    attributes: Attribute[];
}>();
</script>

<template>
    <DashboardLayout title="Özellikler">
        <div class="mb-3 text-end">
            <VButton :href="route('admin.attribute.create')">Özellik Ekle</VButton>
        </div>

        <BasicTable>
            <template #head>
                <tr>
                    <th>#</th>
                    <th>Özellik</th>
                    <th>Kategori (Alan)</th>
                    <th>Durum</th>
                    <th>Birim</th>
                    <th>İşlemler</th>
                </tr>
            </template>
            <template #default>
                <tr v-for="attribute in attributes" :key="attribute.id">
                    <td>{{ attribute.id }}</td>
                    <td>{{ attribute.name }}</td>
                    <td>{{ attribute?.category?.name }} ({{ attribute?.category?.type_label }})</td>
                    <td>
                        <Badge :type="attribute.active ? 'success' : 'error'"
                            >{{ attribute.active ? 'Aktif' : 'Pasif' }}
                        </Badge>
                    </td>
                    <td>{{ attribute.unit }}</td>
                    <td>
                        <div class="flex flex-wrap gap-3">
                            <DeleteButton
                                :href="route('admin.attribute.destroy', {id: attribute.id})"
                            />
                            <VButton :href="route('admin.attribute.edit', {id: attribute.id})" icon>
                                <PenSquareIcon class="size-5" />
                            </VButton>
                        </div>
                    </td>
                </tr>
            </template>
        </BasicTable>
    </DashboardLayout>
</template>
