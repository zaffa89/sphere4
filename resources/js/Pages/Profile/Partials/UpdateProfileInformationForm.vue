<script setup>
import { ref } from 'vue';

import { Link, useForm } from '@inertiajs/vue3';
import JetFormSection from '@/Jetstream/FormSection.vue';
import JetInput from '@/Jetstream/Input.vue';
import JetInputError from '@/Jetstream/InputError.vue';
import JetLabel from '@/Jetstream/Label.vue';

const props = defineProps({
    user: Object,
});

const form = useForm({
    _method: 'PUT',
    username: props.user.username,
    email: props.user.email,
    telefono: props.user.telefono
});

const verificationLinkSent = ref(null);

const sendEmailVerification = () => {
    verificationLinkSent.value = true;
};

</script>

<template>
    <JetFormSection>
        <template #title>
            Profilo utente
        </template>

        <template #description>
            
        </template>

        <template #form>
    
            <!-- Name -->
            <div class="col-span-6 sm:col-span-4">
                <JetLabel for="username" value="Nome utente" />
                <JetInput
                    id="username"
                    v-model="form.username"
                    type="text"
                    class="mt-1 block w-full"
                    autocomplete="username"
                    disabled
                />
                <JetInputError :message="form.errors.username" class="mt-2" />
            </div>

            <div class="col-span-6 sm:col-span-4">
                <JetLabel for="telefono" value="Telefono" />
                <JetInput
                    id="telefono"
                    v-model="form.telefono"
                    type="text"
                    class="mt-1 block w-full"
                    autocomplete="telefono"
                    disabled
                />
                <JetInputError :message="form.errors.telefono" class="mt-2" />
            </div>

            <!-- Email -->
            <div class="col-span-6 sm:col-span-4">
                <JetLabel for="email" value="Email" />
                <JetInput
                    id="email"
                    v-model="form.email"
                    type="email"
                    class="mt-1 block w-full"
                    disabled
                />
                <JetInputError :message="form.errors.email" class="mt-2" />

                <div v-if="$page.props.jetstream.hasEmailVerification && user.email_verified_at === null">
                    <p class="text-sm mt-2 text-red-600">
                        Questo indirizzo email non è stato verificato.

                        <Link
                            :href="route('verification.send')"
                            method="post"
                            as="button"
                            class="underline text-gray-600 hover:text-gray-900"
                            @click.prevent="sendEmailVerification"
                        >
                            Clicca qui per ricevere una mail di verifica.
                        </Link>
                    </p>

                    <div v-show="verificationLinkSent" class="mt-2 font-medium text-sm text-green-600">
                        Un link di verifica è stato inviato al tuo indirizzo email.
                    </div>
                </div>
            </div>
        </template>
    </JetFormSection>
</template>
