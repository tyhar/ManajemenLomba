<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { reactive, ref, onMounted } from 'vue';
import Swal from 'sweetalert2';
import axios from 'axios';
import { router } from '@inertiajs/vue3';

const form = useForm({
    name: '',
    username: '',
    email: '',
    password: '',
    password_confirmation: '',
    captcha: ''
});

const showPassword = ref(false);
const showPasswordConfirmation = ref(false);

const togglePasswordVisibility = () => {
    showPassword.value = !showPassword.value;
};

const togglePasswordConfirmationVisibility = () => {
    showPasswordConfirmation.value = !showPasswordConfirmation.value;
};

const usernameError = ref('');
const emailError = ref('');

const submit = () => {
    form.captcha = captchaInput.value;
    form.post(route('register'), {
        onFinish: () => {
            form.reset('password', 'password_confirmation');
            if (!form.hasErrors()) {
                Swal.fire({
                    icon: 'success',
                    title: 'Registration Successful!',
                    text: 'Your account has been successfully registered.',
                    confirmButtonText: 'OK'
                });
            } else {
                generateCaptcha();
            }
        },
        onError: (errors) => {
            if (errors.email) {
                emailError.value = 'Email Sudah Terdaftar';
            } else {
                emailError.value = '';
            }
            if (errors.username) {
                usernameError.value = 'Username Sudah Ada';
            } else {
                usernameError.value = '';
            }
            Swal.fire({
                icon: 'error',
                title: 'Registrasi gagal',
                text: 'Silahkan Periksa Kembali',
            });
        },
    });
};

const captcha = reactive({
    image: '',
    key: '',
});
const captchaInput = ref('');

async function generateCaptcha() {
    try {
        const response = await axios.get('/captcha-image');
        captcha.image = response.data.captcha + '&' + Date.now(); // Avoid caching
    } catch (error) {
        console.error('Error fetching CAPTCHA:', error);
    }
}

function loginWithGoogle() {
    window.location.href = "/authorized/google";
}

onMounted(() => {
    generateCaptcha();
});
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
                                <div class="mt-2 text-danger">{{ usernameError }}</div>
                            </div>
                            <div class="col-12">
                                <label for="inputEmailAddress" class="form-label warna-hitam jb-k5">Email</label>
                                <input v-model="form.email" type="email" class="form-control" placeholder="Enter Email">
                                <div class="mt-2 text-danger">{{ emailError }}</div>
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
                                <label class="c-mr-5">CAPTCHA</label>
                                <div>
                                    <img :src="captcha.image" alt="CAPTCHA">
                                    <button type="button" @click="generateCaptcha">Refresh</button>
                                </div>
                                <input v-model="captchaInput" type="text" class="form-control" id="captcha" required placeholder="Enter CAPTCHA">
                                <InputError class="mt-2" :message="form.errors.captcha" />
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
