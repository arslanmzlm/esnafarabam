<script lang="ts" setup>
import InvalidFeedback from '@/Components/Form/InvalidFeedback.vue';

const model = defineModel<string | number | null>({required: true});

withDefaults(
    defineProps<{
        items: any[];
        optionValue?: string;
        optionLabel?: string | CallableFunction;
        label?: string;
        required?: boolean;
        placeholder?: string;
        error?: string | null;
        disabled?: boolean;
    }>(),
    {
        optionLabel: 'label',
        optionValue: 'id',
        required: false,
        disabled: false,
    },
);
</script>

<template>
    <div>
        <label v-if="label" class="mb-3 block text-sm font-medium text-black dark:text-white"
            >{{ label }} <span v-if="required" class="text-danger">*</span></label
        >

        <div class="bg-white dark:bg-form-input">
            <select
                v-model="model"
                :disabled
                class="relative z-20 w-full rounded border border-stroke bg-transparent py-3 pl-5 pr-12 text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:disabled:bg-black"
            >
                <option v-if="placeholder" :value="null" class="text-body">
                    {{ placeholder }}
                </option>

                <option
                    v-for="(item, index) in items"
                    :key="index"
                    :value="item[optionValue]"
                    class="text-body"
                >
                    {{ typeof optionLabel === 'function' ? optionLabel(item) : item[optionLabel] }}
                </option>
            </select>
        </div>

        <InvalidFeedback v-if="error" :message="error" />
    </div>
</template>
