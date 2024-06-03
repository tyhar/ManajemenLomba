<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { reactive, ref } from 'vue';
import Swal from 'sweetalert2';
import { router } from '@inertiajs/vue3';

const form = useForm({
    name: '',
    username: '',
    email: '',
    password: '',
    password_confirmation: '',
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
    form.post(route('register'), {
        onFinish: () => {
            form.reset('password', 'password_confirmation');
            // Tampilkan SweetAlert
            Swal.fire({
                icon: 'success',
                title: 'Registrasi Sukses!',
                text: 'Akun berhasil didaftarkan.',
                confirmButtonText: 'OK'
            });
        },
    });
};
function loginWithGoogle() {
    window.location.href = "/authorized/google";
}

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
                                <label for="inputEmailAddress" class="form-label warna-hitam jb-k5">Nama
                                    Lengkap</label>
                                <input v-model="form.name" type="text" class="form-control jb-k5" id="inputNamaLengkap"
                                    placeholder="Masukan Nama Lengkap">
                            </div>
                            <div class="col-12">
                                <label for="inputUsername" class="form-label warna-hitam jb-k5">Username</label>
                                <input v-model="form.username" type="text" class="form-control jb-k5" id="
                                    inputUsername" placeholder="Masukan Username">
                            </div>
                            <div class="col-12">
                                <label for="inputEmailAddress" class="form-label warna-hitam jb-k5">Email</label>
                                <input v-model="form.email" type="email" class="form-control"
                                    placeholder="Masukan Email">
                                <InputError class="mt-2" :message="form.errors.email" />
                            </div>
                            <div class="col-12 jarak-top-lebih10">
                                <label for="password" value="Password"
                                    class="form-label warna-hitam jb-k5">Password</label>
                                <div class="input-group" id="show_hide_password">
                                    <input id="password" v-model="form.password" required
                                        :type="showPassword ? 'text' : 'password'" class="form-control border-end-0"
                                        placeholder="Masukan Password" autofocus autocomplete="new-password">
                                    <a href="javascript:;" class="input-group-text bg-transparent"
                                        @click="togglePasswordVisibility">
                                        <i :class="showPassword ? 'bx bx-show' : 'bx bx-hide'"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="col-12 jarak-top-lebih10">
                                <label for="password_confirmation" value="Password"
                                    class="form-label warna-hitam jb-k5">Confirm
                                    Password</label>
                                <div class="input-group" id="show_hide_password_confirmation">
                                    <input id="password_confirmation" v-model="form.password_confirmation" required
                                        :type="showPasswordConfirmation ? 'text' : 'password'"
                                        class="form-control border-end-0" placeholder="Masukan Password Kembali"
                                        autofocus autocomplete="new-password">
                                    <a href="javascript:;" class="input-group-text bg-transparent"
                                        @click="togglePasswordConfirmationVisibility">
                                        <i :class="showPasswordConfirmation ? 'bx bx-show' : 'bx bx-hide'"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="col-12 jarak-top-lebih12">
                                <div class="d-grid">
                                    <button class="btn btn-primary w-100" :disabled="form.processing">
                                        <i class='bx bx-user'></i>Registrasi
                                    </button>
                                </div>
                                <div class="login-separater text-center mb-4 jarak-top-kurang18">
                                    <span>ATAU MASUK DENGAN EMAIL</span>
                                    <hr />
                                </div>
                                <div class="d-grid jarak-top-kurang10">
                                    <a class="btn shadow-sm btn-white" href="javascript:;">
                                        <span class="d-flex justify-content-center align-items-center">
                                            <img class="me-2" src="../../../../public/assets/images/icons/search.svg"
                                                width="16" alt="Image Description">
                                            <span>Masuk dengan Google</span>
                                        </span>
                                    </a>
                                </div>
                                <div class="text-center jarak-top-kurang12">
                                    <br>
                                    <p>
                                        Sudah memiliki akun?
                                        <a :href="route('login')">Masuk disini</a>
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