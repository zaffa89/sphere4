<script setup>
import { computed } from 'vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import JetAuthenticationCard from '@/Jetstream/AuthenticationCard.vue';
import JetAuthenticationCardLogo from '@/Jetstream/AuthenticationCardLogo.vue';
import JetButton from '@/Jetstream/Button.vue';

const props = defineProps({
    status: String,
});

const form = useForm();

const submit = () => {
    form.post(route('verification.send'));
};

const verificationLinkSent = computed(() => props.status === 'verification-link-sent');
</script>

<template>
    <Head title="Email Verification" />

    <JetAuthenticationCard>
        <template #logo>
            <JetAuthenticationCardLogo />
        </template>

        <div class="mb-4 text-sm text-gray-600">
            Prima di continuare, devi verificare il tuo indirizzo email cliccando sul link nella mail che ti abbiamo appena inviato. Se non l'hai ricevuta, puoi richiederne un altra
            <!-- Before continuing, could you verify your email address by clicking on the link we just emailed to you? If you didn't receive the email, we will gladly send you another.-->
        </div>

        <div v-if="verificationLinkSent" class="mb-4 font-medium text-sm text-green-600">
            Una nuova mail di verifica è stata inviata al tuo indirizzo email
            <!-- A new verification link has been sent to the email address you provided in your profile settings.-->
        </div>

        <form @submit.prevent="submit">
            <div class="mt-4 flex items-center justify-between">
                <JetButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Richiedi nuova mail di verifica
                </JetButton>

                <div>
                    <Link
                        :href="route('profile.show')"
                        class="underline text-sm text-gray-600 hover:text-gray-900"
                    >
                        Profilo utente</Link>

                    <Link
                        :href="route('logout')"
                        method="post"
                        as="button"
                        class="underline text-sm text-gray-600 hover:text-gray-900 ml-2"
                    >
                        Esci
                    </Link>
                </div>
            </div>
        </form>
    </JetAuthenticationCard>
</template>
