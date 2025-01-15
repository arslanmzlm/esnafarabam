<script lang="ts" setup>
import {InertiaForm} from '@inertiajs/vue3';
import {SettingFormType} from '@/types/form';
import {SettingsResponse} from '@/types/response';
import Card from '@/Components/Card.vue';
import File from '@/Components/Form/File.vue';
import InputBox from '@/Components/Form/InputBox.vue';
import TextBox from '@/Components/Form/TextBox.vue';
import VButton from '@/Components/VButton.vue';

defineProps<{
    form: InertiaForm<SettingFormType>;
    settings: SettingsResponse;
}>();

const getImgSrc = (file: any) => {
    if (file !== null) {
        if (typeof file === 'object') {
            return URL.createObjectURL(file);
        } else {
            return `/uploads/static/${file}`;
        }
    }

    return undefined;
};
</script>

<template>
    <form class="space-y-6">
        <Card title="Genel Ayarlar">
            <InputBox
                v-model="form.site_title"
                :error="form.errors.site_title"
                label="Site Başlığı"
            />

            <TextBox
                v-model="form.site_description"
                :error="form.errors.site_description"
                label="Site Açıklaması"
            />

            <InputBox
                v-model="form.whatsapp_number"
                :error="form.errors.whatsapp_number"
                label="Whatsapp Numarası"
            />
        </Card>

        <Card title="Logolar">
            <div class="rounded-sm border border-neutral-200 p-4">
                <File
                    :error="form.errors.logo_default"
                    accept="image"
                    label="Logo"
                    @input="form.logo_default = $event.target.files[0]"
                />

                <img
                    v-if="form.logo_default"
                    :src="getImgSrc(form.logo_default)"
                    alt="Logo"
                    class="mt-3 max-h-50"
                />
            </div>

            <div class="rounded-sm border border-neutral-200 p-4">
                <File
                    :error="form.errors.logo_favicon"
                    accept="image"
                    label="Tarayıcı Simgesi"
                    @input="form.logo_favicon = $event.target.files[0]"
                />

                <img
                    v-if="form.logo_favicon"
                    :src="getImgSrc(form.logo_favicon)"
                    alt="Tarayıcı Sekme Simgesi"
                    class="mt-3 max-h-50"
                />
            </div>

            <div class="rounded-sm border border-neutral-200 p-4">
                <File
                    :error="form.errors.logo_dark"
                    accept="image"
                    label="Karanlık"
                    @input="form.logo_dark = $event.target.files[0]"
                />

                <img
                    v-if="form.logo_dark"
                    :src="getImgSrc(form.logo_dark)"
                    alt="Karanlık"
                    class="mt-3 max-h-50"
                />
            </div>

            <div class="rounded-sm border border-neutral-200 p-4">
                <File
                    :error="form.errors.logo_icon"
                    accept="image"
                    label="Simge"
                    @input="form.logo_icon = $event.target.files[0]"
                />

                <img
                    v-if="form.logo_icon"
                    :src="getImgSrc(form.logo_icon)"
                    alt="Simge"
                    class="mt-3 max-h-50"
                />
            </div>
        </Card>

        <Card title="Footer Ayarları">
            <TextBox
                v-model="form.footer_description"
                :error="form.errors.footer_description"
                label="Footer Açıklaması"
            />

            <InputBox
                v-model="form.footer_copyright"
                :error="form.errors.footer_copyright"
                label="Footer Copyright"
            />

            <InputBox
                v-model="form.footer_end"
                :error="form.errors.footer_end"
                label="Footer Bitiş"
            />
        </Card>

        <VButton :disabled="form.processing" block type="submit">Kaydet</VButton>
    </form>
</template>
