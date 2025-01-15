<script lang="ts" setup></script>

<template>
    <div class="bg-gray-100 flex min-h-screen flex-col items-center pt-6 sm:justify-center sm:pt-0">
        <div>
            <a href="/">
                <img
                    alt="Logo"
                    class="text-gray-500 h-20 w-20 fill-current"
                    src="@/Images/logo/logo-icon.png"
                />
            </a>
        </div>

        <main class="mt-6 w-full px-2">
            <slot />
        </main>
    </div>
</template>
