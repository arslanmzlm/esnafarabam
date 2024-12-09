<script lang="ts" setup>
import {isArray} from 'lodash';
import {computed} from 'vue';
import {AttributeInput} from '@/types/enums';
import {Attribute} from '@/types/model';
import Accordion from '@/Components/Accordion.vue';
import ReadOnly from '@/Components/Form/ReadOnly.vue';

const props = defineProps<{
    attribute: Attribute;
    value: any;
}>();

const label = computed(() => {
    return props.attribute.unit
        ? `${props.attribute.name} (${props.attribute.unit})`
        : props.attribute.name;
});

const compValue = computed(() => {
    if (
        props.attribute.values &&
        isArray(props.attribute.values) &&
        props.attribute.values.length
    ) {
        const val = props.attribute.values.find((v) => v.id === props.value);

        if (val) {
            return val.value;
        }
    }

    return props.value ?? 'Belirtilmemiş';
});

function checkboxValue(id: number) {
    return !!(isArray(compValue.value) && compValue.value.length && compValue.value.includes(id));
}
</script>

<template>
    <div v-if="attribute.input === AttributeInput.CHECKBOX" class="col-span-full">
        <Accordion :title="attribute.name" active>
            <div class="grid grid-cols-3 gap-4 p-5">
                <div
                    v-for="(item, index) in attribute.values"
                    :key="index"
                    class="col-span-1 flex flex-wrap items-center"
                >
                    <div class="relative">
                        <div
                            :class="
                                checkboxValue(item.id) && [
                                    'border-primary',
                                    'bg-gray',
                                    'text-primary',
                                ]
                            "
                            class="checkbox-icon mr-2 flex size-4 items-center justify-center rounded border"
                        >
                            <span :class="checkboxValue(item.id) ? 'opacity-100' : 'opacity-0'">
                                <svg
                                    fill="none"
                                    height="8"
                                    viewBox="0 0 11 8"
                                    width="11"
                                    xmlns="http://www.w3.org/2000/svg"
                                >
                                    <path
                                        class="fill-current stroke-current"
                                        d="M10.0915 0.951972L10.0867 0.946075L10.0813 0.940568C9.90076 0.753564 9.61034 0.753146 9.42927 0.939309L4.16201 6.22962L1.58507 3.63469C1.40401 3.44841 1.11351 3.44879 0.932892 3.63584C0.755703 3.81933 0.755703 4.10875 0.932892 4.29224L0.932878 4.29225L0.934851 4.29424L3.58046 6.95832C3.73676 7.11955 3.94983 7.2 4.1473 7.2C4.36196 7.2 4.55963 7.11773 4.71406 6.9584L10.0468 1.60234C10.2436 1.4199 10.2421 1.1339 10.0915 0.951972ZM4.2327 6.30081L4.2317 6.2998C4.23206 6.30015 4.23237 6.30049 4.23269 6.30082L4.2327 6.30081Z"
                                        stroke-width="0.4"
                                    ></path>
                                </svg>
                            </span>
                        </div>
                    </div>

                    <div class="flex select-none items-center text-sm font-medium">
                        {{ item.value }}
                    </div>
                </div>
            </div>
        </Accordion>
    </div>
    <div v-else class="col-span-1 space-y-3 border-stroke dark:border-form-strokedark">
        <ReadOnly :label :value="compValue" />
    </div>
</template>
