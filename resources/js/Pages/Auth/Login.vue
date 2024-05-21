<script setup>
//from backend
import Checkbox from '@/Components/Checkbox.vue';
// import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
// import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
// import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

//from frontend
import { reactive } from 'vue'
import { router } from '@inertiajs/vue3'

defineProps({
    //from backend
    canResetPassword: {
        type: Boolean,
    },
    status: {
        type: String,
    },
    //from frontend
    errors: Object, // Corrected typo in prop name
});

//from backend
const form = useForm({
    email: '',
    password: '',
    remember: false,
});
const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};

//from frontend
$(document).ready(function () {
    $("#show_hide_password a").on('click', function (event) {
        event.preventDefault();
        if ($('#show_hide_password input').attr("type") == "text") {
            $('#show_hide_password input').attr('type', 'password');
            $('#show_hide_password i').addClass("bx-hide");
            $('#show_hide_password i').removeClass("bx-show");
        } else if ($('#show_hide_password input').attr("type") == "password") {
            $('#show_hide_password input').attr('type', 'text');
            $('#show_hide_password i').removeClass("bx-hide");
            $('#show_hide_password i').addClass("bx-show");
        }
    });
});
</script>

<template>
    <section style="background: url(../assets/images/login-images/bg-forgot-password.jpg);">
        <div class="wrapper">
            <div class="section-authentication-signin d-flex justify-content-center my-5 my-lg-1">
                <div class="container-fluid jarak-top-lebih10">
                    <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-3">
                        <div class="col mx-auto" style="padding-top: 90px;">
                            <div class="card">
                                <div class="card-body">
                                    <div class="border p-4 rounded">
                                        <div class="text-center">
                                            <h3>Login</h3>
                                            <br>
                                        </div>
                                        <div class="form-body">
                                            <form class="row g-3" @submit.prevent="submit">
                                                <div class="col-12">
                                                    <label for="email" class="form-label">Email</label>
                                                    <input class="form-control"
                                                        id="email"
                                                        type="email"
                                                        v-model="form.email"
                                                        required
                                                        autofocus
                                                        autocomplete="username"
                                                        placeholder="Enter Email" 
                                                    />
                                                    <InputError class="mt-2" :message="errors.email" /> <!-- Corrected prop reference -->
                                                </div>
                                                <div class="col-12">
                                                    <label for="password" class="form-label">Password</label>
													<div class="input-group" id="show_hide_password">
														<input class="form-control border-end-0"
															id="password"
															type="password"  
															v-model="form.password"
															required
															placeholder="Enter Password" 
															autocomplete="current-password"
														/> 
														<InputError class="mt-2" :message="errors.password" /> <!-- Corrected prop reference -->
														<a href="javascript:;" class="input-group-text bg-transparent"><i class='bx bx-hide'></i></a>
													</div>
                                                </div>
                                                <div class="col-md-6 jarak-top-lebih4">
                                                    <!-- <div class="form-check form-switch">
                                                        <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked">
                                                        <label class="form-check-label check-login" for="flexSwitchCheckChecked">Ingatkan saya</label>
                                                    </div> -->
                                                </div>
                                                <div class="col-md-6 text-end jarak-top-lebih7">
                                                    <Link
                                                        v-if="canResetPassword"
                                                        :href="route('password.request')"
                                                        class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                                                    >
                                                        Lupa Password?
                                                    </Link>
                                                </div>
                                                <!-- <div class="d-grid jarak-top-lebih10">
                                                    <a class="btn shadow-sm btn-white" href="javascript:;">
                                                        <span>Captcha</span>
                                                    </a>
                                                </div> -->
                                                <div class="col-12">
                                                    <div class="d-grid jarak-top-kurang5">
                                                        <button class="btn btn-primary" :disabled="form.processing">
                                                            <i class='bx bx-user'></i>
                                                            Log in
                                                        </button>
                                                    </div>
                                                    <div class="login-separater text-center mb-4 jarak-top-kurang15">
                                                        <span>ATAU MASUK DENGAN EMAIL</span>
                                                        <hr/>
                                                    </div>
                                                    <div class="d-grid jarak-top-kurang4">
                                                        <a class="btn shadow-sm btn-white" href="javascript:;">
                                                            <span class="d-flex justify-content-center align-items-center">
                                                                <img class="me-2" src="assets/images/icons/search.svg" width="16" alt="Image Description">
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
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end row-->
                </div>
            </div>
        </div>
        <!--=========================
            LOGIN END
        ==========================-->
    </section>
</template>