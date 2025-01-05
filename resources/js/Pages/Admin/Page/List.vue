<script lang="ts" setup>
import {Page} from '@/types/model';
import DashboardLayout from '@/Layouts/DashboardLayout.vue';
import Badge from '@/Components/Badge.vue';
import DeleteButton from '@/Components/DeleteButton.vue';
import BasicTable from '@/Components/Table/BasicTable.vue';
import VButton from '@/Components/VButton.vue';
import PenSquareIcon from '@/Icons/PenSquareIcon.vue';

defineProps<{
    pages: Page[];
}>();
</script>

<template>
    <DashboardLayout title="Sayfalar">
        <div class="mb-3 text-end">
            <VButton :href="route('admin.page.create')">Sayfa Ekle</VButton>
        </div>

        <BasicTable>
            <template #head>
                <tr>
                    <th>#</th>
                    <th>Kategori</th>
                    <th>Başlık</th>
                    <th>Durum</th>
                    <th>İşlemler</th>
                </tr>
            </template>
            <template #default>
                <tr v-for="(page, index) in pages" :key="index">
                    <td>{{ page.id }}</td>
                    <td>{{ page.category_label }}</td>
                    <td>{{ page.title }}</td>
                    <td>
                        <Badge :type="page.active ? 'success' : 'error'"
                            >{{ page.active ? 'Aktif' : 'Pasif' }}
                        </Badge>
                    </td>
                    <td>
                        <div class="flex flex-wrap gap-3">
                            <DeleteButton :href="route('admin.page.destroy', {id: page.id})" />

                            <VButton :href="route('admin.page.edit', {id: page.id})" icon>
                                <PenSquareIcon class="size-5" />
                            </VButton>
                        </div>
                    </td>
                </tr>
            </template>
        </BasicTable>
    </DashboardLayout>
</template>
