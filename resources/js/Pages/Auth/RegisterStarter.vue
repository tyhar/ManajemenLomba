<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

//frontend
import { reactive } from 'vue'
import { router } from '@inertiajs/vue3'

const form = useForm({
    name: '',
    // username: '',
    email: '',
    password: '',
    password_confirmation: '',
});

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};

//frontend
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
						<div class="col mx-auto" style="padding-top: 65px;">
							<div class="card">
								<div class="card-body">
									<div class="border p-4 rounded">
										<div class="text-center">
											<h3>Buat Akun</h3>
										</div>
										<br>
										<div class="form-body">
											<form class="row g-3" @submit.prevent="submit">
												<div class="col-12">
													<label for="name" value="Name" class="form-label">Nama Lengkap</label>
													<input 
                                                        id="name" 
                                                        type="text"
                                                        class="form-control" 
                                                        v-model="form.name" 
                                                        required  
                                                        autofocus autocomplete="name"
                                                        placeholder="Enter Name"
                                                    >
                                                    <InputError class="mt-2" :message="form.errors.name" />
												</div>
												<!-- <div class="col-12 jarak-top-lebih6">
													<label for="username" value="Username" class="form-label">Username</label>
													<input id="username" v-model="form.username" type="text" class="form-control" placeholder="Enter Username" autofocus autocomplete="username">
												</div> -->
												<div class="col-12 jarak-top-lebih6">
													<label for="email" value="Email" class="form-label">Email</label>
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
													<label for="password" value="Password" class="form-label">Password</label>
													<div class="input-group" id="show_hide_password">
														<input 
                                                            id="password" 
                                                            v-model="form.password"
                                                            required
                                                            type="password" 
                                                            class="form-control border-end-0" 
                                                            placeholder="Enter Password" 
                                                            autofocus autocomplete="new-password"> 
                                                        <a href="javascript:;" class="input-group-text bg-transparent"><i class='bx bx-hide'></i></a>
													</div>
												</div>
                                                <div class="col-12 jarak-top-lebih6">
													<label for="password" value="Password" class="form-label">Password</label>
													<div class="input-group" id="show_hide_password">
														<input 
                                                            id="password_confirmation" 
                                                            v-model="form.password_confirmation"
                                                            required 
                                                            type="password" 
                                                            class="form-control border-end-0" 
                                                            placeholder="Confirm Password" 
                                                            autofocus autocomplete="new-password"> 
                                                        <a href="javascript:;" class="input-group-text bg-transparent"><i class='bx bx-hide'></i></a>
													</div>
												</div>
												<!-- <div>
													<div class="form-check form-switch">
														<input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked">
														<label class="form-check-label check-login" for="flexSwitchCheckChecked">Saya membaca serta menyetujui Syarat & Ketentuan </label>
													</div>
												</div> -->
												<div class="col-12 jarak-top-lebih12">
													<div class="d-grid">
														<!-- <button type="submit" class="btn btn-primary"><i class='bx bx-user'></i>Registrasi</button> -->
                                                        <button class="btn btn-primary" :disabled="form.processing">
                                                            Register
                                                        </button>
													</div>    
													<div class="login-separater text-center mb-4 jarak-top-kurang18"> <span>ATAU MASUK DENGAN EMAIL</span>
														<hr/>
													</div>
													<div class="d-grid jarak-top-kurang10">
														<a class="btn shadow-sm btn-white" href="javascript:;"> <span class="d-flex justify-content-center align-items-center">
															<img class="me-2" src="../../../../public/assets/images/icons/search.svg" width="16" alt="Image Description">
															<span>Masuk dengan Google</span>
															</span>
														</a>
													</div>
													<div class="text-center jarak-top-kurang12">
														<br>
														<p>
                                                            Sudah punya akun? 
                                                            <a :href="route('login')">Login</a>
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
	</section>
</template>

