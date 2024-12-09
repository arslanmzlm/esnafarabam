<script lang="ts" setup>
import {AttributeInput} from '@/types/enums';
import {Attribute} from '@/types/model';
import Accordion from '@/Components/Accordion.vue';
import Checkbox from '@/Components/Form/Checkbox.vue';
import InputBox from '@/Components/Form/InputBox.vue';
import Radio from '@/Components/Form/Radio.vue';
import SelectBox from '@/Components/Form/SelectBox.vue';

const props = withDefaults(
    defineProps<{
        attribute: Attribute;
        error?: string | null;
        preview?: boolean;
    }>(),
    {
        preview: false,
    },
);

const model = defineModel<any>();

if (props.attribute.input === AttributeInput.CHECKBOX && !Array.isArray(model.value)) {
    model.value = [];
}

function generateName(attribute_id: number | string, value_id: number | string | null = null) {
    return `attribute${attribute_id}Value${value_id}`;
}
</script>

<template>
    <div v-if="attribute.input === AttributeInput.CHECKBOX" class="col-span-full">
        <Accordion :title="attribute.name">
            <div class="grid grid-cols-3 gap-4 p-5">
                <Checkbox
                    v-for="value in attribute.values"
                    v-model="model"
                    :disabled="preview"
                    :label="value.value"
                    :name="generateName(attribute.id, value.id)"
                    :value="value.id"
                    class="col-span-1"
                    size="sm"
                    weight="medium"
                />
            </div>
        </Accordion>
    </div>
    <div v-else class="col-span-1 space-y-3 border-stroke dark:border-form-strokedark">
        <div class="mb-3 block text-sm font-medium text-black dark:text-white">
            {{ attribute.name }}
            <span v-if="attribute.unit">({{ attribute.unit }})</span>
            <span v-if="attribute.required && !preview" class="text-danger">*</span>
        </div>
        <div v-if="attribute.input === AttributeInput.TEXT">
            <InputBox v-model="model" :disabled="preview" :error />
        </div>
        <div v-else-if="attribute.input === AttributeInput.NUMBER">
            <InputBox v-model.number="model" :disabled="preview" :error type="number" />
        </div>
        <div v-else-if="attribute.input === AttributeInput.DATE">
            <InputBox v-model="model" :disabled="preview" :error type="date" />
        </div>
        <div
            v-else-if="
                attribute.input === AttributeInput.SELECT &&
                attribute.values &&
                attribute.values.length > 0
            "
        >
            <SelectBox
                v-model="model"
                :disabled="preview"
                :error
                :items="attribute.values"
                :placeholder="!attribute.required ? 'Belirtilmemiş' : undefined"
                option-label="value"
            />
        </div>
        <div
            v-else-if="attribute.input === AttributeInput.RADIO"
            class="flex w-full flex-wrap gap-3 rounded border-[1.5px] border-stroke bg-transparent p-3 font-normal text-black outline-none transition dark:border-form-strokedark dark:bg-form-input dark:text-white"
        >
            <Radio
                v-if="!attribute.required"
                v-model="model"
                :name="generateName(attribute.id)"
                :value="null"
            />
            <Radio
                v-for="value in attribute.values"
                v-model="model"
                :disabled="preview"
                :label="value.value"
                :name="generateName(attribute.id, value.id)"
                :value="value.id"
            />
        </div>
    </div>
</template>
