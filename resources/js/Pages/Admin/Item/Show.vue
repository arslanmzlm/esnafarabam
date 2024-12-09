<script lang="ts" setup>
import {isArray} from 'lodash';
import {computed, ref} from 'vue';
import {Item} from '@/types/model';
import {AttributeViewResponse} from '@/types/response';
import DashboardLayout from '@/Layouts/DashboardLayout.vue';
import Card from '@/Components/Card.vue';
import CarDashboardIcon from '@/Icons/CarDashboardIcon.vue';
import CaretLeftIcon from '@/Icons/CaretLeftIcon.vue';
import CaretRightIcon from '@/Icons/CaretRightIcon.vue';
import CarInfoIcon from '@/Icons/CarInfoIcon.vue';
import GasStationIcon from '@/Icons/GasStationIcon.vue';
import GearShiftIcon from '@/Icons/GearShiftIcon.vue';
import {
    currencyFormat,
    dateFormat,
    enginePowerFormat,
    engineSizeFormat,
    kilometerFormat,
} from '@/Utilities/Formatters';

const props = defineProps<{
    item: Item;
    attributeCategories: AttributeViewResponse[];
}>();

const photoIndex = ref<number>(0);
const thumbnails = ref<HTMLDivElement>();
const thumbnailIndex = ref<number>(0);

const photo = computed(() => {
    return props.item.approved_photos &&
        props.item.approved_photos[photoIndex.value] &&
        props.item.approved_photos[photoIndex.value].file &&
        props.item.approved_photos[photoIndex.value].src
        ? props.item.approved_photos[photoIndex.value].src
        : 'PLACEHOLDER_SRC';
});

function scrollThumbs() {
    if (thumbnails.value) {
        const el = thumbnails.value.children.item(thumbnailIndex.value);

        if (el) {
            el.scrollIntoView({inline: 'start', block: 'nearest', behavior: 'smooth'});
        }
    }
}

function prevThumbs() {
    if (thumbnailIndex.value - 5 < 0) {
        thumbnailIndex.value = 0;
    } else {
        thumbnailIndex.value -= 5;
    }

    scrollThumbs();
}

function nextThumbs() {
    if (thumbnails.value && thumbnailIndex.value + 5 > thumbnails.value.children.length - 1) {
        thumbnailIndex.value = thumbnails.value.children.length - 1;
    } else {
        thumbnailIndex.value += 5;
    }

    scrollThumbs();
}
</script>

<template>
    <DashboardLayout :title="item.title">
        <div class="item-show-page grid gap-4 lg:grid-cols-4">
            <div class="group col-span-2 rounded border border-stroke bg-white shadow-sm">
                <div class="item-show-image">
                    <img :alt="item.title" :src="photo" class="h-125 w-full object-contain" />
                </div>

                <div class="relative">
                    <div ref="thumbnails" class="flex overflow-hidden px-4 py-2">
                        <button
                            v-for="(photo, index) in item.approved_photos"
                            :key="photo.id"
                            class="w-1/5 shrink-0"
                            type="button"
                            @click="photoIndex = index"
                        >
                            <img
                                :alt="item.title"
                                :class="index === photoIndex ? 'border-primary' : 'border-stroke'"
                                :src="photo.src"
                                class="mx-auto h-20 border-2 object-cover"
                            />
                        </button>
                    </div>

                    <button
                        :class="thumbnailIndex === 0 && 'hidden'"
                        :disabled="thumbnailIndex === 0"
                        class="absolute inset-y-0 left-0 bg-black bg-opacity-70 px-1 text-white opacity-0 transition-opacity duration-300 hover:bg-opacity-90 group-hover:opacity-100"
                        @click="prevThumbs"
                    >
                        <CaretLeftIcon class="size-5 fill-current" />
                    </button>

                    <button
                        :class="
                            thumbnails &&
                            thumbnailIndex + 5 > thumbnails.children.length - 1 &&
                            'hidden'
                        "
                        :disabled="
                            thumbnails && thumbnailIndex + 5 > thumbnails.children.length - 1
                        "
                        class="absolute inset-y-0 right-0 bg-black bg-opacity-70 px-1 text-white opacity-0 transition-opacity duration-300 hover:bg-opacity-90 group-hover:opacity-100"
                        @click="nextThumbs"
                    >
                        <CaretRightIcon class="size-5 fill-current" />
                    </button>
                </div>
            </div>
            <div class="col-span-1 space-y-4 rounded border border-stroke bg-white pb-5 shadow-sm">
                <div
                    class="rounded-t bg-primary p-5 text-center text-title-sm font-bold text-white"
                >
                    {{ currencyFormat(item.price) }}
                </div>
                <div class="item-page-vehicle-attributes">
                    <div class="flex justify-between gap-2 border-b border-stroke p-3">
                        <span><b>İlan No</b></span>
                        <span>{{ item.id }}</span>
                    </div>
                    <div class="flex justify-between gap-2 border-b border-stroke p-3">
                        <span><b>İlan Tarihi</b></span>
                        <span>{{ dateFormat(item.created_at) }}</span>
                    </div>
                    <div class="flex justify-between gap-2 border-b border-stroke p-3">
                        <span><b>Marka</b></span>
                        <span :title="item?.vehicle?.brand?.name" class="line-clamp-1">{{
                            item?.vehicle?.brand?.name
                        }}</span>
                    </div>
                    <div class="flex justify-between gap-2 border-b border-stroke p-3">
                        <span><b>Model</b></span>
                        <span :title="item?.vehicle?.title" class="line-clamp-1">{{
                            item?.vehicle?.title
                        }}</span>
                    </div>
                    <div class="flex justify-between gap-2 border-b border-stroke p-3">
                        <span><b>Yakıt Tipi</b></span>
                        <span>{{ item?.vehicle?.fuel_label }}</span>
                    </div>
                    <div class="flex justify-between gap-2 border-b border-stroke p-3">
                        <span><b>Vites Tipi</b></span>
                        <span>{{ item?.vehicle?.gear_label }}</span>
                    </div>
                    <div class="flex justify-between gap-2 border-b border-stroke p-3">
                        <span><b>Model Yılı</b></span>
                        <span>{{ item?.vehicle?.year }}</span>
                    </div>
                    <div class="flex justify-between gap-2 border-b border-stroke p-3">
                        <span><b>Kilometre</b></span>
                        <span>{{ kilometerFormat(item.kilometer) }}</span>
                    </div>
                    <div
                        v-if="item.vehicle"
                        class="flex justify-between gap-2 border-b border-stroke p-3"
                    >
                        <span><b>Motor Gücü</b></span>
                        <span>{{ enginePowerFormat(item?.vehicle?.engine_power) }}</span>
                    </div>
                    <div v-if="item.vehicle" class="flex justify-between p-3">
                        <span><b>Motor Hacmi</b></span>
                        <span>{{ engineSizeFormat(item?.vehicle?.engine_size) }}</span>
                    </div>
                </div>
            </div>
            <div
                class="col-span-1 space-y-4 rounded border border-stroke bg-white pb-5 shadow-sm"
            ></div>
            <div class="col-span-3 space-y-4">
                <Card v-if="item.vehicle" title="Araç Özeti">
                    <div class="flex flex-wrap gap-6 dark:bg-form-strokedark">
                        <div class="flex gap-4">
                            <img
                                v-if="item.vehicle.brand?.logo && item.vehicle.brand.logo_src"
                                :alt="item.vehicle.brand.name"
                                :src="item.vehicle.brand.logo_src"
                                class="h-20"
                            />
                        </div>
                        <div class="hidden w-[2px] bg-stroke lg:block"></div>
                        <div class="flex gap-10 self-center">
                            <div class="flex items-center gap-3">
                                <CarInfoIcon class="size-12" />
                                <div>
                                    <div class="font-bold text-primary">Model Yılı</div>
                                    <div class="font-bold">{{ item.vehicle.year }}</div>
                                </div>
                            </div>

                            <div class="flex items-center gap-3">
                                <GasStationIcon class="size-12" />
                                <div>
                                    <div class="font-bold text-primary">Yakıt Tipi</div>
                                    <div class="font-bold">{{ item.vehicle.fuel_label }}</div>
                                </div>
                            </div>

                            <div class="flex items-center gap-3">
                                <GearShiftIcon class="size-12" />
                                <div>
                                    <div class="font-bold text-primary">Vites Tipi</div>
                                    <div class="font-bold">{{ item.vehicle.gear_label }}</div>
                                </div>
                            </div>

                            <div class="flex items-center gap-3">
                                <CarDashboardIcon class="size-12" />
                                <div>
                                    <div class="font-bold text-primary">Kilometre</div>
                                    <div class="font-bold">
                                        {{ kilometerFormat(item.kilometer) }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </Card>

                <Card
                    v-for="(item, categoryIndex) in attributeCategories"
                    :key="categoryIndex"
                    :title="item.categoryName"
                >
                    <table
                        v-if="
                            item.tableAttributes &&
                            isArray(item.tableAttributes) &&
                            item.tableAttributes.length
                        "
                        class="attribute-table"
                    >
                        <tbody>
                            <tr v-for="(attribute, index) in item.tableAttributes" :key="index">
                                <td class="w-1/5">
                                    {{ attribute.name }}
                                </td>
                                <td class="font-medium">
                                    {{ attribute.value }}
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <div
                        v-for="(attribute, index) in item.checkboxAttributes"
                        v-else-if="item.checkboxAttributes"
                        :key="index"
                    >
                        <div class="font-semibold">{{ attribute.name }}</div>
                        <div class="mt-3 flex flex-wrap gap-4">
                            <span
                                v-for="(value, valueIndex) in attribute.value"
                                :key="valueIndex"
                                class="rounded-md border border-stroke p-2 text-sm font-medium"
                                >{{ value }}</span
                            >
                        </div>
                    </div>
                </Card>
            </div>
        </div>
    </DashboardLayout>
</template>

<style>
.item-show-page {
    @apply text-black dark:text-white;
}

.attribute-table {
    @apply w-full;
}

.attribute-table tbody tr td {
    @apply p-2 text-sm;
}

.attribute-table tbody tr:nth-child(2n + 1) td {
    @apply bg-slate-100;
}
</style>
