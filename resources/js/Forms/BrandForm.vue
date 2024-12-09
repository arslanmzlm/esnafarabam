<script lang="ts" setup>
import {InertiaForm} from '@inertiajs/vue3';
import {computed} from 'vue';
import {BrandFormType} from '@/types/form';
import Card from '@/Components/Card.vue';
import ActivityCheckbox from '@/Components/Form/ActivityCheckbox.vue';
import File from '@/Components/Form/File.vue';
import InputBox from '@/Components/Form/InputBox.vue';
import SlugInput from '@/Components/Form/SlugInput.vue';
import VButton from '@/Components/VButton.vue';

const props = defineProps<{
    form: InertiaForm<BrandFormType>;
    logoSrc?: string | null;
}>();

const logoSrc = computed(() => {
    if (props.form.logo !== null && typeof props.form.logo === 'object') {
        return URL.createObjectURL(props.form.logo);
    }

    return props.logoSrc;
});
</script>

<template>
    <form>
        <Card>
            <InputBox v-model="form.name" :error="form.errors.name" label="Marka İsmi" required />

            <InputBox v-model="form.title" :error="form.errors.title" label="Başlık" required />

            <SlugInput v-model="form.slug" :error="form.errors.slug" label="SEO URL" />

            <div>
                <File
                    :error="form.errors.logo"
                    accept="image"
                    label="Marka Logosu"
                    @input="form.logo = $event.target.files[0]"
                />
                <img v-if="logoSrc" :src="logoSrc" alt="Firma Logosu" class="mt-3 max-h-50" />
            </div>

            <InputBox
                v-model.number="form.order"
                :error="form.errors.order"
                label="Sıra"
                type="number"
            />
            
            <ActivityCheckbox v-model="form.active" />

            <VButton :disabled="form.processing" block type="submit">Kaydet</VButton>
        </Card>
    </form>
</template>
