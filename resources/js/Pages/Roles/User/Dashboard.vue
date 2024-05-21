<script setup>
import { Link } from '@inertiajs/vue3';

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
</script>

<template>
  <!--wrapper-->
  <div class="wrapper">
    <!--sidebar wrapper-->
    <div class="sidebar-wrapper" data-simplebar="true">
      <div class="sidebar-header">
        <div>
          <a href="/">
            <img src="/bootstrap/images/logocb.png" class="logo-icon" alt="logo icon">
          </a>
        </div>
        <div class="toggle-icon ms-auto"><i class="fadeIn animated bx bx-menu"></i></div>
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
          <a href="/daftarlomba">
            <div class="parent-icon"><i class="fadeIn animated bx bx-street-view"></i></div>
            <div class="menu-title">Daftar Lomba</div>
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
            <div class="menu-title">Notifikasi<span class="alert-count">1</span></div>
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
            <div class="row">
              <div class="col-12">
                <div class="grid-container">
                  <div v-for="lomba in lombas" :key="lomba.id" class="card radius-15 card-overview">
                    <img :src="lomba.picture ? `/storage/${lomba.picture}` : '/bootstrap/images/default.jpg'" alt="New Image">
                      <div class="judul-overview">{{ lomba.name_lomba }}</div>
                    <a class="btn btn-primary btn-landing-page2"  :href="`/detailpeserta/${lomba.id}`">Detail</a>
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
  </div>
  <!--end switcher-->
</template>
<!-- 
<style scoped>
.grid-container {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 16px;
}

.card-overview img {
  max-width: 100%;
  height: auto;
  border-radius: 8px;
}
.judul-overlay {
  position: absolute;
  top: 1px; /* Adjust to move text slightly up */
  left: 10px; /* Shift text to the right */
  width: calc(100% - 20px); /* Adjust width to accommodate padding */ 
  color: black;
  padding: 10px;
  text-align: left; /* Align text to the left */
  border-radius: 8px 8px 0 0;
  font-family: Arial, sans-serif; /* Change to desired font-family */
  font-size: 1.2em; /* Change to desired font-size */
  font-weight: bold; /* Make text bold */
}
.btn-landing-page2 {
  margin-top: 10px;
}

</style> -->
