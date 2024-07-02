<template>
  <!--wrapper-->
  <div class="wrapper">
    <!--sidebar wrapper-->
    <div class="sidebar-wrapper" data-simplebar="true">
      <div class="sidebar-header">
        <div v-for="setting in settings" :key="setting.id">
          <a href="/">
            <img id="logo-img" :src="setting.logo1 ? `/storage/${setting.logo1}` : '/bootstrap/images/logo1default.jpg'" class="lg2">
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
          <a :href="route('profilpeserta.create')">
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
                <p class="user-name mb-0">{{ $page.props.userData.name }}</p>
                <p class="user-role">{{ $page.props.userData.username }}</p>
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
        <!--breadcrumb-->
        <div class="tf__activities_slider_area">
          <div class="container">
            <!--breadcrumb-->
            <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-3">
              <div class="col" v-for="lomba in lombas" :key="lomba.id">
                <div class="card radius-15 card-overview">
                  <img :src="lomba.picture ? `/storage/${lomba.picture}` : '/bootstrap/images/default.jpg'" class="border-radius">
                  <div class="judul-overview">{{ lomba.name_lomba }}</div>
                  <div class="btn-posisi">
                    <a class="btn btn-primary btn-lomba" :href="`/detailpeserta/${lomba.id}`">Detail</a>
                    <a v-if="!lomba.is_registered" class="btn btn-success button-lomba" @click="submitForm(lomba.id)">Daftar</a>
                    <button v-if="lomba.is_registered && lomba.status_ketua_team === 'sudah_submit'" class="btn btn-secondary button-lomba">Terdaftar</button>
                    <a v-if="lomba.is_registered && lomba.status_ketua_team === 'terdaftar'" class="btn-ungu button-lomba" @click="handleLombaSaya(lomba.id)">Lanjutkan</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!--end row-->
        </div>
      </div>
      <!--end row-->
    </div>
  </div>
  <!--end switcher-->
</template>

<script setup>
import { Link, useForm, router } from '@inertiajs/vue3';
import { defineProps, ref } from 'vue';
import Swal from 'sweetalert2';
import axios from 'axios';

const props = defineProps({
  lombas: {
    type: Array,
    required: true,
  },
  initialUserStatus: {
    type: String,
    required: true,
  },
  notifCount: {
    type: [Number, null],
    default: null,
  },
  settings: {
    type: Object,
    default: () => ({}),
  },
  logo1: {
    type: String,
  },
});

const userStatus = ref(props.initialUserStatus);
const notifCount = ref(props.notifCount);

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

function handleLombaSaya(lombaId) {
  axios.get(route('daftarlomba.show', lombaId))
    .then(response => {
      router.get(route('daftarlomba.show', lombaId));
    })
    .catch(error => {
      Swal.fire({
        title: 'Lomba Kosong!',
        text: 'Silahkan mendaftar lomba terlebih dahulu.',
        icon: 'error',
        confirmButtonText: 'OK'
      }).then(() => {
        router.get('/dashboard');
      });
    });
}

async function submitForm(lombaId) {
  try {
    await router.post('/overview', {
      lomba_id: lombaId
    });

    await axios.patch(`/api/update-status-ketua/${lombaId}`, { status: 'terdaftar' });

    userStatus.value = 'terdaftar';
  } catch (error) {
    console.error('Error submitting form:', error);
    if (error.response && error.response.data && error.response.data.errorInfo && error.response.data.errorInfo[1] === 1062) {
      // Handle duplicate entry error (Anda telah mendaftar lomba ini sebelumnya)
    } else {
      // Handle other errors (Gagal menyimpan data)
    }
  }
}

if (!localStorage.getItem('reloaded')) {
  setTimeout(() => {
    localStorage.setItem('reloaded', 'true');
    location.reload();
  }, 1000);
} else {
  localStorage.removeItem('reloaded');
}
</script>
