<script setup>
import { Link } from '@inertiajs/vue3';
import { defineProps, ref, onMounted, computed } from 'vue';

const { name, username, lombas, picture, sudah_dinilai, totalteam ,settings, logo1} = defineProps(['name', 'username', 'lombas', 'picture', 'sudah_dinilai', 'totalteam', 'settings', 'logo1']);


const props = {
    name: {
        type: String,
    },
    username: {
        type: String,
    },
    lombas: {
        type: Array,
    },
    picture: {
        type: Object,
    },
    settings: {
        type: Object, 
        default: () => ({}), 
    },
    logo1: {
        type: String,
    },
};

if (!localStorage.getItem('reloaded')) {
  // Jika belum, set flag dan reload halaman setelah 1 detik
  setTimeout(() => {
    localStorage.setItem('reloaded', 'true');
    location.reload();
  }, 1000);
} else {
  // Jika sudah, hapus flag agar reload hanya terjadi sekali
  localStorage.removeItem('reloaded');
}




</script>
<template>
    <!--wrapper-->
    <div class="wrapper">
        <!--sidebar wrapper -->
        <div class="sidebar-wrapper" data-simplebar="true">
            <div class="sidebar-header">
                <div  v-for="setting in settings" :key="setting.id">
                    <a href="/">
                        <img id="logo-img" :src="setting.logo1 ? `/storage/${setting.logo1}` : '/bootstrap/images/logo1default.jpg'" class="lg2">
                    </a>
                </div>
                <div id="menu-toggle" class="toggle-icon ms-auto"><i class="fadeIn animated bx bx-menu"></i></div>
            </div>
            <!--navigation-->
            <ul class="metismenu" id="menu">
                <li>
                    <a href="/lombajuri">
                        <div class="parent-icon"><i class="bx bx-award"></i>
                        </div>
                        <div class="menu-title">Lomba</div>
                    </a>
                </li>
                <li >
                    <a  href="/rangkingjuri">
                        <div class="parent-icon"><i class="fadeIn animated bx bx-trophy"></i>
                        </div>
                        <div class="menu-title">Rangking</div>
                    </a>
                </li>
                <li>
                    <a href="/">
                        <div class="parent-icon"><i class="fadeIn animated bx bx-log-out"></i>
                        </div>
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
        <!--end sidebar wrapper -->
        <!--start header -->
        <header>
            <div class="topbar d-flex align-items-center">
                <nav class="navbar navbar-expand">
                    <div class="mobile-toggle-menu"><i class='bx bx-menu'></i>
                    </div>
                    <div class="search-bar flex-grow-1">
                    </div>
                    <div class="top-menu ms-auto">
                        <ul class="navbar-nav align-items-center">
                            <div class="user-info ps-3">
                                <p class="user-name mb-0">{{ $page.props.userData.name }}</p>
                                <p class="user-role">{{ $page.props.userData.username }}</p>
                            </div>
                            <div class="parent-icon posisi-icon"><i class="bx bx-user-circle c-font48"></i>
                            </div>
                            <li class="nav-item dropdown dropdown-large">
                                <div class="dropdown-menu dropdown-menu-end">
                                    <div class="header-notifications-list">
                                    </div>
                                </div>
                            </li>
                            <li class="nav-item dropdown dropdown-large">
                                <div class="dropdown-menu dropdown-menu-end">
                                    <div class="header-message-list">
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </header>
        <!--end header -->

        <!--start page wrapper -->
        <div class="page-wrapper">
            <div class="page-content">
                <!--breadcrumb-->
                <div class="tf__activities_slider_area">
                    <div class="container">
                        <!--breadcrumb-->
                        <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-3">
                        <div v-for="lomba in lombas" :key="lomba.id" class="col">
                            <div class="card radius-15 card-overview">
                                <span class="pcount">{{ lomba.sudah_dinilai }}/{{ lomba.totalteam }}</span>
                                <img :src="lomba.picture ? `/storage/${lomba.picture}` : '/bootstrap/images/default.jpg'" class="border-radius">
                                <label class="judul-overview">{{ lomba.name_lomba }}</label>
                                <a class="btn btn-primary btn-landing-page2" :href="`/lombajuri/${lomba.id}`">Lihat Karya</a>
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
</template>

<style scoped>
.lomba-container {
    display: flex;
    flex-direction: row;
    gap: 16px;
    /* Adjust the gap as needed */
    overflow-x: auto;
    /* Enable horizontal scrolling if necessary */
}

.card-overview {
    flex: 0 0 auto;
    /* Prevent cards from shrinking */
}
</style>