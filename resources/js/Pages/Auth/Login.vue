<script lang="ts" setup>
import {Head, Link, useForm} from '@inertiajs/vue3';
import GuestLayout from '@/Layouts/GuestAuthLayout.vue';
import InputBox from '@/Components/Form/InputBox.vue';
import VButton from '@/Components/VButton.vue';

const form = useForm({
    email: '',
    password: '',
});

function submit() {
    form.post(route('login.store'));
}
</script>

<template>
    <Head title="Giriş Yap" />

    <GuestLayout>
        <div class="mx-auto bg-white p-10 shadow-md sm:max-w-xl sm:rounded-lg">
            <span class="mb-1.5 block font-medium">En iyi ilanları kaçırma.</span>

            <h2 class="mb-9 text-2xl font-bold text-black dark:text-white sm:text-title-xl2">
                Esnaf Arabama Giriş Yap
            </h2>

            <form class="space-y-4" @submit.prevent="submit">
                <InputBox
                    v-model="form.email"
                    :error="form.errors.email"
                    class="col-span-full lg:col-span-1"
                    label="E-Posta Adresi"
                    type="email"
                />

                <InputBox
                    v-model="form.password"
                    :error="form.errors.password"
                    label="Şifre"
                    type="password"
                />

                <div class="font-medium">
                    Şifreni mi unuttun?
                    <Link :href="route('password.request')" class="text-primary hover:underline">
                        Şifreni sıfırla
                    </Link>
                </div>

                <VButton block type="submit">Giriş Yap</VButton>

                <div class="mt-6 text-center">
                    <p class="font-medium">
                        Hesabın yok mu?
                        <Link :href="route('register')" class="text-primary hover:underline"
                            >Hemen kaydol
                        </Link>
                    </p>
                </div>
            </form>
        </div>
    </GuestLayout>
</template>
