<script lang="ts" setup>
import {Brand} from '@/types/model';
import DashboardLayout from '@/Layouts/DashboardLayout.vue';
import Badge from '@/Components/Badge.vue';
import DeleteButton from '@/Components/DeleteButton.vue';
import BasicTable from '@/Components/Table/BasicTable.vue';
import VButton from '@/Components/VButton.vue';
import PenSquareIcon from '@/Icons/PenSquareIcon.vue';

defineProps<{
    brands: Brand[];
}>();
</script>

<template>
    <DashboardLayout title="Markalar">
        <div class="mb-3 text-end">
            <VButton :href="route('admin.brand.create')">Marka Ekle</VButton>
        </div>

        <BasicTable>
            <template #head>
                <tr>
                    <th>#</th>
                    <th class="w-0"></th>
                    <th>Marka</th>
                    <th>Durum</th>
                    <th>Sıra</th>
                    <th>Taşıt Sayısı</th>
                    <th>İşlemler</th>
                </tr>
            </template>
            <template #default>
                <tr v-for="(brand, index) in brands" :key="index">
                    <td>{{ brand.id }}</td>
                    <td>
                        <img
                            v-if="brand.logo && brand.logo_src"
                            :src="brand.logo_src"
                            alt="Firma Logosu"
                            class="max-h-16 max-w-50"
                        />
                    </td>
                    <td>{{ brand.name }}</td>
                    <td>
                        <Badge :type="brand.active ? 'success' : 'error'"
                            >{{ brand.active ? 'Aktif' : 'Pasif' }}
                        </Badge>
                    </td>
                    <td>{{ brand.order }}</td>
                    <td>{{ brand.vehicles_count }}</td>
                    <td>
                        <div class="flex flex-wrap gap-3">
                            <DeleteButton :href="route('admin.brand.destroy', {id: brand.id})" />
                            <VButton :href="route('admin.brand.edit', {id: brand.id})" icon>
                                <PenSquareIcon class="size-5" />
                            </VButton>
                        </div>
                    </td>
                </tr>
            </template>
        </BasicTable>
    </DashboardLayout>
</template>
