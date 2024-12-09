<script lang="ts" setup>
import {InertiaForm} from '@inertiajs/vue3';
import {computed} from 'vue';
import {AttributeType} from '@/types/enums';
import {AttributeFormType} from '@/types/form';
import {AttributeCategory, VehicleType} from '@/types/model';
import {AttributeInputEnumResponse, EnumResponse} from '@/types/response';
import Card from '@/Components/Card.vue';
import ActivityCheckbox from '@/Components/Form/ActivityCheckbox.vue';
import Checkbox from '@/Components/Form/Checkbox.vue';
import InputBox from '@/Components/Form/InputBox.vue';
import SelectBox from '@/Components/Form/SelectBox.vue';
import TextBox from '@/Components/Form/TextBox.vue';
import VButton from '@/Components/VButton.vue';
import XMarkIcon from '@/Icons/XMarkIcon.vue';

const props = defineProps<{
    form: InertiaForm<AttributeFormType>;
    categories: AttributeCategory[];
    vehicleTypes: VehicleType[];
    types: EnumResponse[];
    inputs: AttributeInputEnumResponse[];
}>();

const input = computed(() => {
    return props.inputs.find((row) => {
        return row.value === props.form.input;
    });
});

const selectedCategory = computed(() => {
    return props.categories.find((row) => {
        return row.id === props.form.attribute_category_id;
    });
});

function addValue() {
    props.form.values.push({id: null, value: ''});
}

function removeValue(index: number) {
    props.form.values.splice(index, 1);
}

function optionLabel(item: AttributeCategory) {
    return `${item.name} (${item.type_label})`;
}
</script>

<template>
    <form>
        <Card>
            <div>
                <SelectBox
                    v-model="form.attribute_category_id"
                    :error="form.errors.attribute_category_id"
                    :items="categories"
                    :option-label="optionLabel"
                    label="Kategori"
                    required
                />
                <p class="mt-2">
                    <small>Bu özellik belirtilen kategorinin altında listelencektir.</small>
                </p>
            </div>

            <SelectBox
                v-if="selectedCategory"
                v-model="selectedCategory.type"
                :items="types"
                disabled
                label="Alan"
                option-value="value"
            />

            <SelectBox
                v-if="selectedCategory"
                v-model="selectedCategory.vehicle_type_id"
                :items="vehicleTypes"
                disabled
                label="Taşı Türü"
                option-label="name"
                option-value="id"
                placeholder="Genel (tüm taşıt türlerinde listelenecektir)"
            />

            <InputBox v-model="form.name" :error="form.errors.name" label="Özellik İsmi" required />

            <SelectBox
                v-model="form.input"
                :items="inputs"
                label="Değer Tipi"
                option-value="value"
                required
            />

            <div
                v-if="input && input.hasValues"
                class="space-y-3 rounded border border-stroke p-3 dark:border-form-strokedark"
            >
                <div class="text-lg">Değerler</div>
                <template v-for="(_, index) in form.values" :key="index">
                    <div class="flex gap-2">
                        <InputBox
                            v-model="form.values[index]['value']"
                            :error="form.errors[`values.${index}.value`]"
                            class="flex-grow"
                        />
                        <VButton icon theme="danger" @click="removeValue(index)">
                            <XMarkIcon class="size-4" />
                        </VButton>
                    </div>
                </template>

                <VButton block theme="info" @click="addValue">Değer Ekle</VButton>
            </div>

            <TextBox v-model="form.description" :error="form.errors.description" label="Açıklama" />

            <div>
                <InputBox v-model="form.unit" :error="form.errors.unit" label="Birim" />
                <p class="mt-2">
                    <small
                        >Özelliğin sonuna eklenecek birim. Örneğin; km, adet, kg, hp, cc
                        gibi.</small
                    >
                </p>
            </div>

            <InputBox
                v-model.number="form.order"
                :error="form.errors.order"
                label="Sıra"
                type="number"
            />

            <div
                v-if="
                    selectedCategory &&
                    (selectedCategory.type === AttributeType.ITEM ||
                        selectedCategory.type === AttributeType.BOTH)
                "
                class="space-y-4"
            >
                <div>
                    <Checkbox
                        v-model="form.required"
                        :value="true"
                        label="Zorunlu"
                        name="required"
                    />
                    <p class="mt-2">
                        <small
                            >Kullanıcılar ilan eklerken belirtilen özellikler zorunlu
                            olacaktır.</small
                        >
                    </p>
                </div>

                <div>
                    <Checkbox v-model="form.hidden" :value="true" label="Gizli" name="hidden" />
                    <p class="mt-2">
                        <small
                            >Bu alan ilan ve listeleme gibi sayfalarda kullanıcılara
                            görünmeyecektir.</small
                        >
                    </p>
                </div>
            </div>

            <ActivityCheckbox v-model="form.active" />

            <VButton :disabled="form.processing" block type="submit">Kaydet</VButton>
        </Card>
    </form>
</template>
