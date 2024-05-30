<script setup>
import { computed, defineProps, ref, reactive } from 'vue';
import Checkbox from '@/Components/Checkbox.vue';
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import Swal from 'sweetalert2';

// Define props
const props = defineProps({
    canResetPassword: {
        type: Boolean,
    },
    status: {
        type: String,
    },
    errors: Object,
});

// Reactive state for CAPTCHA
const captcha = reactive({
    question: '',
    answer: 0
});
let captchaInput = '';

// Generate CAPTCHA
function generateCaptcha() {
    const num1 = Math.floor(Math.random() * 10) + 1;
    const num2 = Math.floor(Math.random() * 10) + 1;
    captcha.question = `${num1} x ${num2}?`;
    captcha.answer = num1 * num2;
}

// Form state
const form = useForm({
    email: '',
    password: '',
    remember: false,
});

// Form submit handler with CAPTCHA and SweetAlert
function submit() {
    if (parseInt(captchaInput) === captcha.answer) {
        form.post(route('login'), {
            onFinish: () => {
                form.reset('password');
                if (!form.hasErrors()) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Login Successful',
                        text: 'You have successfully logged in!',
                    });
                }
            },
        });
    } else {
        Swal.fire({
            icon: 'error',
            title: 'Captcha Incorrect',
            text: 'Try Again!',
        });
        generateCaptcha();
    }
}

// Login with Google
function loginWithGoogle() {
    window.location.href = "/authorized/google";
}

// Initial CAPTCHA generation
generateCaptcha();

// Password visibility toggle
const showPassword = ref(false);
function togglePasswordVisibility() {
    showPassword.value = !showPassword.value;
}
</script>

<template>

    <body class="body-login">
        <div class="card3 jarakm">
            <div class="card2">
                <div class="card-body">
                    <div class="border p-4 rounded">
                        <div class="text-center">
                            <h4 class="ch4">Login</h4>
                            <br><br>
                        </div>
                        <form class="row g-3" @submit.prevent="submit">
                            <!-- <div v-if="errors.username" class="text-danger">{{ errors.username }}
								</div> -->
                            <!-- <div v-if="$page.props.flash.message" class="alert alert-success">
									{{ $page.props.flash.message }}
								</div> -->
                            <div class="col-12">
                                <input class="form-control" id="email" type="email" v-model="form.email" required
                                    placeholder="Enter Email" />
                                <InputError class="mt-2" :message="errors.email" />
                            </div>
                            <div class="col-12 c-mlk10">
                                <div class="input-group" id="show_hide_password">
                                    <input class="form-control border-end-0" id="password"
                                        :type="showPassword ? 'text' : 'password'" v-model="form.password" required
                                        placeholder="Enter Password" />
                                    <InputError class="mt-2" :message="errors.password" />
                                    <a href="javascript:;" class="input-group-text bg-transparent"
                                        @click="togglePasswordVisibility">
                                        <i :class="showPassword ? 'bx bx-show' : 'bx bx-hide'"></i>
                                    </a>

                                </div>
                            </div>
                            <div class="col-md-6 jarak-top-lebih4">
                            </div>
                            <div class="d-grid jarak-top-lebih10">
                                <label class="c-mr-5">Hasil Dari</label>
                                <label for="captcha" class="form-label">{{ captcha.question }}</label>
                                <div class="input-group">
                                    <input v-model="captchaInput" type="text" class="form-control" id="captcha"
                                        placeholder="Enter Captcha">
                                </div>
                            </div>
                            <Link v-if="canResetPassword" :href="route('password.request')" class="ml240">
                            Lupa Password?
                            </Link>
                            <div class="col-12">
                                <div class="d-grid jarak-top-kurang5">
                                    <button type="submit" class="btn btn-primary w-100"><i
                                            class='bx bx-lock-open'></i>Masuk</button>
                                </div>
                                <div class="login-separater text-center mb-4 jarak-top-kurang15">
                                    <span>ATAU MASUK DENGAN EMAIL</span>
                                    <hr />
                                </div>
                                <div class="d-grid jarak-top-kurang4">
                                    <a class="btn shadow-sm btn-white" href="#" @click="loginWithGoogle">
                                        <span class="d-flex justify-content-center align-items-center">
                                            <img class="me-2" src="../../../../public/assets/images/icons/search.svg"
                                                width="16" alt="Image Description">
                                            <span>Masuk dengan Google</span>
                                        </span>
                                    </a>
                                </div>
                                <div class="text-center jarak-top-kurang10">
                                    <br>
                                    <p>
                                        Belum punya akun?
                                        <a :href="route('register')">Daftar disini</a>
                                    </p>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!--end row-->
                </div>
            </div>
        </div>
    </body>
</template>
