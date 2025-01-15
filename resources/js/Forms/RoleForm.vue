<script lang="ts" setup>
import {InertiaForm} from '@inertiajs/vue3';
import {RoleFormType} from '@/types/form';
import {Ability} from '@/types/model';
import Card from '@/Components/Card.vue';
import Checkbox from '@/Components/Form/Checkbox.vue';
import InputBox from '@/Components/Form/InputBox.vue';
import VButton from '@/Components/VButton.vue';

defineProps<{
    form: InertiaForm<RoleFormType>;
    abilities: Ability[];
}>();

function getLabel(ability: Ability) {
    return `${ability.title} - ${ability.route}`;
}
</script>

<template>
    <form>
        <Card>
            <InputBox v-model="form.name" :error="form.errors.name" label="Yetki" required />

            <Checkbox v-model="form.admin" :error="form.errors.admin" label="Admin" name="admin" />

            <div v-if="form.admin" class="space-y-4 rounded border border-neutral-200 p-4">
                <div v-for="ability in abilities">
                    <Checkbox
                        v-model="form.abilities"
                        :label="getLabel(ability)"
                        :name="ability.route"
                        :value="ability.id"
                    />
                    <div v-if="ability.description">{{ ability.description }}</div>
                </div>
            </div>

            <VButton :disabled="form.processing" block type="submit">Kaydet</VButton>
        </Card>
    </form>
</template>
