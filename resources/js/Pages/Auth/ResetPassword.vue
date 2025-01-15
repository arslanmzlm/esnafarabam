<script lang="ts" setup>
import {Head, useForm} from '@inertiajs/vue3';
import GuestLayout from '@/Layouts/GuestAuthLayout.vue';
import InputBox from '@/Components/Form/InputBox.vue';
import InvalidFeedback from '@/Components/Form/InvalidFeedback.vue';
import VButton from '@/Components/VButton.vue';

const props = defineProps<{
    email: string;
    token: string;
}>();

const form = useForm({
    email: props.email,
    token: props.token,
    password: '',
    password_confirmation: '',
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
                    v-model="form.password"
                    :error="form.errors.password"
                    label="Şifre"
                    required
                    type="password"
                />

                <InputBox
                    v-model="form.password_confirmation"
                    :error="form.errors.password_confirmation"
                    label="Şifre (Tekrar)"
                    required
                    type="password"
                />

                <InvalidFeedback
                    v-if="
                        form.hasErrors &&
                        !form.errors.password &&
                        !form.errors.password_confirmation
                    "
                    message="Şifre sıfırlama bağlantısı doğrulanamadı. Lütfen yeni bir bağlantı alınız."
                />

                <VButton block type="submit">Şifreyi Sıfırla</VButton>
            </form>
        </div>
    </GuestLayout>
</template>
