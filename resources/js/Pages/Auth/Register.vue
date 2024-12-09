<script lang="ts" setup>
import {Link, useForm} from '@inertiajs/vue3';
import {computed, watch} from 'vue';
import {Province} from '@/types/model';
import GuestLayout from '@/Layouts/GuestAuthLayout.vue';
import InputBox from '@/Components/Form/InputBox.vue';
import SelectBox from '@/Components/Form/SelectBox.vue';
import VButton from '@/Components/VButton.vue';

const props = defineProps<{
    provinces: Province[];
}>();

const form = useForm({
    name: '',
    surname: '',
    phone: '',
    email: '',
    password: '',
    password_confirmation: '',
    tax_identity: '',
    province_id: 0,
    district_id: 0,
});

const province = computed(() => {
    return props.provinces.find((row) => {
        return row.id === form.province_id;
    });
});

watch(
    () => form.province_id,
    () => {
        form.district_id = 0;
    },
);

function submit() {
    form.post(route('register.store'));
}
</script>

<template>
    <GuestLayout>
        <div class="mx-auto bg-white p-10 shadow-md sm:max-w-xl sm:rounded-lg">
            <span class="mb-1.5 block font-medium">Ücretsiz kayıt olarak fırsatları kaçırma!</span>

            <h2 class="mb-9 text-2xl font-bold text-black dark:text-white sm:text-title-xl2">
                Esnaf Arabama Kaydol
            </h2>

            <form class="space-y-6" @submit.prevent="submit">
                <div class="grid grid-cols-1 gap-4 lg:grid-cols-2">
                    <InputBox
                        v-model="form.name"
                        :error="form.errors.name"
                        class="col-span-full lg:col-span-1"
                        label="Ad"
                        required
                    />

                    <InputBox
                        v-model="form.surname"
                        :error="form.errors.surname"
                        class="col-span-full lg:col-span-1"
                        label="Soyad"
                        required
                    />

                    <InputBox
                        v-model="form.email"
                        :error="form.errors.email"
                        class="col-span-full lg:col-span-1"
                        label="E-Posta Adresi"
                        required
                        type="email"
                    />

                    <InputBox
                        v-model="form.phone"
                        :error="form.errors.phone"
                        class="col-span-full lg:col-span-1"
                        label="Telefon Numarası"
                        prefix="+90"
                        required
                    />

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
                </div>

                <InputBox
                    v-model="form.tax_identity"
                    :error="form.errors.tax_identity"
                    label="Vergi Numarası"
                    required
                />

                <InputBox
                    v-model="form.password"
                    :error="form.errors.password"
                    label="Şifre"
                    required
                    type="password"
                />

                <InputBox
                    v-model="form.password_confirmation"
                    :error="form.errors.password_confirmation"
                    label="Şifre (Tekrar)"
                    required
                    type="password"
                />

                <VButton block type="submit">Üyeliği Oluştur</VButton>

                <div class="mt-6 text-center">
                    <p class="font-medium">
                        Zaten hesabın var mı?
                        <Link :href="route('login')" class="text-primary">Giriş yap</Link>
                    </p>
                </div>
            </form>
        </div>
    </GuestLayout>
</template>
