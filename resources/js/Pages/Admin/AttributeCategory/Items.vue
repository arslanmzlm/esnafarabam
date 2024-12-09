<script lang="ts" setup>
import {AttributeCategory} from '@/types/model';
import DashboardLayout from '@/Layouts/DashboardLayout.vue';
import Badge from '@/Components/Badge.vue';
import DeleteButton from '@/Components/DeleteButton.vue';
import BasicTable from '@/Components/Table/BasicTable.vue';
import VButton from '@/Components/VButton.vue';
import PenSquareIcon from '@/Icons/PenSquareIcon.vue';

defineProps<{
    attributeCategory: AttributeCategory;
}>();
</script>

<template>
    <DashboardLayout title="Özellikler">
        <div class="mb-3 text-end">
            <VButton
                :data="{category_id: attributeCategory.id}"
                :href="route('admin.attribute.create')"
                >Özellik Ekle
            </VButton>
        </div>

        <BasicTable>
            <template #head>
                <tr>
                    <th>#</th>
                    <th>Özellik</th>
                    <th>Birim</th>
                    <th>Durum</th>
                    <th>Zorunluluk</th>
                    <th>Görünürlük</th>
                    <th>Özellik Tipi</th>
                    <th>İşlemler</th>
                </tr>
            </template>
            <template #default>
                <tr v-for="attribute in attributeCategory.attributes" :key="attribute.id">
                    <td>{{ attribute.id }}</td>
                    <td>{{ attribute.name }}</td>
                    <td>{{ attribute.unit }}</td>
                    <td>
                        <Badge :type="attribute.active ? 'success' : 'error'"
                            >{{ attribute.active ? 'Aktif' : 'Pasif' }}
                        </Badge>
                    </td>
                    <td>
                        <Badge type="info">{{ attribute.required ? 'Zorunlu' : 'Değil' }}</Badge>
                    </td>
                    <td>
                        <Badge type="warning"
                            >{{ attribute.hidden ? 'Gizli' : 'Herkese Açık' }}
                        </Badge>
                    </td>
                    <td>
                        {{ attribute.input_label }}
                    </td>
                    <td>
                        <div class="flex flex-wrap gap-3">
                            <DeleteButton
                                :href="route('admin.attribute.destroy', {id: attribute.id})"
                            />

                            <VButton
                                :href="route('admin.attribute.edit', {id: attribute.id})"
                                icon
                                title="Özelliği Düzenle"
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
