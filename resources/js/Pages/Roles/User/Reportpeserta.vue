<template>
    <!--wrapper-->
    <div class="wrapper">
        <!--sidebar wrapper -->
        <div class="sidebar-wrapper" data-simplebar="true">
            <div class="sidebar-header">
                <div v-for="setting in settings" :key="setting.id">
                    <a href="/">
                        <img id="logo-img"
                            :src="setting.logo1 ? `/storage/${setting.logo1}` : '/bootstrap/images/logo1default.jpg'"
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
                    <a>
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
                <div class="card card-height200" v-for="reg_lomba in reg_lombas" :key="reg_lomba.id">
                    <div class="card-body">
                        <label v-if="reg_lomba.status_kelulusan === 'menunggu'" class="keterangan1 jarak-bottom-kurang20">SEDANG DIPROSES</label>
                        <label v-if="reg_lomba.status_kelulusan === 'terverifikasi'" class="keterangan2 jarak-bottom-kurang20">TERVERIFIKASI</label>
                        <label v-if="reg_lomba.status_kelulusan === 'tidak_lolos'" class="keterangan3 jarak-bottom-kurang20">TIDAK LOLOS</label>
                        <label v-if="reg_lomba.status_kelulusan === 'lolos'" class="keterangan4 jarak-bottom-kurang20">LOLOS</label>
                        <br><br>
                        <div class="row">
                            <div class="label-left">
                                <h5 class="judul-report"><b>{{ reg_lomba?.submission?.title }}</b></h5>
                                <div v-for="setting in settings" :key="setting.id">
                                    <div class="judul-lomba-index"> Lomba {{ reg_lomba?.lomba?.name_lomba}} <br> {{ setting.name }}</div>
                                </div>
                                <div class="d-flex justify-content-end posisi-mb7 cnew">
                                    <button v-if="reg_lomba.status_kelulusan === 'menunggu' && reg_lomba.team.status === 'verified'" class="btn-silver crud-width150">
                                        <i class="bi bi-download icon-dow"></i>Download
                                    </button>
                                    <a v-else-if="reg_lomba.status_kelulusan !== 'menunggu' && reg_lomba.team.status === 'verified'" class="btn btn-success crud-width150" @click="checkAndDownloadCertificate(reg_lomba)">
                                        <i class="bi bi-download icon-dow"></i>Download
                                    </a>
                                </div>
                                <div class="d-flex justify-content-end">
                                    <a class="btn btn-primary crud-width-150" :href="getRegLombaTeamUrl(reg_lomba.id, reg_lomba.team.id, reg_lomba.lomba.id)">
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
import { Link } from '@inertiajs/vue3';
import axios from 'axios';
import Swal from 'sweetalert2';

const props = defineProps({
    userData: {
        type: Object,
        required: true
    },
    notifCount: {
        type: Number,
        default: null
    },
    reg_lombas: {
        type: Array,
        required: true
    },
    settings: {
        type: Object,
        required: true
    },
});

const getRegLombaTeamUrl = (regLombaId, teamId, lombaId) => {
  return route('detail.riport', { reg_lomba_id: regLombaId, team_id: teamId, lomba_id: lombaId });
};

const downloadCertificate = (lombaId) => {
    const downloadUrl = route('certificate.download', { lomba_id: lombaId });
    window.location.href = downloadUrl;
};

const checkAndDownloadCertificate = (reg_lomba) => {
    if (reg_lomba.status_kelulusan === 'menunggu') {
        Swal.fire({
            icon: 'warning',
            title: 'Peringatan',
            text: 'Anda tidak dapat mengunduh sertifikat karena tim anda belum terverifikasi.',
            confirmButtonText: 'OK'
        });
    } else {
        downloadCertificate(reg_lomba.lomba.id);
    }
};

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
const notifCount = ref(props.notifCount);

const updateDots = (element) => {
    let dots = '';
    setInterval(() => {
        dots = dots.length < 3 ? dots + '.' : '';
        element.textContent = `SEDANG DIPROSES${dots}`;
    }, 500);
};

onMounted(() => {
    const elements = document.querySelectorAll('.keterangan1');
    elements.forEach(el => updateDots(el));
});
</script>
