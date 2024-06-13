<template>
    <div class="wrapper">
        <!--sidebar wrapper -->
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
                        <div class="parent-icon"><i class='bx bx-category'></i>
                        </div>
                        <div class="menu-title">Overview</div>
                    </a>
                </li>
                <li>
                    <a href="/profilpeserta/create">
                        <div class="parent-icon"><i class="bx bx-user-circle"></i>
                        </div>
                        <div class="menu-title">Profil</div>
                    </a>
                </li>
                <li>
                    <a href="/notifikasipeserta">
                        <div class="parent-icon"><i class="bx bx-user-circle"></i>
                        </div>
                        <div class="menu-title">Notifikasi<span class="alert-count">{{ notifCount }}</span></div>
                    </a>
                </li>
                <li>
                    <a href="/reportpeserta">
                        <div class="parent-icon"><i class="fadeIn animated bx bx-comment-detail"></i>
                        </div>
                        <div class="menu-title">Report <span class="alert-count">1</span></div>
                    </a>
                </li>
                <li>
                    <a>
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
                <div class="card-body btn-crud" v-if="notifikasis.length">
                    <div class="keterangan-notif jarak-bottom-kurang20 c-mb30 bg-cred" v-for="notifikasi in notifikasis"
                        :key="notifikasi.id">
                        <label>{{ getFormattedDate() }}</label>
                        <label>{{ notifikasi.description }}</label>
                    </div>
                </div>
                <!-- Pesan statis hanya ditampilkan ketika status tim diverifikasi -->
                <div class="keterangan-notif jarak-bottom-kurang20 bg-cgreen" v-if="isVerified">
                    <label>{{ getFormattedDate() }}</label>
                    <label>Selamat TIM anda telah terverifikasi</label>
                </div>
            </div>
        </div>
        <!--end page wrapper -->
    </div>
</template>

<script setup>
import { defineProps, ref, onMounted, computed } from 'vue';
import { Link } from '@inertiajs/vue3';

const notifCount = ref(0);

const props = defineProps({
    notifikasis: {
        type: Array,
        default: () => []
    },
    isVerified: {
        type: Boolean,
        default: false
    }
});

onMounted(async () => {
    try {
        const response = await axios.get('/api/unread-notifikasi');
        notifCount.value = response.data.notifCount;
    } catch (error) {
        console.error(error);
    }

});
function getFormattedDate() {
    const date = new Date();
    const monthNames = ["Jan", "Feb", "Mar", "Apr", "Mei", "Jun",
        "Jul", "Ags", "Sep", "Okt", "Nov", "Des"];
    return `${date.getDate()} ${monthNames[date.getMonth()]}`;
}



</script>