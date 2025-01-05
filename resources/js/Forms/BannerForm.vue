<script lang="ts" setup>
import {InertiaForm} from '@inertiajs/vue3';
import {computed} from 'vue';
import {BannerFormType} from '@/types/form';
import {EnumResponse} from '@/types/response';
import Card from '@/Components/Card.vue';
import ActivityCheckbox from '@/Components/Form/ActivityCheckbox.vue';
import File from '@/Components/Form/File.vue';
import InputBox from '@/Components/Form/InputBox.vue';
import SelectBox from '@/Components/Form/SelectBox.vue';
import TextBox from '@/Components/Form/TextBox.vue';
import VButton from '@/Components/VButton.vue';

const props = withDefaults(
    defineProps<{
        form: InertiaForm<BannerFormType>;
        bannerFields: EnumResponse[];
        imageSrc?: string | null;
        mobileImageSrc?: string | null;
        isEdit?: boolean;
    }>(),
    {
        isEdit: false,
    },
);

const imageSrc = computed(() => {
    if (props.form.image !== null && typeof props.form.image === 'object') {
        return URL.createObjectURL(props.form.image);
    }

    return props.imageSrc;
});

const mobileImageSrc = computed(() => {
    if (props.form.mobile_image !== null && typeof props.form.mobile_image === 'object') {
        return URL.createObjectURL(props.form.mobile_image);
    }

    return props.mobileImageSrc;
});
</script>

<template>
    <form>
        <Card>
            <SelectBox
                v-model="form.field"
                :disabled="isEdit"
                :error="form.errors.field"
                :items="bannerFields"
                label="Alan"
                option-value="value"
                required
            />

            <InputBox v-model="form.title" :error="form.errors.title" label="Başlık" required />

            <InputBox v-model="form.alt_title" :error="form.errors.alt_title" label="Alt Başlık" />

            <InputBox v-model="form.sub_title" :error="form.errors.sub_title" label="Üst Başlık" />

            <TextBox v-model="form.body" label="İçerik" />

            <TextBox v-model="form.excerpt" label="Özet" />

            <InputBox
                v-model="form.link_label"
                :error="form.errors.link_label"
                label="Bağlantı Başlığı"
            />

            <InputBox v-model="form.link" :error="form.errors.link" label="Bağlantı" />

            <div>
                <File
                    :error="form.errors.image"
                    accept="image"
                    label="Görsel"
                    @input="form.image = $event.target.files[0]"
                />
                <img v-if="imageSrc" :src="imageSrc" alt="Görsel" class="mt-3 max-h-50" />
            </div>

            <div>
                <File
                    :error="form.errors.mobile_image"
                    accept="image"
                    label="Mobil Görseli"
                    @input="form.mobile_image = $event.target.files[0]"
                />
                <img
                    v-if="mobileImageSrc"
                    :src="mobileImageSrc"
                    alt="Mobil Görseli"
                    class="mt-3 max-h-50"
                />
            </div>

            <InputBox v-model="form.alt" :error="form.errors.alt" label="Resim Başlığı" />

            <ActivityCheckbox v-model="form.active" />

            <VButton :disabled="form.processing" block type="submit">Kaydet</VButton>
        </Card>
    </form>
</template>
