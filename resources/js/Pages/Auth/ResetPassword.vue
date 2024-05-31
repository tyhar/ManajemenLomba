<script setup>
import InputError from '@/Components/InputError.vue';
import { Head, useForm } from '@inertiajs/vue3';
import { ref } from 'vue';
import Swal from 'sweetalert2';

const props = defineProps({
    email: {
        type: String,
        required: true,
    },
    token: {
        type: String,
        required: true,
    },
});

const form = useForm({
    token: props.token,
    email: props.email,
    password: '',
    password_confirmation: '',
});

const submit = () => {
    form.post(route('password.store'), {
        onFinish: () => {
            form.reset('password', 'password_confirmation');
            Swal.fire({
                title: 'Success!',
                text: 'Your password has been updated.',
                icon: 'success',
                confirmButtonText: 'OK'
            });
        },
    });
};

//frontend
$(document).ready(function () {
    $(".toggle-password").on('click', function (event) {
        event.preventDefault();
        const inputField = $(this).siblings('input');
        const icon = $(this).find('i');
        if (inputField.attr("type") == "text") {
            inputField.attr('type', 'password');
            icon.addClass("bx-hide").removeClass("bx-show");
        } else if (inputField.attr("type") == "password") {
            inputField.attr('type', 'text');
            icon.removeClass("bx-hide").addClass("bx-show");
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
                        <div class="col mx-auto" style="padding-top: 130px;">
                            <div class="card">
                                <div class="card-body">
                                    <div class="border p-4 rounded">
                                        <div class="text-center">
                                            <h3>Reset Password</h3>
                                        </div>
                                        <br>
                                        <div class="form-body">
                                            <form class="row g-3" @submit.prevent="submit">
                                                <div class="col-12 jarak-top-lebih6">
                                                    <label for="email" class="form-label">Email</label>
                                                    <input 
                                                        id="email" 
                                                        type="email" 
                                                        class="form-control"
                                                        v-model="form.email"  
                                                        required  
                                                        autofocus autocomplete="email"
                                                        placeholder="Enter Email"
                                                    />
                                                    <InputError class="mt-2" :message="form.errors.email" />
                                                </div>
                                                <div class="col-12 jarak-top-lebih6">
                                                    <label for="password" class="form-label">Password</label>
                                                    <div class="input-group">
                                                        <input 
                                                            id="password" 
                                                            v-model="form.password"
                                                            required
                                                            type="password" 
                                                            class="form-control border-end-0" 
                                                            placeholder="Enter Password" 
                                                            autofocus autocomplete="new-password"
                                                        > 
                                                        <a href="javascript:;" class="input-group-text bg-transparent toggle-password"><i class='bx bx-hide'></i></a>
                                                        <InputError class="mt-2" :message="form.errors.password" />
                                                    </div>
                                                </div>
                                                <div class="col-12 jarak-top-lebih6">
                                                    <label for="password_confirmation" class="form-label">Confirm Password</label>
                                                    <div class="input-group">
                                                        <input 
                                                            id="password_confirmation" 
                                                            v-model="form.password_confirmation"
                                                            required 
                                                            type="password" 
                                                            class="form-control border-end-0" 
                                                            placeholder="Confirm Password" 
                                                            autofocus autocomplete="new-password"
                                                        > 
                                                        <a href="javascript:;" class="input-group-text bg-transparent toggle-password"><i class='bx bx-hide'></i></a>
                                                        <InputError class="mt-2" :message="form.errors.password_confirmation" />
                                                    </div>
                                                </div>
                                                <div class="col-12 jarak-top-lebih12">
                                                    <div class="d-grid">
                                                        <button class="btn btn-primary" :disabled="form.processing">
                                                            Reset Password
                                                        </button>
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
    </section>
</template>
