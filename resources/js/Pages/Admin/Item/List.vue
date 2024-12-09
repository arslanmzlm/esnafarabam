<script lang="ts" setup>
import {Item} from '@/types/model';
import DashboardLayout from '@/Layouts/DashboardLayout.vue';
import Badge from '@/Components/Badge.vue';
import DeleteButton from '@/Components/DeleteButton.vue';
import BasicTable from '@/Components/Table/BasicTable.vue';
import VButton from '@/Components/VButton.vue';
import GridSearchIcon from '@/Icons/GridSearchIcon.vue';
import PenSquareIcon from '@/Icons/PenSquareIcon.vue';
import {currencyFormat, dateTimeFormat, kilometerFormat} from '@/Utilities/Formatters';

defineProps<{
    items: Item[];
}>();
</script>

<template>
    <DashboardLayout title="İlanlar">
        <div class="mb-3 text-end">
            <VButton :href="route('admin.vehicle.select')">Taşıt Seçimi</VButton>
        </div>

        <BasicTable>
            <template #head>
                <tr>
                    <th>#</th>
                    <th>Başlık</th>
                    <th>Durum</th>
                    <th>Taşıt</th>
                    <th>Fiyat</th>
                    <th>Kilometre</th>
                    <th>Oluşturulma Tarihi</th>
                    <th>Son Güncellenme Tarihi</th>
                    <th>İşlemler</th>
                </tr>
            </template>
            <template #default>
                <tr v-for="item in items" :key="item.id">
                    <td>{{ item.id }}</td>
                    <td>{{ item.title }}</td>
                    <td>
                        <Badge>{{ item.state_label }}</Badge>
                    </td>
                    <td>{{ item?.vehicle?.title }}</td>
                    <td>{{ currencyFormat(item.price) }}</td>
                    <td>{{ kilometerFormat(item.kilometer) }}</td>
                    <td>{{ dateTimeFormat(item.created_at) }}</td>
                    <td>{{ dateTimeFormat(item.updated_at) }}</td>
                    <td>
                        <div class="flex flex-wrap gap-3">
                            <DeleteButton
                                :href="route('admin.item.destroy', {id: item.id})"
                                title="İlanı Sil"
                            />
                            <VButton
                                :href="route('admin.item.edit', {id: item.id})"
                                icon
                                title="İlanı Düzenle"
                            >
                                <PenSquareIcon class="size-5" />
                            </VButton>
                            <VButton
                                :href="route('admin.item.control', {id: item.id})"
                                icon
                                theme="info"
                                title="İlanı İncele"
                            >
                                <GridSearchIcon class="size-5" />
                            </VButton>
                        </div>
                    </td>
                </tr>
            </template>
        </BasicTable>
    </DashboardLayout>
</template>
