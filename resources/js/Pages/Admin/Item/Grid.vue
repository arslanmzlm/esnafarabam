<script lang="ts" setup>
import {Item} from '@/types/model';
import DashboardLayout from '@/Layouts/DashboardLayout.vue';
import {currencyFormat} from '@/Utilities/Formatters';

defineProps<{
    items: Item[];
}>();
</script>

<template>
    <DashboardLayout title="İlanlar">
        <div class="grid gap-4 lg:grid-cols-5">
            <a
                v-for="item in items"
                :key="item.id"
                :href="route('admin.item.show', {id: item.id})"
                class="item-card group col-span-1 rounded border border-stroke bg-white shadow-sm"
            >
                <div class="item-card-cover overflow-hidden rounded">
                    <img
                        v-if="item.cover"
                        :alt="item.title"
                        :src="item.cover.src"
                        class="aspect-4/3 w-full rounded object-cover transition-transform duration-300 group-hover:scale-110"
                    />
                </div>

                <div class="space-y-1 rounded-b p-3">
                    <div class="item-card-province-name text-sm text-graydark">
                        {{ item.province?.name }}
                    </div>
                    <div
                        :title="item.vehicle?.title"
                        class="item-card-vehicle-title line-clamp-1 font-medium text-black"
                    >
                        {{ item.vehicle?.title }}
                    </div>
                    <div
                        class="item-card-vehicle-attributes flex flex-wrap gap-2 text-sm text-graydark"
                    >
                        <span class="item-card-vehicle-year">
                            {{ item.vehicle?.year }}
                        </span>
                        <span class="item-card-vehicle-fuel">
                            {{ item.vehicle?.fuel_label }}
                        </span>
                        <span class="item-card-vehicle-gear">
                            {{ item.vehicle?.gear_label }}
                        </span>
                    </div>
                    <div class="item-card-price font-bold text-primary">
                        {{ currencyFormat(item.price) }}
                    </div>
                </div>
            </a>
        </div>
    </DashboardLayout>
</template>

<style>
.item-card-vehicle-attributes > *:not(:last-child):after {
    content: '|';
    margin-left: 0.5rem;
}
</style>
