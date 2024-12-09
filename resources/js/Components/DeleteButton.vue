<script lang="ts" setup>
import {router} from '@inertiajs/vue3';
import {onClickOutside} from '@vueuse/core';
import {ref} from 'vue';
import VButton from '@/Components/VButton.vue';
import TrashIcon from '@/Icons/TrashIcon.vue';

const props = defineProps<{
    href: string;
}>();

const target = ref();
const show = ref(false);

onClickOutside(target, () => {
    show.value = false;
});

function submit() {
    router.post(props.href);
}
</script>

<template>
    <div ref="target" class="relative inline-block">
        <VButton icon theme="danger" title="Sil" @click="show = !show">
            <TrashIcon class="size-5" />
        </VButton>

        <div
            v-if="show"
            class="absolute right-full top-0 z-10 mr-2 flex w-60 flex-col rounded-sm border border-stroke bg-white p-3 text-center shadow-default dark:border-strokedark dark:bg-boxdark lg:-translate-y-1/4 lg:transform"
        >
            <div>
                Silinen veriler geri getirilemez ve bağlantılı olduğu verileride silecektir. Bu
                işlemi yapmak istediğine emin misin?
            </div>

            <div class="mt-2 flex justify-center gap-2">
                <VButton theme="danger" @click="submit">Sil</VButton>
                <VButton @click="show = false">İptal</VButton>
            </div>
        </div>
    </div>
</template>
