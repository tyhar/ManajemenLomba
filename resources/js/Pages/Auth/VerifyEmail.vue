<script setup>
import { computed } from 'vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

const props = defineProps({
    status: {
        type: String,
    },
});

const form = useForm({});

const submit = () => {
    form.post(route('verification.send'));
};

const verificationLinkSent = computed(() => props.status === 'verification-link-sent');
</script>

<template>
    <div class="container mt-5">

        <Head title="Email Verification" />

        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <h2 class="mb-4 card-title">Email Verification</h2>

                        <div class="alert alert-info">
                            Thanks for signing up! Before getting started, could you verify your email address by
                            clicking on the link
                            we just emailed to you? If you didn't receive the email, we will gladly send you another.
                        </div>

                        <div class="alert alert-success" v-if="verificationLinkSent">
                            A new verification link has been sent to the email address you provided during registration.
                        </div>

                        <form @submit.prevent="submit">
                            <div class="mt-4 d-flex justify-content-between align-items-center">
                                <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing"
                                    class="btn btn-primary">
                                    Resend Verification Email
                                </PrimaryButton>

                                <Link :href="route('logout')" method="post" as="button"
                                    class="btn btn-link text-decoration-none text-secondary">Log Out</Link>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>
.btn-primary {
    background-color: #00008b;
    /* Dark blue */
    border-color: #00008b;
}

.btn-primary:disabled {
    opacity: 0.6;
}
</style>