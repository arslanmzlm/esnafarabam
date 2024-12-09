<script lang="ts" setup>
import {InertiaForm} from '@inertiajs/vue3';
import {computed} from 'vue';
import {VehicleTypeFormType} from '@/types/form';
import {EnumResponse} from '@/types/response';
import Card from '@/Components/Card.vue';
import ActivityCheckbox from '@/Components/Form/ActivityCheckbox.vue';
import File from '@/Components/Form/File.vue';
import InputBox from '@/Components/Form/InputBox.vue';
import SelectBox from '@/Components/Form/SelectBox.vue';
import SlugInput from '@/Components/Form/SlugInput.vue';
import VButton from '@/Components/VButton.vue';

const props = defineProps<{
    form: InertiaForm<VehicleTypeFormType>;
    stepTypes: EnumResponse[];
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
            <InputBox v-model="form.name" :error="form.errors.name" label="Tür" required />

            <InputBox v-model="form.title" :error="form.errors.title" label="Başlık" required />

            <SlugInput v-model="form.slug" :error="form.errors.slug" label="SEO URL" />

            <div>
                <File
                    :error="form.errors.logo"
                    accept="image"
                    label="Logo"
                    @input="form.logo = $event.target.files[0]"
                />
                <img v-if="logoSrc" :src="logoSrc" alt="Taşıt Türü Logosu" class="mt-3 max-h-50" />
            </div>

            <div>
                <SelectBox
                    v-model="form.step_type"
                    :error="form.errors.step_type"
                    :items="stepTypes"
                    label="Sihirbaz Türü"
                    option-value="value"
                    required
                />

                <p class="mt-2">
                    <small
                        >Kullanıcılar ilan eklerken yukarıda belirtilen sıraya göre araç
                        seçecektir.</small
                    >
                </p>
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
