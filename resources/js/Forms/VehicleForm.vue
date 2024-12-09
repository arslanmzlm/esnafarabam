<script lang="ts" setup>
import {InertiaForm} from '@inertiajs/vue3';
import {VehicleFormType} from '@/types/form';
import {AttributeCategory, Brand, VehicleType} from '@/types/model';
import {AttributeValueResponse, EnumResponse} from '@/types/response';
import AttributeInputBox from '@/Components/Attribute/AttributeInputBox.vue';
import Card from '@/Components/Card.vue';
import ActivityCheckbox from '@/Components/Form/ActivityCheckbox.vue';
import InputBox from '@/Components/Form/InputBox.vue';
import SelectBox from '@/Components/Form/SelectBox.vue';
import SlugInput from '@/Components/Form/SlugInput.vue';
import VButton from '@/Components/VButton.vue';

const props = withDefaults(
    defineProps<{
        form: InertiaForm<VehicleFormType>;
        vehicleTypes: VehicleType[];
        brands: Brand[];
        gears: EnumResponse[];
        fuels: EnumResponse[];
        attributeCategories?: AttributeCategory[];
        attributeValues?: AttributeValueResponse[];
        isEdit?: boolean;
    }>(),
    {
        isEdit: false,
    },
);

function getAttributeIndex(attribute_id: number): number {
    return props.form.attributes
        ? props.form.attributes.findIndex((item) => item.attribute_id === attribute_id)
        : -1;
}

function getAttributeError(attribute_id: number): string | null {
    let index = -1;

    if (props.form.attributes) {
        index = props.form.attributes.findIndex((attribute) => {
            return attribute.attribute_id === attribute_id;
        });
    }

    props.form.hasErrors;

    return props.form.errors[`attributes.${index}.value`] ?? null;
}
</script>

<template>
    <form>
        <div class="space-y-6">
            <Card>
                <SelectBox
                    v-model="form.vehicle_type_id"
                    :disabled="isEdit"
                    :error="form.errors.vehicle_type_id"
                    :items="vehicleTypes"
                    label="Taşıt Türü"
                    option-label="name"
                    required
                />

                <SelectBox
                    v-model="form.brand_id"
                    :disabled="isEdit"
                    :error="form.errors.brand_id"
                    :items="brands"
                    label="Marka"
                    option-label="name"
                    required
                />

                <InputBox v-model="form.title" :error="form.errors.title" label="Başlık" required />

                <SlugInput v-model="form.slug" :error="form.errors.slug" label="SEO URL" />

                <InputBox
                    v-model="form.stock_code"
                    :error="form.errors.stock_code"
                    label="Taşıt Kodu"
                />

                <InputBox
                    v-model.number="form.year"
                    :error="form.errors.year"
                    label="Yıl"
                    required
                    type="number"
                />

                <InputBox v-model="form.series" :error="form.errors.series" label="Seri" required />

                <InputBox v-model="form.model" :error="form.errors.model" label="Model" required />

                <InputBox v-model="form.submodel" :error="form.errors.submodel" label="Alt Model" />

                <SelectBox
                    v-model="form.gear"
                    :items="gears"
                    label="Vites"
                    option-value="value"
                    required
                />

                <SelectBox
                    v-model="form.fuel"
                    :items="fuels"
                    label="Yakıt"
                    option-value="value"
                    required
                />

                <InputBox
                    v-model.number="form.engine_power"
                    :error="form.errors.engine_power"
                    label="Motor Gücü (hp)"
                    required
                    type="number"
                />

                <InputBox
                    v-model.number="form.engine_size"
                    :error="form.errors.engine_size"
                    label="Motor Hacmi (cc)"
                    required
                    type="number"
                />
                <ActivityCheckbox v-model="form.active" />
            </Card>

            <div
                v-if="isEdit && attributeCategories && attributeValues && form.attributes"
                class="space-y-6"
            >
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
            </div>

            <VButton :disabled="form.processing" block type="submit">Kaydet</VButton>
        </div>
    </form>
</template>
