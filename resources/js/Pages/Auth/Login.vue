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
                        <div class="form-body">
                            <form class="row g-3" @submit.prevent="submit">
                                <div class="col-12">
                                    <input type="email" class="form-control" id="emailorusername" v-model="form.email"
                                        placeholder="Enter Email" />
                                    <InputError class="mt-2" :message="errors.email" />
                                    <!-- Corrected prop reference -->
                                </div>
                                <div class="col-12 c-mlk10">
                                    <div class="input-group" id="show_hide_password">
                                        <input type="password" class="form-control border-end-0" v-model="form.password"
                                            required placeholder="Enter Password" />
                                        <InputError class="mt-2" :message="errors.password" />
                                        <!-- Corrected prop reference -->
                                        <a href="javascript:;" class="input-group-text bg-transparent"><i
                                                class='bx bx-hide'></i></a>
                                    </div>
                                </div>
                                <div class="col-md-6 jarak-top-lebih4">
                                </div>
                                <div class="d-grid jarak-top-lebih10">
                                    <label class="c-mr-5">Hasil Dari</label>
                                    <label for="captcha" class="form-label"></label>
                                    <div class="input-group">
                                        <input v-model="captchaInput" type="text" class="form-control" id="captcha"
                                            placeholder="Enter Captcha">
                                    </div>
                                </div>
                                <Link v-if="canResetPassword" :href="route('password.request')" class="ml240">
                                Lupa Password?
                                </Link>

                                <!-- <div class="d-grid jarak-top-lebih10">
                                                    <a class="btn shadow-sm btn-white" href="javascript:;">
                                                        <span>Captcha</span>
                                                    </a>
                                                </div> -->
                                <div class="col-12">
                                    <div class="d-grid jarak-top-kurang5">
                                        <button type="submit" class="btn btn-primary w-100" :disabled="form.processing">
                                            <i class='bx bx-lock-open'></i>
                                            Log in
                                        </button>
                                    </div>
                                    <div class="login-separater text-center mb-4 jarak-top-kurang15">
                                        <span>ATAU MASUK DENGAN EMAIL</span>
                                        <hr />
                                    </div>
                                    <div class="d-grid jarak-top-kurang4">
                                        <a class="btn shadow-sm btn-white" href="javascript:;"> <span
                                                class="d-flex justify-content-center align-items-center">
                                                <img class="me-2" src="assets/images/icons/search.svg" width="16"
                                                    alt="Image Description">
                                                <span>Masuk dengan Google</span>
                                            </span>
                                        </a>
                                    </div>
                                    <div class="text-center jarak-top-kurang10">
                                        <br>
                                        Belum punya akun?
                                        <a :href="route('register')">Daftar disini</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--end row-->
        <!--=========================
            LOGIN END
        ==========================-->
    </body>
</template>
<script>
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