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
							<p class="text-lupa-pw rata-kiri">Masukan ID email Anda yang terdaftar untuk mengatur kata
								ulang sandi</p>
							<form @submit.prevent="submit">
								<div class="col-12 c-mb-13 c-mt10 rata-kiri">
									<label class="form-label warna-hitam jb-k5">Email</label>
									<input type="email" class="form-control jb-k5" id="inputEmailAddress"
										v-model="form.email" required placeholder="Masukan Email" />
									<InputError class="mt-2" :message="form.errors.email" />
								</div>
								<div class="d-grid">
									<!-- <a type="button" onclick="window.location.href='/login'"class="btn btn-primary btn-lg">Kirim</a>  -->
									<Button class="btn btn-primary w-100 c-mb-8" :disabled="form.processing">
										Kirim
									</button>
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
