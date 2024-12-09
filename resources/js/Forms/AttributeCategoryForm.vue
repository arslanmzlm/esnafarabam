<script lang="ts" setup>
import {InertiaForm} from '@inertiajs/vue3';
import {AttributeCategoryFormType} from '@/types/form';
import {VehicleType} from '@/types/model';
import {EnumResponse} from '@/types/response';
import Card from '@/Components/Card.vue';
import InputBox from '@/Components/Form/InputBox.vue';
import SelectBox from '@/Components/Form/SelectBox.vue';
import TextBox from '@/Components/Form/TextBox.vue';
import VButton from '@/Components/VButton.vue';

withDefaults(
    defineProps<{
        form: InertiaForm<AttributeCategoryFormType>;
        types: EnumResponse[];
        vehicleTypes: VehicleType[];
        isEdit?: boolean;
    }>(),
    {
        isEdit: false,
    },
);
</script>

<template>
    <form>
        <Card>
            <InputBox
                v-model="form.name"
                :error="form.errors.name"
                label="Kategori İsmi"
                required
            />

            <div>
                <SelectBox
                    v-model="form.type"
                    :disabled="isEdit"
                    :items="types"
                    label="Alan"
                    option-value="value"
                    required
                />

                <p class="mt-2">
                    <small
                        >Bu kategori sadece belirtilen alanda listelenecektir. Bu alan daha sonra
                        değiştirilemez.</small
                    >
                </p>
            </div>

            <div>
                <SelectBox
                    v-model="form.vehicle_type_id"
                    :disabled="isEdit"
                    :items="vehicleTypes"
                    label="Taşı Türü"
                    option-label="name"
                    option-value="id"
                    placeholder="Genel (tüm taşıt türlerinde listelenecektir)"
                    required
                />

                <p class="mt-2">
                    <small
                        >Bu kategori sadece belirtilen taşıt türünde listelenecektir. Bu alan daha
                        sonra değiştirilemez.</small
                    >
                </p>
            </div>

            <InputBox
                v-model.number="form.order"
                :error="form.errors.order"
                label="Sıra"
                type="number"
            />

            <TextBox v-model="form.description" :error="form.errors.description" label="Açıklama" />

            <VButton :disabled="form.processing" block type="submit">Kaydet</VButton>
        </Card>
    </form>
</template>
