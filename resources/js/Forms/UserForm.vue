<script lang="ts" setup>
import {InertiaForm} from '@inertiajs/vue3';
import {computed, watch} from 'vue';
import {UserFormType} from '@/types/form';
import {Province} from '@/types/model';
import Card from '@/Components/Card.vue';
import InputBox from '@/Components/Form/InputBox.vue';
import SelectBox from '@/Components/Form/SelectBox.vue';
import TextBox from '@/Components/Form/TextBox.vue';
import VButton from '@/Components/VButton.vue';

const props = defineProps<{
    form: InertiaForm<UserFormType>;
    provinces: Province[];
}>();

const province = computed(() => {
    return props.provinces.find((row) => {
        return row.id === props.form.province_id;
    });
});

watch(
    () => props.form.province_id,
    () => {
        props.form.district_id = 0;
    },
);
</script>

<template>
    <form class="space-y-6">
        <Card title="Kullanıcı Bilgileri">
            <InputBox v-model="form.username" :error="form.errors.username" label="Kullanıcı Adı" />

            <InputBox
                v-model="form.email"
                :error="form.errors.email"
                label="E-Posta Adresi"
                required
            />

            <InputBox
                v-model="form.phone"
                :error="form.errors.phone"
                label="Telefon Numarası"
                prefix="+90"
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
                label="Şifre (tekrar)"
                required
                type="password"
            />
        </Card>

        <Card title="Profil Bilgileri">
            <InputBox v-model="form.name" :error="form.errors.name" label="Ad" required />

            <InputBox v-model="form.surname" :error="form.errors.surname" label="Soyad" required />

            <InputBox v-model="form.company" :error="form.errors.company" label="Firma Adı" />

            <InputBox
                v-model="form.company_phone"
                :error="form.errors.company_phone"
                label="Firma Telefonu"
                prefix="+90"
            />

            <TextBox v-model="form.address" :error="form.errors.address" :rows="3" label="Adres" />

            <InputBox
                v-model="form.tax_identity"
                :error="form.errors.tax_identity"
                :rows="3"
                label="Vergi Numarası"
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
        </Card>

        <VButton :disabled="form.processing" block type="submit">Kaydet</VButton>
    </form>
</template>
