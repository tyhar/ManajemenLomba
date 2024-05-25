<template>

    <body class="body-loginnew">
        <div class="card3 jarakm">
            <div class="card2">
                <div class="card-body">
                    <div class="border p-4 rounded">
                        <div class="text-center">
                            <h4>Verify Your Email Address</h4>
                            <br>
                            <div v-if="verificationLinkSent">
                                A new verification link has been sent to the email address you provided during
                                registration.
                            </div>
                            <div v-else>
                                Thanks for signing up! Before getting started, could you verify your email address by
                                clicking on the link we just emailed to you? If you didn't receive the email, we will
                                gladly send you another.
                            </div>
                            <br>
                            <form @submit.prevent="submit">
                                <button type="submit" :disabled="verificationLinkSent" class="btn btn-primary c-mb-8">
                                    Resend Verification Email
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</template>
<script>
export default {
    data() {
        return {
            verificationLinkSent: false
        }
    },

    methods: {
        submit() {
            this.$inertia.post('/email/verification-notification')
                .then(() => this.verificationLinkSent = true)
        }
    }
}
</script>