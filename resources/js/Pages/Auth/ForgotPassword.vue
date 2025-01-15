<script lang="ts" setup>
import {Head, Link, useForm} from '@inertiajs/vue3';
import GuestLayout from '@/Layouts/GuestAuthLayout.vue';
import InputBox from '@/Components/Form/InputBox.vue';
import VButton from '@/Components/VButton.vue';

const form = useForm({
    email: '',
});

function submit() {
    form.post(route('password.email'));
}
</script>

<template>
    <Head title="Giriş Yap" />

    <GuestLayout>
        <div class="mx-auto bg-white p-10 shadow-md sm:max-w-xl sm:rounded-lg">
            <span class="mb-1.5 block font-medium">En iyi ilanları kaçırma.</span>

            <h2 class="mb-9 text-2xl font-bold text-black dark:text-white sm:text-title-xl2">
                Şifremi Sıfırla
            </h2>

            <form class="space-y-4" @submit.prevent="submit">
                <InputBox
                    v-model="form.email"
                    :error="form.errors.email"
                    class="col-span-full lg:col-span-1"
                    label="E-Posta Adresi"
                    type="email"
                />

                <VButton block type="submit">Sıfırlama Bağlantısı Gönder</VButton>

                <div class="mt-6 text-center">
                    <Link :href="route('login')" class="font-medium text-primary hover:underline"
                        >Giriş ekranına dön
                    </Link>
                </div>
            </form>
        </div>
    </GuestLayout>
</template>
