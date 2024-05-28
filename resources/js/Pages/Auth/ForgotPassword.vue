<script setup>
// import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
// import InputLabel from '@/Components/InputLabel.vue';
// import PrimaryButton from '@/Components/PrimaryButton.vue';
// import TextInput from '@/Components/TextInput.vue';
import { Head, useForm } from '@inertiajs/vue3';

defineProps({
	status: {
		type: String,
	},
});

const form = useForm({
	email: '',
});

const submit = () => {
	form.post(route('password.email'));
};
</script>
<template>

	<body class="body-login">
		<div class="card3 jarakm">
			<div class="card2">
				<div class="card-body">
					<div class="border p-4 rounded">
						<div class="text-center">
							<div class="text-center">
								<img src="assets/images/icons/forgot-2.png" width="120" />
							</div>
							<h5 class="mt-5 rata-kiri">Tidak ingat kata sandi?</h5>
							<p class="text-lupa-pw rata-kiri">Masukkan Email anda yang terdaftar untuk mengatur ulang
								kata sandi</p>
							<form @submit.prevent="submit">
								<div class="col-12 c-mb-13 c-mt10">
									<input type="email" class="form-control" id="inputEmailAddress" v-model="form.email"
										required placeholder="Masukkan Email" />
									<InputError class="mt-2" :message="form.errors.email" />
								</div>
								<div class="d-grid">
									<!-- <a type="button" onclick="window.location.href='/login'"class="btn btn-primary btn-lg">Kirim</a>  -->
									<Button class="btn btn-primary w-100 c-mb-8" :disabled="form.processing">
										<i class='bx bx-user'></i>Email Password Reset Link
									</Button>
									<a href="/login" class="btn btn-light w-100"
										onclick="window.location.href='/login'"><i
											class='bx bx-arrow-back me-1'></i>Kembali
										ke halaman
										login</a>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- end wrapper -->
	</body>
</template>
