<script setup>
import { Link } from '@inertiajs/vue3';
import { defineProps, ref, onMounted, computed } from 'vue';

const notifCount = ref(0);

const props = defineProps({
  lombas: {
    type: Array,
    required: true,
  },
  picture: {
    type: Object,
    required: true,
  },


});

onMounted(async () => {
  try {
    const response = await axios.get('/api/unread-notifikasi');
    notifCount.value = response.data.notifCount;
  } catch (error) {
    console.error(error);
  }

});




</script>

<template>
  <!--wrapper-->
  <div class="wrapper">
    <!--sidebar wrapper-->
    <div class="sidebar-wrapper" data-simplebar="true">
      <div class="sidebar-header">
        <div>
          <a href="/">
            <img id="logo-img" src="/bootstrap/images/lg.png" class="lg2">
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
          <a href="/notifikasipeserta">
            <div class="parent-icon"><i class="bx bx-user-circle"></i></div>
            <div class="menu-title">Notifikasi<span class="alert-count">{{ notifCount }}</span></div>
          </a>
        </li>
        <li>
          <a href="/reportpeserta">
            <div class="parent-icon"><i class="fadeIn animated bx bx-comment-detail"></i></div>
            <div class="menu-title">Report <span class="alert-count">1</span></div>
          </a>
        </li>
        <li>
          <a href="/">
            <div class="parent-icon"><i class="fadeIn animated bx bx-log-out"></i></div>
            <div class="menu-title">
              <Link class="menu-title" :href="route('logout')" method="post" as="button">
              Logout
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
                  <img :src="lomba.picture ? `/storage/${lomba.picture}` : '/bootstrap/images/default.jpg'"
                    class="border-radius">
                  <div class="judul-overview">{{ lomba.name_lomba }}</div>
                  <div class="btn-posisi">
                    <a class="btn btn-primary btn-lomba" :href="`/detailpeserta/${lomba.id}`">Detail</a>
                    <a class="btn btn-success button-lomba" :href="`/daftarlomba`">Daftar</a>
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
