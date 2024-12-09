<script lang="ts" setup>
import {InertiaForm} from '@inertiajs/vue3';
import {ProvinceFormType} from '@/types/form';
import Card from '@/Components/Card.vue';
import InputBox from '@/Components/Form/InputBox.vue';
import SlugInput from '@/Components/Form/SlugInput.vue';
import VButton from '@/Components/VButton.vue';

defineProps<{
    form: InertiaForm<ProvinceFormType>;
}>();
</script>

<template>
    <form>
        <Card>
            <InputBox v-model="form.name" :error="form.errors.name" label="İl" required />

            <InputBox
                v-model.number="form.code"
                :error="form.errors.code"
                label="İl Kodu"
                type="number"
            />

            <InputBox v-model="form.title" :error="form.errors.title" label="Başlık" required />

            <SlugInput v-model="form.slug" :error="form.errors.slug" label="SEO URL" />

            <VButton :disabled="form.processing" block type="submit">Kaydet</VButton>
        </Card>
    </form>
</template>
