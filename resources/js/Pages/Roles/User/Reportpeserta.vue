<template>
    <!--wrapper-->
    <div class="wrapper">
        <!--sidebar wrapper -->
        <div class="sidebar-wrapper" data-simplebar="true">
            <div class="sidebar-header">
                <div v-for="setting in settings" :key="setting.id">
                    <a href="/">
                        <img id="logo-img" :src="setting.logo1" :alt="setting.name" class="lg2">
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
                        <div class="menu-title">Keluar</div>
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
        <!--end header -->
        <!--start page wrapper -->
        <div class="page-wrapper">
            <div class="page-content">
                <div class="card card-height200">
                    <div class="card-body">
                        <label class="keterangan1 jarak-bottom-kurang20">MENUNGGU</label>
                        <!-- <label class="keterangan2 jarak-bottom-kurang20">TERVERIFIKASI</label>
                        <label class="keterangan3 jarak-bottom-kurang20">TIDAK LOLOS</label>
                        <label class="keterangan4 jarak-bottom-kurang20">TIDAK LOLOS</label> -->
                        <br><br>
                        <div class="row">
                            <div class="label-left">
                                <h5 class="judul-report"><b>Poster Keamanan Data</b></h5>
                                <div class="judul-lomba-index">Olinas Periode 2024</div>
                                <div class="d-flex justify-content-end posisi-mb7 cnew">
                                    <a :href="downloadLink" class="btn btn-success crud-width150">
                                        <i class="bi bi-download icon-dow"></i>Download
                                    </a>
                                </div>
                                <div class="d-flex justify-content-end">
                                    <a class="btn btn-primary crud-width-150" href="/detailtimreport">
                                        <i class="bi bi-eye icon-eye"></i>Detail
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--end page wrapper -->
    </div>
</template>

<script setup>
import { defineProps, ref, onMounted } from 'vue';
import axios from 'axios';

const props = defineProps({
    settings: {
        type: Array,
    },
});

const notifCount = ref(0);

const downloadLink = ref('#');

onMounted(async () => {
    try {
        const response = await axios.get('/api/unread-notifikasi');
        notifCount.value = response.data.notifCount;
    } catch (error) {
        console.error(error);
    }

    // Update download link with user name or other required parameters
    const userName = 'User Name'; // Replace this with dynamic user name if available
    downloadLink.value = `/download-certificate?name=${encodeURIComponent(userName)}`;
});
</script>
