<script lang="ts" setup>
import {Banner} from '@/types/model';
import DashboardLayout from '@/Layouts/DashboardLayout.vue';
import Badge from '@/Components/Badge.vue';
import DeleteButton from '@/Components/DeleteButton.vue';
import BasicTable from '@/Components/Table/BasicTable.vue';
import VButton from '@/Components/VButton.vue';
import PenSquareIcon from '@/Icons/PenSquareIcon.vue';

defineProps<{
    banners: Banner[];
}>();
</script>

<template>
    <DashboardLayout title="Bannerlar">
        <div class="mb-3 text-end">
            <VButton :href="route('admin.banner.create')">Banner Ekle</VButton>
        </div>

        <BasicTable>
            <template #head>
                <tr>
                    <th>#</th>
                    <th class="w-0"></th>
                    <th>Alan</th>
                    <th>Başlık</th>
                    <th>Durum</th>
                    <th>İşlemler</th>
                </tr>
            </template>
            <template #default>
                <tr v-for="(banner, index) in banners" :key="index">
                    <td>{{ banner.id }}</td>
                    <td>
                        <img
                            v-if="banner.image && banner.image_src"
                            :src="banner.image_src"
                            alt="Görsel"
                            class="mx-auto max-h-16 max-w-50"
                        />
                    </td>
                    <td>{{ banner.field_label }}</td>
                    <td>{{ banner.title }}</td>
                    <td>
                        <Badge :type="banner.active ? 'success' : 'error'"
                            >{{ banner.active ? 'Aktif' : 'Pasif' }}
                        </Badge>
                    </td>
                    <td>
                        <div class="flex flex-wrap gap-3">
                            <DeleteButton :href="route('admin.banner.destroy', {id: banner.id})" />

                            <VButton :href="route('admin.banner.edit', {id: banner.id})" icon>
                                <PenSquareIcon class="size-5" />
                            </VButton>
                        </div>
                    </td>
                </tr>
            </template>
        </BasicTable>
    </DashboardLayout>
</template>
