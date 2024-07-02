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
                <div class="col-12">
                  <label for="login" class="form-label warna-hitam">Email atau Username</label>
                  <input class="form-control" id="login" type="text" v-model="form.login" required placeholder="Email atau Username" />
                  <InputError class="mt-2" :message="errors.login" />
                </div>
                <div class="col-12 c-mlk10">
                  <label for="password" class="form-label warna-hitam">Password</label>
                  <div class="input-group" id="show_hide_password">
                    <input class="form-control border-end-0" id="password" :type="showPassword ? 'text' : 'password'" v-model="form.password" required placeholder="Masukan Password" />
                    <InputError class="mt-2" :message="errors.password" />
                    <a href="javascript:;" class="input-group-text bg-transparent" @click="togglePasswordVisibility">
                      <i :class="showPassword ? 'bx bx-show' : 'bx bx-hide'"></i>
                    </a>
                  </div>
                </div>
                <div class="d-grid jarak-top-lebih10">
                  <label class="c-mr-5">CAPTCHA</label>
                  <div>
                    <img :src="captcha.image" alt="CAPTCHA">
                    <button type="button" @click="generateCaptcha">Refresh</button>
                  </div>
                  <input v-model="captchaInput" type="text" class="form-control" id="captcha" required placeholder="Enter CAPTCHA">
                </div>
                <Link v-if="canResetPassword" :href="route('password.request')" class="ml240">Lupa Password?</Link>
                <div class="col-12">
                  <div class="d-grid jarak-top-kurang5">
                    <button type="submit" class="btn btn-primary w-100"><i class='bx bx-lock-open'></i>Masuk</button>
                  </div>
                  <div class="login-separater text-center mb-4 jarak-top-kurang15">
                    <span>ATAU MASUK DENGAN EMAIL</span>
                    <hr />
                  </div>
                  <div class="d-grid jarak-top-kurang4">
                    <a class="btn shadow-sm btn-white" href="#" @click="loginWithGoogle">
                      <span class="d-flex justify-content-center align-items-center">
                        <img class="me-2" src="../../../../public/assets/images/icons/search.svg" width="16" alt="Image Description">
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
    </body>
  </template>
  
  <script setup>
  import { ref, reactive } from 'vue';
  import { Head, Link, useForm } from '@inertiajs/vue3';
  import Swal from 'sweetalert2';
  import axios from 'axios';
  
  const props = defineProps({
    canResetPassword: {
      type: Boolean,
    },
    status: {
      type: String,
    },
    errors: Object,
  });
  
  const captcha = reactive({
    image: '',
    key: '',
  });
  const captchaInput = ref('');
  
  async function generateCaptcha() {
    try {
      const response = await axios.get('/captcha-image');
      captcha.image = response.data.captcha + '&' + Date.now(); // Avoid caching
    } catch (error) {
      console.error('Error fetching CAPTCHA:', error);
    }
  }
  
  const form = useForm({
    login: '',
    password: '',
    remember: false,
    captcha: ''
  });
  
  async function submit() {
    form.captcha = captchaInput.value;
  
    try {
      const response = await axios.post('/check-user-status', { login: form.login });
      if (response.data.status === 'nonaktif') {
        Swal.fire({
          icon: 'error',
          title: 'Akun Dinonaktifkan',
          text: 'Akun anda dinonaktifkan. Silahkan hubungi admin!',
        });
        return;
      }
    } catch (error) {
      console.error('Error checking user status:', error);
      Swal.fire({
        icon: 'error',
        title: 'Terjadi Kesalahan',
        text: 'Gagal memeriksa status pengguna. Silahkan coba lagi.',
      });
      return;
    }
  
    form.post(route('login'), {
      onFinish: () => {
        form.reset('password');
        if (form.errors.captcha) {
          Swal.fire({
            icon: 'error',
            title: 'Captcha Salah',
            text: 'Silahkan Coba Lagi!',
          });
          generateCaptcha();
        } else if (!form.hasErrors()) {
          Swal.fire({
            icon: 'success',
            title: 'Login Successful',
            text: 'You have successfully logged in!',
          });
        } else {
          Swal.fire({
            icon: 'error',
            title: 'Login Failed',
            text: 'Please check your input and try again.',
          });
          generateCaptcha();
        }
      },
    });
  }
  
  function loginWithGoogle() {
    window.location.href = "/authorized/google";
  }
  
  const showPassword = ref(false);
  function togglePasswordVisibility() {
    showPassword.value = !showPassword.value;
  }
  
  generateCaptcha();
  </script>
  