<script lang="ts" setup>
import {Link} from '@inertiajs/vue3';
import {ref} from 'vue';
import {useSidebarStore} from '@/Stores/sidebar';

const sidebarStore = useSidebarStore();

const props = defineProps(['items', 'page']);
const items = ref(props.items);

const handleItemClick = (index: number) => {
    sidebarStore.selected =
        sidebarStore.selected === props.items[index].label ? '' : props.items[index].label;
};
</script>

<template>
    <ul class="mb-5.5 mt-4 flex flex-col gap-2.5 pl-6">
        <template v-for="(childItem, index) in items" :key="index">
            <li>
                <Link
                    :class="{'!text-white': childItem.label === sidebarStore.selected}"
                    :href="childItem.route"
                    class="group relative flex items-center gap-2.5 rounded-md px-4 font-medium text-bodydark2 duration-300 ease-in-out hover:text-white"
                    @click="handleItemClick(index)"
                >
                    {{ childItem.label }}
                </Link>
            </li>
        </template>
    </ul>
</template>
