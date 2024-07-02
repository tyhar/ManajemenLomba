<script setup>
import { Link, useForm, router } from '@inertiajs/vue3';
import { defineProps, ref, computed } from 'vue';
import axios from 'axios';
import Swal from 'sweetalert2';

// Define props
const props = defineProps({
  userData: {
    type: Object,
    required: true
  },
  notifCount: {
    type: Number,
    default: null
  },
  settings: {
    type: Object, // Menggunakan "type" untuk menentukan tipe data props
    default: () => ({}), // Menggunakan "default" jika props tidak diberikan
  },
  logo1: {
    type: String, // Menentukan tipe data logo sebagai String
  },
});

async function clearNotifications() {
  try {
    const response = await axios.post('/notifikasi/mark-all-as-read');
    if (response.data.success) {
      notifCount.value = 0;
    }
  } catch (error) {
    console.error('Error marking notifications as read', error);
  }
}
// Create a reactive reference for form data
const form = useForm({
  name: props.userData.name,
  username: props.userData.username,
  email: props.userData.email,
  instansi: props.userData.instansi,
  nik: props.userData.nik,
  phone: props.userData.phone,
  photo: null
});

// Computed property to check if NIK is valid
const isNIKValid = computed(() => form.nik.length === 16);

// Method to handle form submission
const submit = () => {
  if (!isNIKValid.value) {
    Swal.fire({
      icon: 'error',
      title: 'Error',
      text: 'NIK anda harus 16 digit. Silahkan periksa kembali!',
      confirmButtonText: 'OK'
    });
    return;
  }

  form.post(route('profilpeserta.store'), {
    onSuccess: () => {
      form.reset('photo');
      Swal.fire({
        icon: 'success',
        title: 'Success',
        text: 'Your profile data has been successfully updated',
        confirmButtonText: 'OK'
      });
    }
  });
};
</script>

<template>
  <!--wrapper-->
  <div class="wrapper">
    <!--sidebar wrapper-->
    <div class="sidebar-wrapper" data-simplebar="true">
      <div class="sidebar-header">
        <div v-for="setting in settings" :key="setting.id">
          <a href="/">
            <img id="logo-img" :src="setting.logo1 ? `/storage/${setting.logo1}` : '/bootstrap/images/logo1default.jpg'"
              class="lg2">
          </a>
        </div>
        <div id="menu-toggle" class="toggle-icon ms-auto"><i class="fadeIn animated bx bx-menu"></i></div>
      </div>
      <!--navigation-->
      <ul class="metismenu" id="menu">
        <li>
          <a href="/dashboard">
            <div class="parent-icon"><i class='bx bx-category'></i></div>
            <div class="menu-title">Overview</div>
          </a>
        </li>
        <li>
          <a href="/profilpeserta/create">
            <div class="parent-icon"><i class="bx bx-user-circle"></i></div>
            <div class="menu-title">Profil</div>
          </a>
        </li>
        <li>
          <a @click="clearNotifications" href="/notifikasipeserta">
            <div class="parent-icon"><i class="bx bx-user-circle"></i></div>
            <div class="menu-title">Notifikasi <span class="alert-count" v-if="notifCount">{{ notifCount }}</span></div>
          </a>
        </li>
        <li>
          <a href="/reportpeserta">
            <div class="parent-icon"><i class="fadeIn animated bx bx-comment-detail"></i></div>
            <div class="menu-title">Report <span></span></div>
          </a>
        </li>
        <li>
          <a href="/">
            <div class="parent-icon"><i class="fadeIn animated bx bx-log-out"></i></div>
            <div class="menu-title">
              <Link class="menu-title" :href="route('logout')" method="post" as="button">
              Keluar
              </Link>
            </div>
          </a>
        </li>
      </ul>
      <!--end navigation-->
    </div>
    <!--end sidebar wrapper-->
    <!--start header-->
    <header>
      <div class="topbar d-flex align-items-center">
        <nav class="navbar navbar-expand">
          <div class="mobile-toggle-menu"><i class='bx bx-menu'></i></div>
          <div class="search-bar flex-grow-1"></div>
          <div class="top-menu ms-auto">
            <ul class="navbar-nav align-items-center">
              <div class="user-info ps-3">
                <p class="user-name mb-0">{{ props.userData.name }}</p>
                <p class="user-role">{{ props.userData.username }}</p>
              </div>
              <div class="parent-icon posisi-icon"><i class="bx bx-user-circle c-font48"></i></div>
              <li class="nav-item dropdown dropdown-large">
                <div class="dropdown-menu dropdown-menu-end">
                  <div class="header-notifications-list"></div>
                </div>
              </li>
              <li class="nav-item dropdown dropdown-large">
                <div class="dropdown-menu dropdown-menu-end">
                  <div class="header-message-list"></div>
                </div>
              </li>
            </ul>
          </div>
        </nav>
      </div>
    </header>
    <!--end header-->
    <!--start page wrapper-->
    <div class="page-wrapper">
      <div class="page-content">
        <div class="container">
          <div class="main-body">
            <form @submit.prevent="submit">
              <div class="row">
                <div class="col-lg-4">
                  <div class="card">
                    <div class="card-body">
                      <div class="d-flex flex-column align-items-center text-center">
                        <div class="ukuran-foto">
                          <img
                            :src="props.userData.photo ? `/storage/${props.userData.photo}` : '/bootstrap/images/default.jpg'"
                            alt="Profile" class="rounded-circle p-1 bg-primary" width="190" height="150">
                        </div>
                        <input type="file" class="form-control form-control-sm btn-profil2 img-profil"
                          @change="e => form.photo = e.target.files[0]">
                      </div>
                      <div class="c-mtk">
                        <p class="keterangan-foto f-italic">Max file size: 2MB</p>
                        <p class="keterangan-foto f-italic">Format: .jpg, .png, .jpeg</p>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-8">
                  <div class="card">
                    <div class="card-body label-bawah">
                      <div class="row mb-3">
                        <div class="col-sm-3">
                          <h6 class="mb-0 profil-font15">Nama Lengkap</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                          <input type="text" class="form-control" v-model="form.name">
                        </div>
                      </div>
                      <div class="row mb-3">
                        <div class="col-sm-3">
                          <h6 class="mb-0">Username</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                          <input type="text" class="form-control" v-model="form.username" readonly>
                        </div>
                      </div>
                      <div class="row mb-3">
                        <div class="col-sm-3">
                          <h6 class="mb-0">Email</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                          <input type="email" class="form-control" v-model="form.email" readonly>
                        </div>
                      </div>
                      <div class="row mb-3">
                        <div class="col-sm-3">
                          <h6 class="mb-0">NIK</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                          <input type="text" class="form-control" v-model="form.nik">
                        </div>
                      </div>
                      <div class="row mb-3">
                        <div class="col-sm-3">
                          <h6 class="mb-0">Instansi</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                          <input type="text" class="form-control" v-model="form.instansi">
                        </div>
                      </div>
                      <div class="row mb-3">
                        <div class="col-sm-3">
                          <h6 class="mb-0">Kontak</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                          <input type="text" class="form-control" v-model="form.phone">
                        </div>
                      </div>
                      <div class="row mb-3">
                        <div class="col-sm-3">
                        </div>
                        <div class="col-sm-9 text-secondary">
                          <button type="submit" class="btn btn-primary w-100">Perbarui</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <!--end page wrapper-->
  </div>
  <!--end switcher-->
</template>
