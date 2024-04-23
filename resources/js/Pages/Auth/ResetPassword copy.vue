<script setup>
// import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
// import InputLabel from '@/Components/InputLabel.vue';
// import PrimaryButton from '@/Components/PrimaryButton.vue';
// import TextInput from '@/Components/TextInput.vue';
import { Head, useForm } from '@inertiajs/vue3';

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
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
    <section style="background: url(../assets/images/login-images/bg-forgot-password.jpg);">
		<div class="wrapper">
			<div class="section-authentication-signin d-flex justify-content-center my-5 my-lg-1">
				<div class="container-fluid jarak-top-lebih10">
					<div class="row row-cols-1 row-cols-lg-2 row-cols-xl-3">
						<div class="col mx-auto" style="padding-top: 30px;">
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
                                                            autofocus autocomplete="new-password"
                                                        > 
                                                        <a href="javascript:;" class="input-group-text bg-transparent"><i class='bx bx-hide'></i></a>
                                                        <InputError class="mt-2" :message="form.errors.password" />
													</div>
												</div>
                                                <div class="col-12 jarak-top-lebih6">
													<label for="password_confirmation" value="Confirm Password" class="form-label">Confirm Password</label>
													<div class="input-group" id="show_hide_password">
														<input 
                                                            id="password_confirmation" 
                                                            v-model="form.password_confirmation"
                                                            required 
                                                            type="password" 
                                                            class="form-control border-end-0" 
                                                            placeholder="Confirm Password" 
                                                            autofocus autocomplete="new-password"
                                                        > 
                                                        <a href="javascript:;" class="input-group-text bg-transparent"><i class='bx bx-hide'></i></a>
                                                        <InputError class="mt-2" :message="form.errors.password_confirmation" />
													</div>
												</div>
												<div class="col-12 jarak-top-lebih12">
													<div class="d-grid">
                                                        <button class="btn btn-primary" :disabled="form.processing">
                                                            Reset Password
                                                        </button>
													</div>    
													<!-- <div class="login-separater text-center mb-4 jarak-top-kurang18"> <span>ATAU MASUK DENGAN EMAIL</span>
														<hr/>
													</div> -->
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
