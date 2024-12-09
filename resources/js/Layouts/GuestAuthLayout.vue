<script lang="ts" setup>
import {Link} from '@inertiajs/vue3';
</script>

<template>
    <div class="bg-gray-100 flex min-h-screen flex-col items-center pt-6 sm:justify-center sm:pt-0">
        <div>
            <Link href="/">
                <img
                    alt="Logo"
                    class="text-gray-500 h-20 w-20 fill-current"
                    src="@/Images/logo/logo-icon.png"
                />
            </Link>
        </div>

        <main class="mt-6 w-full">
            <slot />
        </main>
    </div>
</template>
