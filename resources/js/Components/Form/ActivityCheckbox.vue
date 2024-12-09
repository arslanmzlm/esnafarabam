<script lang="ts" setup>
import Checkbox from '@/Components/Form/Checkbox.vue';

const model = defineModel<boolean>({required: true});
</script>

<template>
    <div>
        <Checkbox v-model="model" label="Aktif" name="activityCheckbox" required />
        <p class="mt-2">
            <small
                >Kullanıcılar sadece aktif verileri görüntüleyebilir ve onlarla işlem yapabilir. Bu
                verinin tüm işlemlere açık olması için bu seçeneği seçiniz diğer durumda veri sadece
                yöneticilere görünecektir.</small
            >
        </p>
    </div>
</template>
