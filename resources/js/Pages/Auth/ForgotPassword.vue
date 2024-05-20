<script setup>
import Swal from 'sweetalert2';
import InputError from '@/Components/InputError.vue';
import { Head, useForm } from '@inertiajs/vue3';
import { ref } from 'vue';

defineProps({
    status: {
        type: String,
        default: null,
    },
});

const form = useForm({
    email: '',
});

const submit = async () => {
    try {
        await form.post(route('password.email'));
        Swal.fire({
            title: 'Success!',
            text: 'Please check your email to reset your password.',
            icon: 'success',
            confirmButtonText: 'OK'
        });
    } catch (error) {
        // handle error if needed
    }
};
</script>

<template>
    <!--=========================
    LOGIN START
    ==========================-->
    <section style="background: url(../assets/images/login-images/bg-forgot-password.jpg);">
        <div class="wrapper">
            <div class="section-authentication-signin d-flex justify-content-center my-5 my-lg-1">
                <div class="container-fluid jarak-top-lebih10">
                    <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-3">
                        <div class="col mx-auto" style="padding-top: 70px;">
                            <div class="card">
                                <div class="card-body">
                                    <div class="border p-4 rounded">
                                        <div class="text-center">
                                            <img src="assets/images/icons/forgot-2.png" width="120" />
                                        </div>
                                        <h5 class="mt-5 font-weight-bold">Tidak ingat kata sandi?</h5>
                                        <p class="text-lupa-pw">Masukkan Email anda yang terdaftar untuk mengatur ulang kata sandi</p>
                                        <form @submit.prevent="submit">
                                            <div class="my-4">
                                                <label for="email" class="form-label">Email</label>
                                                <input
                                                    id="email"
                                                    type="email"
                                                    class="form-control form-control-lg"
                                                    v-model="form.email"
                                                    required
                                                    autofocus
                                                    autocomplete="username"
                                                    placeholder="Masukkan Email"
                                                />
                                                <InputError class="mt-2" :message="form.errors.email" />
                                            </div>
                                            <div class="d-grid gap-2">
                                                <button type="submit" class="btn btn-primary btn-lg" :disabled="form.processing">
                                                    Email Password Reset Link
                                                </button>
                                                <a href="/login" class="btn btn-light btn-lg">
                                                    <i class='bx bx-arrow-back me-1'></i>Kembali ke halaman login
                                                </a>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end wrapper -->
    </section>
    <!--=========================
    LOGIN END
    ==========================-->
</template>
