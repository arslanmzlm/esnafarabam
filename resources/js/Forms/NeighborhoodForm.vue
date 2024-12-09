<script lang="ts" setup>
import {InertiaForm} from '@inertiajs/vue3';
import {NeighborhoodFormType} from '@/types/form';
import {District} from '@/types/model';
import Card from '@/Components/Card.vue';
import InputBox from '@/Components/Form/InputBox.vue';
import SelectBox from '@/Components/Form/SelectBox.vue';
import SlugInput from '@/Components/Form/SlugInput.vue';
import VButton from '@/Components/VButton.vue';

defineProps<{
    form: InertiaForm<NeighborhoodFormType>;
    districts: District[];
}>();

function optionLabel(item: District) {
    return `${item?.province?.name} - ${item.name}`;
}
</script>

<template>
    <form>
        <Card>
            <SelectBox
                v-model="form.district_id"
                :items="districts"
                :option-label="optionLabel"
                label="İlçe"
                required
            />

            <InputBox v-model="form.name" :error="form.errors.name" label="Mahalle" required />

            <InputBox v-model="form.title" :error="form.errors.title" label="Başlık" required />
            
            <SlugInput v-model="form.slug" :error="form.errors.slug" label="SEO URL" />

            <VButton :disabled="form.processing" block type="submit">Kaydet</VButton>
        </Card>
    </form>
</template>
