<script lang="ts" setup>
import {AttributeCategory} from '@/types/model';
import DashboardLayout from '@/Layouts/DashboardLayout.vue';
import DeleteButton from '@/Components/DeleteButton.vue';
import BasicTable from '@/Components/Table/BasicTable.vue';
import VButton from '@/Components/VButton.vue';
import PenSquareIcon from '@/Icons/PenSquareIcon.vue';
import SlidersHorizontalIcon from '@/Icons/SlidersHorizontalIcon.vue';

defineProps<{
    categories: AttributeCategory[];
}>();
</script>

<template>
    <DashboardLayout title="Özellik Kategorileri">
        <div class="mb-3 text-end">
            <VButton :href="route('admin.attribute.category.create')">Kategori Ekle</VButton>
        </div>

        <BasicTable>
            <template #head>
                <tr>
                    <th>#</th>
                    <th>Kategori</th>
                    <th>Alan</th>
                    <th>Taşıt Türü</th>
                    <th>Sıra</th>
                    <th>Özellik Sayısı</th>
                    <th>İşlemler</th>
                </tr>
            </template>
            <template #default>
                <tr v-for="category in categories" :key="category.id">
                    <td>{{ category.id }}</td>
                    <td>{{ category.name }}</td>
                    <td>{{ category.type_label }}</td>
                    <td>{{ category?.vehicle_type?.name ?? 'Genel' }}</td>
                    <td>{{ category.order }}</td>
                    <td>{{ category.attributes_count }}</td>
                    <td>
                        <div class="flex flex-wrap gap-3">
                            <DeleteButton
                                :href="route('admin.attribute.category.destroy', {id: category.id})"
                            />

                            <VButton
                                :href="route('admin.attribute.category.edit', {id: category.id})"
                                icon
                                title="Kategoriyi Düzenle"
                            >
                                <PenSquareIcon class="size-5" />
                            </VButton>

                            <VButton
                                :href="route('admin.attribute.category.items', {id: category.id})"
                                icon
                                theme="info"
                                title="Kategoriye Bağlı Özellikler"
                            >
                                <SlidersHorizontalIcon class="size-5" />
                            </VButton>
                        </div>
                    </td>
                </tr>
            </template>
        </BasicTable>
    </DashboardLayout>
</template>
