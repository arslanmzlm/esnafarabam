<script lang="ts" setup>
import {InertiaForm} from '@inertiajs/vue3';
import {computed, watch} from 'vue';
import draggable from 'vuedraggable';
import {ItemFormType} from '@/types/form';
import {AttributeCategory, Province, Vehicle} from '@/types/model';
import AttributeInputBox from '@/Components/Attribute/AttributeInputBox.vue';
import Card from '@/Components/Card.vue';
import Editor from '@/Components/Form/Editor.vue';
import File from '@/Components/Form/File.vue';
import InputBox from '@/Components/Form/InputBox.vue';
import SelectBox from '@/Components/Form/SelectBox.vue';
import VButton from '@/Components/VButton.vue';
import CircleInformationIcon from '@/Icons/CircleInformationIcon.vue';
import ImagePlusIcon from '@/Icons/ImagePlusIcon.vue';
import XMarkIcon from '@/Icons/XMarkIcon.vue';
import {enginePowerFormat, engineSizeFormat} from '@/Utilities/Formatters';

const props = withDefaults(
    defineProps<{
        form: InertiaForm<ItemFormType>;
        vehicle: Vehicle;
        attributeCategories: AttributeCategory[];
        provinces: Province[];
        isEdit?: boolean;
    }>(),
    {
        isEdit: false,
    },
);

const province = computed(() => {
    return props.provinces.find((row) => {
        return row.id === props.form.province_id;
    });
});

const district = computed(() => {
    if (province.value && province.value.districts) {
        return province.value.districts.find((row) => {
            return row.id === props.form.district_id;
        });
    }

    return null;
});

watch(
    () => props.form.province_id,
    () => {
        props.form.district_id = 0;
        props.form.neighborhood_id = 0;
    },
);

watch(
    () => props.form.district_id,
    () => {
        props.form.neighborhood_id = 0;
    },
);

function addPhoto(files: any) {
    if (props.form.photos.length === 15) {
        return;
    }

    if (files instanceof FileList) {
        for (let i = 0; i < files.length; i++) {
            if (props.form.photos.length === 15) {
                return;
            }

            props.form.photos.push({
                id: null,
                file: files[i],
                order: props.form.photos.length + 1,
            });
        }
    } else if (files instanceof File) {
        props.form.photos.push({
            id: null,
            file: files,
            order: props.form.photos.length + 1,
        });
    }
}

function deletePhoto(index: number) {
    props.form.photos.splice(index, 1);

    reOrderPhotos();
}

function reOrderPhotos() {
    props.form.photos.forEach((item, index) => {
        item.order = index + 1;
    });
}

function getImagePreview(photo: any) {
    if (photo.file instanceof Blob || photo.file instanceof MediaSource) {
        return URL.createObjectURL(photo.file);
    } else if (typeof photo.file === 'string') {
        return photo.src ?? photo.file;
    }
}

function getAttributeIndex(attribute_id: number) {
    return props.form.attributes.findIndex((item) => item.attribute_id === attribute_id);
}

function getAttributeError(attribute_id: number) {
    const index = props.form.attributes.findIndex((attribute) => {
        return attribute.attribute_id === attribute_id;
    });

    return props.form.errors[`attributes.${index}.value`] ?? null;
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
                        <div class="hidden w-[2px] bg-stroke lg:block"></div>
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

            <Card title="Görseller">
                <draggable
                    v-if="form.photos && form.photos.length > 0"
                    v-model="form.photos"
                    class="flex flex-wrap gap-4"
                    ghost-class="drag-ghost"
                    handle=".handle"
                    item-key="file"
                    @change="reOrderPhotos"
                >
                    <template #item="{element, index}">
                        <div
                            class="relative rounded border border-stroke p-2 dark:border-strokedark"
                        >
                            <div
                                v-if="element.order === 1"
                                class="absolute left-1 top-1 z-10 h-7 rounded bg-primary px-3 text-sm leading-7 text-white"
                            >
                                Kapak
                            </div>
                            <div class="absolute right-1 top-1 z-10">
                                <VButton
                                    class="h-7 rounded bg-danger px-2 text-white"
                                    title="Görseli sil"
                                    type="button"
                                    @click="deletePhoto(index)"
                                >
                                    <XMarkIcon class="size-4" />
                                </VButton>
                            </div>
                            <div
                                class="handle absolute inset-0 z-1 cursor-move rounded hover:bg-black hover:bg-opacity-50"
                            ></div>
                            <img :src="getImagePreview(element)" alt="" class="h-50" />
                        </div>
                    </template>
                </draggable>

                <div
                    v-if="form.photos.length === 15"
                    class="flex items-center gap-2 rounded bg-danger p-4 text-xl font-medium text-white"
                >
                    <CircleInformationIcon class="inline size-7" />
                    En fazla 15 adet görsel ekleyebilirsiniz.
                </div>

                <div>
                    <label
                        class="inline-block cursor-pointer rounded border-2 border-dashed border-primary bg-primary bg-opacity-10 p-8 text-primary transition-colors hover:bg-opacity-25 dark:border-white dark:text-white"
                        for="fileItemPhotos"
                    >
                        <ImagePlusIcon class="mx-auto size-15" />
                        <span class="mt-2 inline-block text-lg font-bold">Fotoğraf Ekle</span>
                    </label>
                    <input
                        id="fileItemPhotos"
                        :disabled="form.photos.length === 15"
                        accept="image/jpeg,image/png,image/webp,image/svg+xml"
                        class="hidden"
                        multiple
                        type="file"
                        @change="addPhoto($event?.target?.files)"
                    />
                </div>
            </Card>

            <Card title="İlan Bilgileri">
                <div class="grid grid-cols-1 gap-4 xl:grid-cols-2">
                    <InputBox
                        v-model.number="form.price"
                        :error="form.errors.price"
                        class="col-span-1"
                        label="Fiyat"
                        required
                        suffix="TL"
                    />
                    <InputBox
                        v-model.number="form.kilometer"
                        :error="form.errors.kilometer"
                        class="col-span-1"
                        label="Kilometre"
                        required
                        suffix="KM"
                    />
                </div>
                <InputBox
                    v-model="form.title"
                    :error="form.errors.title"
                    class="col-span-1"
                    label="İlan Başlığı"
                    required
                />
                <Editor v-model="form.description" label="Açıklama" required />
            </Card>

            <Card title="Adres">
                <div class="grid grid-cols-1 gap-4 xl:grid-cols-3">
                    <SelectBox
                        v-model="form.province_id"
                        :error="form.errors.province_id"
                        :items="provinces"
                        label="İl"
                        option-label="name"
                        required
                    />

                    <SelectBox
                        v-model="form.district_id"
                        :disabled="!form.province_id"
                        :error="form.errors.district_id"
                        :items="province?.districts ?? []"
                        label="İlçe"
                        option-label="name"
                        required
                    />

                    <SelectBox
                        v-model="form.neighborhood_id"
                        :disabled="!form.district_id"
                        :error="form.errors.neighborhood_id"
                        :items="district?.neighborhoods ?? []"
                        label="Mahalle"
                        option-label="name"
                        required
                    />
                </div>
            </Card>

            <Card
                v-for="(attributeCategory, categoryIndex) in attributeCategories"
                :key="categoryIndex"
                :title="attributeCategory.name"
            >
                <div class="grid grid-cols-1 gap-4 xl:grid-cols-3">
                    <AttributeInputBox
                        v-for="(attribute, index) in attributeCategory.attributes"
                        :key="index"
                        v-model="form.attributes[getAttributeIndex(attribute.id)].value"
                        :attribute="attribute"
                        :error="getAttributeError(attribute.id)"
                    />
                </div>
            </Card>

            <VButton :disabled="form.processing" type="submit">Gönder</VButton>
        </div>
    </form>
</template>
