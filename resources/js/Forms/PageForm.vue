<script lang="ts" setup>
import {InertiaForm} from '@inertiajs/vue3';
import {PageFormType} from '@/types/form';
import {EnumResponse} from '@/types/response';
import Card from '@/Components/Card.vue';
import ActivityCheckbox from '@/Components/Form/ActivityCheckbox.vue';
import Editor from '@/Components/Form/Editor.vue';
import InputBox from '@/Components/Form/InputBox.vue';
import SelectBox from '@/Components/Form/SelectBox.vue';
import SlugInput from '@/Components/Form/SlugInput.vue';
import TextBox from '@/Components/Form/TextBox.vue';
import VButton from '@/Components/VButton.vue';

defineProps<{
    form: InertiaForm<PageFormType>;
    pageCategories: EnumResponse[];
    logoSrc?: string | null;
}>();
</script>

<template>
    <form>
        <Card>
            <SelectBox
                v-model="form.category"
                :error="form.errors.category"
                :items="pageCategories"
                label="Kategori"
                option-value="value"
                required
            />

            <InputBox v-model="form.title" :error="form.errors.title" label="Başlık" required />

            <SlugInput v-model="form.slug" :error="form.errors.slug" label="SEO URL" />

            <Editor v-model="form.body" label="İçerik" />

            <InputBox
                v-model="form.meta_title"
                :error="form.errors.meta_title"
                label="Meta Başlığı"
            />

            <TextBox
                v-model="form.meta_description"
                :error="form.errors.meta_description"
                label="Meta Açıklaması"
            />

            <TextBox
                v-model="form.meta_keywords"
                :error="form.errors.meta_keywords"
                label="Meta Anahtar Kelimeleri"
            />

            <ActivityCheckbox v-model="form.active" />

            <VButton :disabled="form.processing" block type="submit">Kaydet</VButton>
        </Card>
    </form>
</template>
