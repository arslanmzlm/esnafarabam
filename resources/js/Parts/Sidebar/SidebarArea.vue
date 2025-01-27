<script lang="ts" setup>
import {Link, usePage} from '@inertiajs/vue3';
import {onClickOutside} from '@vueuse/core';
import {computed, ref} from 'vue';
import {useSidebarStore} from '@/Stores/sidebar';
import BuildingIcon from '@/Icons/BuildingIcon.vue';
import CarIcon from '@/Icons/CarIcon.vue';
import ClipboardListAltIcon from '@/Icons/ClipboardListAltIcon.vue';
import ExternalLinkIcon from '@/Icons/ExternalLinkIcon.vue';
import FileInfoAltIcon from '@/Icons/FileInfoAltIcon.vue';
import FolderImageIcon from '@/Icons/FolderImageIcon.vue';
import GearIcon from '@/Icons/GearIcon.vue';
import GridHorizontalIcon from '@/Icons/GridHorizontalIcon.vue';
import MapIcon from '@/Icons/MapIcon.vue';
import SlidersHorizontalIcon from '@/Icons/SlidersHorizontalIcon.vue';
import SquareSlidersVerticalIcon from '@/Icons/SquareSlidersVerticalIcon.vue';
import UserCheckIcon from '@/Icons/UserCheckIcon.vue';
import UserShieldIcon from '@/Icons/UserShieldIcon.vue';
import UsersIcon from '@/Icons/UsersIcon.vue';
import WarehouseIcon from '@/Icons/WarehouseIcon.vue';
import SidebarItem from './SidebarItem.vue';

const sidebarStore = useSidebarStore();

const target = ref(null);
onClickOutside(target, () => {
    sidebarStore.isSidebarOpen = false;
});

const logo = computed(() => {
    return window.logo_dark;
});

const page = usePage();
const abilities = page.props.auth.abilities;
const isRoot = page.props.auth.user.role?.root ?? false;
const menu: MenuRow[] = [];

interface MenuRow {
    name: string;
    menuItems: {
        icon: any;
        label: string;
        route: string;
    }[];
}

// VEHICLE

if (
    isRoot ||
    abilities.includes('admin.vehicle.type.list') ||
    abilities.includes('admin.brand.list') ||
    abilities.includes('admin.vehicle.list')
) {
    const row: MenuRow = {
        name: 'TAŞIT',
        menuItems: [],
    };

    if (isRoot || abilities.includes('admin.vehicle.type.list')) {
        row.menuItems.push({
            icon: WarehouseIcon,
            label: 'Taşıt Türleri',
            route: route('admin.vehicle.type.list'),
        });
    }

    if (isRoot || abilities.includes('admin.brand.list')) {
        row.menuItems.push({
            icon: BuildingIcon,
            label: 'Markalar',
            route: route('admin.brand.list'),
        });
    }

    if (isRoot || abilities.includes('admin.vehicle.list')) {
        row.menuItems.push({
            icon: CarIcon,
            label: 'Taşıtlar',
            route: route('admin.vehicle.list'),
        });
    }

    menu.push(row);
}

// ATTRIBUTE

if (
    isRoot ||
    abilities.includes('admin.attribute.category.list') ||
    abilities.includes('admin.attribute.list')
) {
    const row: MenuRow = {
        name: 'ÖZELLİK',
        menuItems: [],
    };

    if (isRoot || abilities.includes('admin.attribute.category.list')) {
        row.menuItems.push({
            icon: SquareSlidersVerticalIcon,
            label: 'Kategoriler',
            route: route('admin.attribute.category.list'),
        });
    }

    if (isRoot || abilities.includes('admin.attribute.list')) {
        row.menuItems.push({
            icon: SlidersHorizontalIcon,
            label: 'Özellikler',
            route: route('admin.attribute.list'),
        });
    }

    menu.push(row);
}

// ITEM

if (
    isRoot ||
    abilities.includes('admin.vehicle.select') ||
    abilities.includes('admin.item.list') ||
    abilities.includes('admin.item.grid')
) {
    const row: MenuRow = {
        name: 'İLAN',
        menuItems: [],
    };

    if (isRoot || abilities.includes('admin.vehicle.select')) {
        row.menuItems.push({
            icon: ExternalLinkIcon,
            label: 'Taşıt Seçimi',
            route: route('admin.vehicle.select'),
        });
    }

    if (isRoot || abilities.includes('admin.item.list')) {
        row.menuItems.push({
            icon: ClipboardListAltIcon,
            label: 'İlanlar (Tablo)',
            route: route('admin.item.list'),
        });
    }

    if (isRoot || abilities.includes('admin.item.grid')) {
        row.menuItems.push({
            icon: GridHorizontalIcon,
            label: 'İlanlar (Liste)',
            route: route('admin.item.grid'),
        });
    }

    menu.push(row);
}

// USER

if (
    isRoot ||
    abilities.includes('admin.user.list') ||
    abilities.includes('admin.user.pending.list') ||
    abilities.includes('admin.role.list')
) {
    const row: MenuRow = {
        name: 'KULLANICI',
        menuItems: [],
    };

    if (isRoot || abilities.includes('admin.user.list')) {
        row.menuItems.push({
            icon: UsersIcon,
            label: 'Kullanıcılar',
            route: route('admin.user.list'),
        });
    }

    if (isRoot || abilities.includes('admin.user.pending.list')) {
        row.menuItems.push({
            icon: UserCheckIcon,
            label: 'Bekleyen Kullanıcılar',
            route: route('admin.user.pending.list'),
        });
    }

    if (isRoot || abilities.includes('admin.role.list')) {
        row.menuItems.push({
            icon: UserShieldIcon,
            label: 'Yetkiler',
            route: route('admin.role.list'),
        });
    }

    menu.push(row);
}

// LOCATION

if (
    isRoot ||
    abilities.includes('admin.province.list') ||
    abilities.includes('admin.district.list') ||
    abilities.includes('admin.neighborhood.list')
) {
    const row: MenuRow = {
        name: 'KONUM',
        menuItems: [],
    };

    if (isRoot || abilities.includes('admin.province.list')) {
        row.menuItems.push({
            icon: MapIcon,
            label: 'İller',
            route: route('admin.province.list'),
        });
    }

    if (isRoot || abilities.includes('admin.district.list')) {
        row.menuItems.push({
            icon: MapIcon,
            label: 'İlçeler',
            route: route('admin.district.list'),
        });
    }

    if (isRoot || abilities.includes('admin.neighborhood.list')) {
        row.menuItems.push({
            icon: MapIcon,
            label: 'Mahalleler',
            route: route('admin.neighborhood.list'),
        });
    }

    menu.push(row);
}

// MANAGEMENT

if (
    isRoot ||
    abilities.includes('admin.page.list') ||
    abilities.includes('admin.banner.list') ||
    abilities.includes('admin.setting.edit')
) {
    const row: MenuRow = {
        name: 'YÖNETİM',
        menuItems: [],
    };

    if (isRoot || abilities.includes('admin.page.list')) {
        row.menuItems.push({
            icon: FileInfoAltIcon,
            label: 'Sayfalar',
            route: route('admin.page.list'),
        });
    }

    if (isRoot || abilities.includes('admin.banner.list')) {
        row.menuItems.push({
            icon: FolderImageIcon,
            label: 'Bannerlar',
            route: route('admin.banner.list'),
        });
    }

    if (isRoot || abilities.includes('admin.setting.edit')) {
        row.menuItems.push({
            icon: GearIcon,
            label: 'Site Ayarları',
            route: route('admin.setting.edit'),
        });
    }

    menu.push(row);
}

const menuGroups = ref<MenuRow[]>(menu);
</script>

<template>
    <aside
        ref="target"
        :class="{
            'translate-x-0': sidebarStore.isSidebarOpen,
            '-translate-x-full': !sidebarStore.isSidebarOpen,
        }"
        class="absolute left-0 top-0 z-9999 flex h-screen w-72.5 flex-col overflow-y-hidden bg-black duration-300 ease-linear dark:bg-boxdark lg:static lg:translate-x-0"
    >
        <!-- SIDEBAR HEADER -->
        <div class="flex items-center justify-between gap-2 px-6 py-5.5 lg:py-6.5">
            <Link :href="route('admin.dashboard')">
                <img :src="logo" alt="Logo" />
            </Link>

            <button class="block lg:hidden" @click="sidebarStore.isSidebarOpen = false">
                <svg
                    class="fill-current"
                    fill="none"
                    height="18"
                    viewBox="0 0 20 18"
                    width="20"
                    xmlns="http://www.w3.org/2000/svg"
                >
                    <path
                        d="M19 8.175H2.98748L9.36248 1.6875C9.69998 1.35 9.69998 0.825 9.36248 0.4875C9.02498 0.15 8.49998 0.15 8.16248 0.4875L0.399976 8.3625C0.0624756 8.7 0.0624756 9.225 0.399976 9.5625L8.16248 17.4375C8.31248 17.5875 8.53748 17.7 8.76248 17.7C8.98748 17.7 9.17498 17.625 9.36248 17.475C9.69998 17.1375 9.69998 16.6125 9.36248 16.275L3.02498 9.8625H19C19.45 9.8625 19.825 9.4875 19.825 9.0375C19.825 8.55 19.45 8.175 19 8.175Z"
                        fill=""
                    />
                </svg>
            </button>
        </div>
        <!-- SIDEBAR HEADER -->

        <div class="no-scrollbar flex flex-col overflow-y-auto duration-300 ease-linear">
            <!-- Sidebar Menu -->
            <nav class="mt-5 px-4 py-4 lg:mt-9 lg:px-6">
                <template v-for="menuGroup in menuGroups" :key="menuGroup.name">
                    <div>
                        <h3 class="mb-4 ml-4 text-sm font-medium text-bodydark2">
                            {{ menuGroup.name }}
                        </h3>

                        <ul class="mb-6 flex flex-col gap-1.5">
                            <SidebarItem
                                v-for="(menuItem, index) in menuGroup.menuItems"
                                :key="index"
                                :index="index"
                                :item="menuItem"
                            />
                        </ul>
                    </div>
                </template>
            </nav>
            <!-- Sidebar Menu -->
        </div>
    </aside>
</template>
