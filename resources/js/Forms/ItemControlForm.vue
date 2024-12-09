<script lang="ts" setup>
import {InertiaForm} from '@inertiajs/vue3';
import {PhotoState} from '@/types/enums';
import {ItemControlFormType} from '@/types/form';
import {AttributeCategory, Item, Vehicle} from '@/types/model';
import {AttributeValueResponse, EnumResponse} from '@/types/response';
import AttributeInputPreview from '@/Components/Attribute/AttributeInputPreview.vue';
import Card from '@/Components/Card.vue';
import ReadOnly from '@/Components/Form/ReadOnly.vue';
import SelectBox from '@/Components/Form/SelectBox.vue';
import TextBox from '@/Components/Form/TextBox.vue';
import VButton from '@/Components/VButton.vue';
import CircleCheckIcon from '@/Icons/CircleCheckIcon.vue';
import CircleInformationIcon from '@/Icons/CircleInformationIcon.vue';
import TriangleExclamation from '@/Icons/TriangleExclamation.vue';
import {
    currencyFormat,
    enginePowerFormat,
    engineSizeFormat,
    kilometerFormat,
} from '@/Utilities/Formatters';

const props = defineProps<{
    form: InertiaForm<ItemControlFormType>;
    item: Item;
    states: EnumResponse[];
    vehicle: Vehicle;
    attributeCategories: AttributeCategory[];
    attributeValues: AttributeValueResponse[];
}>();

function getImagePreview(photo: any) {
    if (photo.file instanceof Blob || photo.file instanceof MediaSource) {
        return URL.createObjectURL(photo.file);
    } else if (typeof photo.file === 'string') {
        return photo.src ?? photo.file;
    }
}

function approvePhoto(photo_id: number) {
    if (!props.form.approved_photos.includes(photo_id)) {
        props.form.approved_photos.push(photo_id);
    }

    if (props.form.rejected_photos.includes(photo_id))
        props.form.rejected_photos.splice(
            props.form.rejected_photos.findIndex((id) => id === photo_id),
            1,
        );
    if (props.form.deleted_photos.includes(photo_id))
        props.form.deleted_photos.splice(
            props.form.deleted_photos.findIndex((id) => id === photo_id),
            1,
        );
}

function rejectPhoto(photo_id: number) {
    if (!props.form.rejected_photos.includes(photo_id)) {
        props.form.rejected_photos.push(photo_id);
    }

    if (props.form.approved_photos.includes(photo_id))
        props.form.approved_photos.splice(
            props.form.approved_photos.findIndex((id) => id === photo_id),
            1,
        );
    if (props.form.deleted_photos.includes(photo_id))
        props.form.deleted_photos.splice(
            props.form.deleted_photos.findIndex((id) => id === photo_id),
            1,
        );
}

function deletePhoto(photo_id: number) {
    if (!props.form.deleted_photos.includes(photo_id)) {
        props.form.deleted_photos.push(photo_id);
    }

    if (props.form.approved_photos.includes(photo_id))
        props.form.approved_photos.splice(
            props.form.approved_photos.findIndex((id) => id === photo_id),
            1,
        );
    if (props.form.rejected_photos.includes(photo_id))
        props.form.rejected_photos.splice(
            props.form.rejected_photos.findIndex((id) => id === photo_id),
            1,
        );
}

function getAttributeIndex(attribute_id: number) {
    return props.attributeValues.findIndex((item) => item.attribute_id === attribute_id);
}
</script>

<template>
    <form>
        <div class="space-y-6">
            <Card>
                <div class="text-black dark:text-white">Taşıt</div>
                <div class="rounded bg-stroke p-4 dark:bg-strokedark">
                    <div
                        class="flex flex-wrap justify-between gap-4 rounded bg-white px-4 py-2 dark:bg-form-strokedark dark:text-white"
                    >
                        <div class="flex gap-4">
                            <img
                                v-if="vehicle.brand?.logo && vehicle.brand.logo_src"
                                :src="vehicle.brand.logo_src"
                                alt=""
                                class="h-16"
                            />
                            <div class="flex flex-col justify-between">
                                <div class="font-bold">
                                    {{ vehicle?.type?.name ?? 'Taşıt' }}
                                </div>
                                <div class="font-medium">
                                    {{ vehicle.title }}
                                </div>
                            </div>
                        </div>

                        <div class="hidden w-[2px] bg-stroke dark:bg-strokedark lg:block"></div>

                        <div class="flex gap-10 self-center text-black dark:text-white">
                            <div>{{ vehicle.year }}</div>
                            <div>{{ vehicle.fuel_label }}</div>
                            <div>{{ vehicle.gear_label }}</div>
                            <div>
                                {{ enginePowerFormat(vehicle.engine_power) }}
                            </div>
                            <div>
                                {{ engineSizeFormat(vehicle.engine_size) }}
                            </div>
                        </div>
                    </div>
                </div>
            </Card>

            <Card v-if="item.photos && item.photos.length > 0" title="Görseller">
                <div class="flex flex-wrap gap-4">
                    <div
                        v-for="(photo, index) in item.photos"
                        :key="index"
                        class="flex flex-col items-center justify-center"
                    >
                        <div
                            class="relative rounded border border-stroke p-2 dark:border-strokedark"
                        >
                            <div
                                v-if="photo.order === 1"
                                class="absolute left-1 top-1 z-10 h-7 rounded bg-primary px-3 text-sm leading-7 text-white"
                            >
                                Kapak
                            </div>

                            <div class="absolute right-1 top-1 z-10">
                                <div
                                    v-if="photo.state === PhotoState.APPROVED"
                                    class="grid h-7 place-items-center rounded bg-success px-2 text-white"
                                    title="Onaylanmış"
                                >
                                    <CircleCheckIcon class="size-4" />
                                </div>
                                <div
                                    v-else-if="photo.state === PhotoState.REJECTED"
                                    class="grid h-7 place-items-center rounded bg-warning px-2 text-white"
                                    title="Reddedilmiş"
                                >
                                    <TriangleExclamation class="size-4" />
                                </div>
                                <div
                                    v-else
                                    class="grid h-7 place-items-center rounded bg-info px-2 text-white"
                                    title="İşlem Yapılmamış"
                                >
                                    <CircleInformationIcon class="size-4" />
                                </div>
                            </div>

                            <img :src="getImagePreview(photo)" alt="" class="h-50" />

                            <div class="absolute inset-x-0 bottom-1 z-10 flex justify-center">
                                <div
                                    v-if="form.approved_photos.includes(photo.id)"
                                    class="rounded bg-success p-2 text-sm font-medium text-white"
                                >
                                    Onaylandı
                                </div>

                                <div
                                    v-else-if="form.rejected_photos.includes(photo.id)"
                                    class="rounded bg-warning p-2 text-sm font-medium text-white"
                                >
                                    Reddedildi
                                </div>

                                <div
                                    v-else-if="form.deleted_photos.includes(photo.id)"
                                    class="rounded bg-danger p-2 text-sm font-medium text-white"
                                >
                                    Silindi
                                </div>
                            </div>
                        </div>
                        <div class="mt-2 flex flex-wrap gap-3">
                            <VButton size="xs" theme="danger" @click="deletePhoto(photo.id)"
                                >Sil
                            </VButton>

                            <VButton size="xs" theme="success" @click="approvePhoto(photo.id)"
                                >Onayla
                            </VButton>

                            <VButton size="xs" theme="warning" @click="rejectPhoto(photo.id)"
                                >Reddet
                            </VButton>
                        </div>
                    </div>
                </div>
                <div
                    class="flex flex-wrap items-center gap-4 border-t border-stroke pt-4 dark:border-strokedark"
                >
                    <div>
                        <span
                            class="inline-flex h-7 place-items-center rounded bg-info px-2 text-white"
                        >
                            <CircleInformationIcon class="size-4" />
                        </span>
                        İşlem Yapılmamış
                    </div>

                    <div>
                        <span
                            class="inline-flex h-7 place-items-center rounded bg-success px-2 text-white"
                        >
                            <CircleCheckIcon class="size-4" />
                        </span>
                        Onaylanmış
                    </div>

                    <div>
                        <span
                            class="inline-flex h-7 place-items-center rounded bg-warning px-2 text-white"
                        >
                            <TriangleExclamation class="size-4" />
                        </span>
                        Reddedilmiş
                    </div>
                </div>
            </Card>

            <Card title="İlan Bilgileri">
                <div class="grid grid-cols-1 gap-4 xl:grid-cols-2">
                    <ReadOnly :value="currencyFormat(item.price)" label="Fiyat" />

                    <ReadOnly :value="kilometerFormat(item.kilometer)" label="Kilometre" />
                </div>

                <ReadOnly :value="item.title" label="İlan Başlığı" />

                <div class="mb-3 text-sm font-medium text-black dark:text-white">Açıklama</div>

                <div
                    class="item-description space-y-4 rounded border border-stroke p-2 dark:border-strokedark"
                    v-html="item.description"
                />
            </Card>

            <Card title="Adres">
                <div class="grid grid-cols-1 gap-4 xl:grid-cols-3">
                    <ReadOnly v-if="item.province" :value="item.province.name" label="İl" />

                    <ReadOnly v-if="item.district" :value="item.district.name" label="İlçe" />

                    <ReadOnly
                        v-if="item.neighborhood"
                        :value="item.neighborhood.name"
                        label="Mahalle"
                    />
                </div>
            </Card>

            <Card
                v-for="(attributeCategory, categoryIndex) in attributeCategories"
                :key="categoryIndex"
                :title="attributeCategory.name"
            >
                <div class="grid grid-cols-1 gap-4 xl:grid-cols-3">
                    <AttributeInputPreview
                        v-for="(attribute, index) in attributeCategory.attributes"
                        :key="index"
                        :attribute
                        :value="attributeValues[getAttributeIndex(attribute.id)].value"
                    />
                </div>
            </Card>

            <Card title="Değerlendirme">
                <div>
                    <SelectBox
                        v-model="form.state"
                        :items="states"
                        label="Statü"
                        option-value="value"
                    />
                    <div class="mt-4">
                        <ol class="list-inside list-disc">
                            <li>
                                <span class="font-medium">Taslak:</span>
                                Kullanıcının ilanı daha tamamlamadığını ve üzerinde düzenleme
                                yapıldığını belirtir.
                            </li>
                            <li>
                                <span class="font-medium">Beklemede:</span>
                                Kullanıcı ilanını tamamladı ve değerlendirilmesini bekliyor.
                            </li>
                            <li>
                                <span class="font-medium">Reddedildi:</span>
                                İlan kontrol edildi ve yayına uygun olmadığı belirlendi. İlanı
                                reddederken reddedilme sebebini not alanına ekleyebilirsiniz.
                            </li>
                            <li>
                                <span class="font-medium">Onaylandı:</span> İlan kontrol edildi ve
                                yayına uygun olduğu belirlendi.
                            </li>
                            <li><span class="font-medium">Yayında:</span> İlan yayında.</li>
                            <li><span class="font-medium">Satıldı:</span> İlan satıldı.</li>
                            <li>
                                <span class="font-medium">Düzenlendi:</span>
                                İlan düzenlendi ve tekrar kontrol edilmesi gerekiyor.
                            </li>
                            <li>
                                <span class="font-medium">Kullanıcı Tarafından Kaldırıldı:</span>
                                İlan kullanıcı tarafından yayından kaldırıldı.
                            </li>
                            <li>
                                <span class="font-medium">Yönetici Tarafından Kaldırıldı:</span>
                                İlan yönetici tarafından yayından kaldırıldı.
                            </li>
                            <li>
                                <span class="font-medium">Zaman Aşımına Uğradı:</span>
                                İlan zaman aşımına uğradığı için sistem tarafından yayından
                                kaldırıldı.
                            </li>
                            <li>
                                <span class="font-medium">Silindi:</span> İlan yönetici tarafından
                                silindi.
                            </li>
                        </ol>
                    </div>
                </div>
                <TextBox v-model="form.note" label="Not" />
            </Card>

            <VButton :disabled="form.processing" type="submit">Gönder</VButton>
        </div>
    </form>
</template>
