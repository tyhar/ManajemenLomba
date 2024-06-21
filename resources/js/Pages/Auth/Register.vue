<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { reactive, ref, onMounted } from 'vue';
import Swal from 'sweetalert2';
import { router } from '@inertiajs/vue3';

const form = useForm({
    name: '',
    username: '',
    email: '',
    password: '',
    password_confirmation: '',
    'g-recaptcha-response': '', // Add this
});

const showPassword = ref(false);
const showPasswordConfirmation = ref(false);

const togglePasswordVisibility = () => {
    showPassword.value = !showPassword.value;
};

const togglePasswordConfirmationVisibility = () => {
    showPasswordConfirmation.value = !showPasswordConfirmation.value;
};

const submit = () => {
    // Ensure reCAPTCHA response is set before submitting
    if (form['g-recaptcha-response'] === '') {
        Swal.fire({
            icon: 'error',
            title: 'Captcha Verification Failed',
            text: 'Please complete the reCAPTCHA verification.',
            confirmButtonText: 'OK'
        });
        return;
    }

    form.post(route('register'), {
        onFinish: () => {
            form.reset('password', 'password_confirmation');
            Swal.fire({
                icon: 'success',
                title: 'Registration Successful!',
                text: 'Your account has been successfully registered.',
                confirmButtonText: 'OK'
            });
        },
    });
};

// Handle callback from reCAPTCHA
const onRecaptchaSuccess = (response) => {
    form['g-recaptcha-response'] = response;
};

// Initialize reCAPTCHA and bind callback
onMounted(() => {
    window.onRecaptchaSuccess = onRecaptchaSuccess;
});

function loginWithGoogle() {
    window.location.href = "/authorized/google";
}

// Export site key for use in the template
const yourSiteKey = '6LdT7_0pAAAAAKThZpv3zh14SNXQt2cpCzTSD2Eb';
</script>

<template>
    <body class="body-login">
        <div class="card3 jarakm">
            <div class="card2">
                <div class="card-body">
                    <div class="border p-4 rounded">
                        <div class="text-center">
                            <h3>Buat Akun</h3>
                        </div>
                        <br>
                        <form class="row g-3" @submit.prevent="submit">
                            <div class="col-12">
                                <label for="inputEmailAddress" class="form-label warna-hitam jb-k5">Full Name</label>
                                <input v-model="form.name" type="text" class="form-control jb-k5" id="inputNamaLengkap"
                                    placeholder="Enter Full Name">
                            </div>
                            <div class="col-12">
                                <label for="inputUsername" class="form-label warna-hitam jb-k5">Username</label>
                                <input v-model="form.username" type="text" class="form-control jb-k5" id="inputUsername"
                                    placeholder="Enter Username">
                            </div>
                            <div class="col-12">
                                <label for="inputEmailAddress" class="form-label warna-hitam jb-k5">Email</label>
                                <input v-model="form.email" type="email" class="form-control" placeholder="Enter Email">
                                <InputError class="mt-2" :message="form.errors.email" />
                            </div>
                            <div class="col-12 jarak-top-lebih10">
                                <label for="password" value="Password" class="form-label warna-hitam jb-k5">Password</label>
                                <div class="input-group" id="show_hide_password">
                                    <input id="password" v-model="form.password" required :type="showPassword ? 'text' : 'password'" class="form-control border-end-0" placeholder="Enter Password" autofocus autocomplete="new-password">
                                    <a href="javascript:;" class="input-group-text bg-transparent" @click="togglePasswordVisibility">
                                        <i :class="showPassword ? 'bx bx-show' : 'bx bx-hide'"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="col-12 jarak-top-lebih10">
                                <label for="password_confirmation" value="Password" class="form-label warna-hitam jb-k5">Confirm Password</label>
                                <div class="input-group" id="show_hide_password_confirmation">
                                    <input id="password_confirmation" v-model="form.password_confirmation" required :type="showPasswordConfirmation ? 'text' : 'password'" class="form-control border-end-0" placeholder="Enter Password Again" autofocus autocomplete="new-password">
                                    <a href="javascript:;" class="input-group-text bg-transparent" @click="togglePasswordConfirmationVisibility">
                                        <i :class="showPasswordConfirmation ? 'bx bx-show' : 'bx bx-hide'"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="col-12 jarak-top-lebih10">
                                <!-- Add reCAPTCHA element here -->
                                <div class="g-recaptcha" :data-sitekey="yourSiteKey" data-callback="onRecaptchaSuccess"></div>
                                <InputError class="mt-2" :message="form.errors['g-recaptcha-response']" />
                            </div>
                            <div class="col-12 jarak-top-lebih12">
                                <div class="d-grid">
                                    <button class="btn btn-primary w-100" :disabled="form.processing">
                                        <i class='bx bx-user'></i>Register
                                    </button>
                                </div>
                                <div class="login-separater text-center mb-4 jarak-top-kurang18">
                                    <span>OR LOGIN WITH EMAIL</span>
                                    <hr />
                                </div>
                                <div class="d-grid jarak-top-kurang10">
                                    <a class="btn shadow-sm btn-white" href="javascript:;" @click="loginWithGoogle">
                                        <span class="d-flex justify-content-center align-items-center">
                                            <img class="me-2" src="../../../../public/assets/images/icons/search.svg" width="16" alt="Image Description">
                                            <span>Login with Google</span>
                                        </span>
                                    </a>
                                </div>
                                <div class="text-center jarak-top-kurang12">
                                    <br>
                                    <p>
                                        Already have an account?
                                        <a :href="route('login')">Login disini</a>
                                    </p>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!--end row-->
    </body>
</template>
