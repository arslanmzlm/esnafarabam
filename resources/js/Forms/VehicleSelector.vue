<script lang="ts" setup>
import axios from 'axios';
import {reactive, ref, watch} from 'vue';
import {Brand, Vehicle, VehicleType} from '@/types/model';
import Card from '@/Components/Card.vue';
import Radio from '@/Components/Form/Radio.vue';
import VButton from '@/Components/VButton.vue';
import {enginePowerFormat, engineSizeFormat} from '@/Utilities/Formatters';

const props = defineProps<{
    vehicleTypes: VehicleType[];
}>();

const loading = ref<boolean>(false);

const params = reactive<{
    vehicle_type_id: number | null;
    year: number | null;
    brand_id: number | null;
    series: string | null;
    model: string | null;
    submodel: string | null;
}>({
    vehicle_type_id: null,
    year: null,
    brand_id: null,
    series: null,
    model: null,
    submodel: null,
});

let vehicleTypes = props.vehicleTypes;
let years: number[] = [];
let brands: Brand[] = [];
let series: string[] = [];
let models: string[] = [];
let submodels: string[] = [];
let vehicles: Vehicle[] = [];

const selectedVehicle = ref<number | null>(null);

const emit = defineEmits(['submit']);

watch(params, getInfo);

function setTypeId(typeId: number) {
    params.vehicle_type_id = typeId;

    params.year = null;
    params.brand_id = null;
    params.series = null;
    params.model = null;
    params.submodel = null;
    selectedVehicle.value = null;

    years = [];
    brands = [];
    series = [];
    models = [];
    submodels = [];
    vehicles = [];
}

function setYear(year: number) {
    params.year = year;

    params.brand_id = null;
    params.series = null;
    params.model = null;
    params.submodel = null;
    selectedVehicle.value = null;

    brands = [];
    series = [];
    models = [];
    submodels = [];
    vehicles = [];
}

function setBrandId(brand_id: number) {
    params.brand_id = brand_id;

    params.series = null;
    params.model = null;
    params.submodel = null;
    selectedVehicle.value = null;

    series = [];
    models = [];
    submodels = [];
    vehicles = [];
}

function setSeries(series: string) {
    params.series = series;

    params.model = null;
    params.submodel = null;
    selectedVehicle.value = null;

    models = [];
    submodels = [];
    vehicles = [];
}

function setModel(model: string) {
    params.model = model;

    params.submodel = null;
    selectedVehicle.value = null;

    submodels = [];
    vehicles = [];
}

function setSubmodel(submodel: string) {
    params.submodel = submodel;

    selectedVehicle.value = null;
}

function getInfo() {
    loading.value = true;

    axios
        .post(route('item.step.data'), params)
        .then((response) => {
            if (response.data.vehicleTypes) {
                vehicleTypes = response.data.vehicleTypes;
            }
            if (response.data.years) {
                years = response.data.years;
            }
            if (response.data.brands) {
                brands = response.data.brands;
            }
            if (response.data.series) {
                series = response.data.series;
            }
            if (response.data.models) {
                models = response.data.models;
            }
            if (response.data.submodels) {
                submodels = response.data.submodels;
            }
            if (response.data.vehicles) {
                vehicles = response.data.vehicles;
            }
        })
        .finally(() => {
            loading.value = false;
        });
}

function submit() {
    emit('submit', selectedVehicle.value);
}
</script>

<template>
    <Card>
        <div class="relative flex h-90 gap-x-3 overflow-x-auto rounded bg-slate-300 p-4">
            <div
                v-if="vehicleTypes && vehicleTypes.length"
                class="flex h-full shrink-0 flex-col overflow-y-auto rounded bg-white py-2"
            >
                <button
                    v-for="(type, index) in vehicleTypes"
                    :key="index"
                    :class="{'bg-slate-200 text-primary': params.vehicle_type_id === type.id}"
                    class="px-4 py-2 text-start font-medium hover:text-primary"
                    type="button"
                    @click="setTypeId(type.id)"
                >
                    {{ type.name }}
                </button>
            </div>

            <div
                v-if="years && years.length"
                class="flex h-full shrink-0 flex-col overflow-y-auto rounded bg-white py-2"
            >
                <button
                    v-for="(year, index) in years"
                    :key="index"
                    :class="{'bg-slate-200 text-primary': params.year === year}"
                    class="px-4 py-2 text-start font-medium hover:text-primary"
                    type="button"
                    @click="setYear(year)"
                >
                    {{ year }}
                </button>
            </div>

            <div
                v-if="brands && brands.length"
                class="flex h-full shrink-0 flex-col overflow-y-auto rounded bg-white py-2"
            >
                <button
                    v-for="(brand, index) in brands"
                    :key="index"
                    :class="{'bg-slate-200 text-primary': params.brand_id === brand.id}"
                    class="px-4 py-2 text-start font-medium hover:text-primary"
                    type="button"
                    @click="setBrandId(brand.id)"
                >
                    {{ brand.name }}
                </button>
            </div>

            <div
                v-if="series && series.length"
                class="flex h-full shrink-0 flex-col overflow-y-auto rounded bg-white py-2"
            >
                <button
                    v-for="(row, index) in series"
                    :key="index"
                    :class="{'bg-slate-200 text-primary': params.series === row}"
                    class="px-4 py-2 text-start font-medium hover:text-primary"
                    type="button"
                    @click="setSeries(row)"
                >
                    {{ row }}
                </button>
            </div>

            <div
                v-if="models && models.length"
                class="flex h-full shrink-0 flex-col overflow-y-auto rounded bg-white py-2"
            >
                <button
                    v-for="(model, index) in models"
                    :key="index"
                    :class="{'bg-slate-200 text-primary': params.model === model}"
                    class="px-4 py-2 text-start font-medium hover:text-primary"
                    type="button"
                    @click="setModel(model)"
                >
                    {{ model }}
                </button>
            </div>

            <div
                v-if="submodels && submodels.length"
                class="flex h-full shrink-0 flex-col overflow-y-auto rounded bg-white py-2"
            >
                <button
                    v-for="(submodel, index) in submodels"
                    :key="index"
                    :class="{'bg-slate-200 text-primary': params.submodel === submodel}"
                    class="px-4 py-2 text-start font-medium hover:text-primary"
                    type="button"
                    @click="setSubmodel(submodel)"
                >
                    {{ submodel }}
                </button>
            </div>

            <div
                v-if="vehicles && vehicles.length"
                class="h-full shrink-0 overflow-y-auto rounded bg-white px-4 py-2"
            >
                <table>
                    <thead>
                        <tr>
                            <td class="px-3 py-2 font-medium">Araç</td>
                            <td class="px-3 py-2 font-medium">Yıl</td>
                            <td class="px-3 py-2 font-medium">Yakıt</td>
                            <td class="px-3 py-2 font-medium">Vites</td>
                            <td class="px-3 py-2 font-medium">Motor Gücü</td>
                            <td class="px-3 py-2 font-medium">Motor Hacmi</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr
                            v-for="(vehicle, index) in vehicles"
                            :key="index"
                            class="cursor-pointer"
                            @click="selectedVehicle = vehicle.id"
                        >
                            <td class="px-3 py-2">
                                <Radio
                                    v-model="selectedVehicle"
                                    :label="vehicle.title"
                                    :name="`vehicle-${vehicle.id}`"
                                    :value="vehicle.id"
                                />
                            </td>
                            <td class="px-3 py-2">{{ vehicle.year }}</td>
                            <td class="px-3 py-2">{{ vehicle.fuel_label }}</td>
                            <td class="px-3 py-2">{{ vehicle.gear_label }}</td>
                            <td class="px-3 py-2">{{ enginePowerFormat(vehicle.engine_power) }}</td>
                            <td class="px-3 py-2">{{ engineSizeFormat(vehicle.engine_size) }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div
                v-if="loading"
                class="loader absolute inset-0 flex items-center justify-center rounded bg-white bg-opacity-75"
            >
                <div class="animate-spin">
                    <svg
                        fill="none"
                        height="50"
                        viewBox="0 0 50 50"
                        width="50"
                        xmlns="http://www.w3.org/2000/svg"
                    >
                        <mask id="path-1-inside-1_1881_16176" fill="white">
                            <path
                                d="M31.9333 49.0195C37.093 47.5301 41.636 44.4188 44.8896 40.1462C48.1432 35.8736 49.9345 30.6668 49.9982 25.2968C50.062 19.9268 48.3948 14.679 45.2435 10.3304C42.0922 5.98178 37.6244 2.76352 32.5014 1.15209C27.3785 -0.459331 21.8728 -0.378254 16.7996 1.38332C11.7263 3.1449 7.35519 6.49332 4.33332 10.9328C1.31145 15.3724 -0.200496 20.667 0.0213371 26.0328C0.24317 31.3986 2.18699 36.5503 5.565 40.7253L9.8072 37.2929C7.16653 34.0292 5.647 30.002 5.47359 25.8074C5.30018 21.6128 6.4821 17.4739 8.84437 14.0034C11.2066 10.5329 14.6237 7.91538 18.5895 6.53831C22.5554 5.16125 26.8593 5.09787 30.8641 6.35756C34.8688 7.61724 38.3614 10.133 40.8248 13.5325C43.2883 16.9319 44.5915 21.0342 44.5417 25.2321C44.4919 29.4299 43.0916 33.5002 40.5482 36.8402C38.0048 40.1801 34.4534 42.6123 30.4199 43.7766L31.9333 49.0195Z"
                            ></path>
                        </mask>
                        <path
                            d="M31.9333 49.0195C37.093 47.5301 41.636 44.4188 44.8896 40.1462C48.1432 35.8736 49.9345 30.6668 49.9982 25.2968C50.062 19.9268 48.3948 14.679 45.2435 10.3304C42.0922 5.98178 37.6244 2.76352 32.5014 1.15209C27.3785 -0.459331 21.8728 -0.378254 16.7996 1.38332C11.7263 3.1449 7.35519 6.49332 4.33332 10.9328C1.31145 15.3724 -0.200496 20.667 0.0213371 26.0328C0.24317 31.3986 2.18699 36.5503 5.565 40.7253L9.8072 37.2929C7.16653 34.0292 5.647 30.002 5.47359 25.8074C5.30018 21.6128 6.4821 17.4739 8.84437 14.0034C11.2066 10.5329 14.6237 7.91538 18.5895 6.53831C22.5554 5.16125 26.8593 5.09787 30.8641 6.35756C34.8688 7.61724 38.3614 10.133 40.8248 13.5325C43.2883 16.9319 44.5915 21.0342 44.5417 25.2321C44.4919 29.4299 43.0916 33.5002 40.5482 36.8402C38.0048 40.1801 34.4534 42.6123 30.4199 43.7766L31.9333 49.0195Z"
                            mask="url(#path-1-inside-1_1881_16176)"
                            stroke="#3C50E0"
                            stroke-width="14"
                        ></path>
                    </svg>
                </div>
            </div>
        </div>

        <VButton :disabled="selectedVehicle === null" block type="submit" @click="submit"
            >İlerle
        </VButton>
    </Card>
</template>
