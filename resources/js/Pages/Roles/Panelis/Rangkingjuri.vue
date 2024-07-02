<template>
    <!--wrapper-->
    <div class="wrapper">
        <!--sidebar wrapper -->
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
                    <a href="/lombajuri">
                        <div class="parent-icon"><i class="bx bx-award"></i></div>
                        <div class="menu-title">Lomba</div>
                    </a>
                </li>
                <li >
                     <a href="/rangkingjuri">
                        <div class="parent-icon"><i class="fadeIn animated bx bx-trophy"></i></div>
                        <div class="menu-title">Rangking</div>
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
                                <p class="user-name mb-0">{{ userData.name }}</p>
                                <p class="user-role">{{ userData.username }}</p>
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
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"></li>
                        </ol>
                    </nav>
                </div>
                <div v-for="(lombaGroup, name_lomba) in groupedLombas" :key="name_lomba" class="card">
                    <div class="card-body">
                        <h4 class="mb-0 jarak-top-kurang5">TABEL RANGKING LOMBA {{ name_lomba }}</h4>
                        <hr class="c-mt10" />
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead class="table-dark">
                                    <tr>
                                        <th class="width-id">ID</th>
                                        <th class="crud-width-150">Nama Tim</th>
                                        <th class="crud-width-180">Judul</th>
                                        <th class="crud-width-150">Instansi</th>
                                        <th class="crud-width-80">Nilai</th>
                                        <th class="crud-width100">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(reg_lomba, index) in lombaGroup" :key="reg_lomba.id">
                                        <td>{{ index + 1 }}</td>
                                        <td>{{ reg_lomba?.team?.name_team }}</td>
                                        <td>{{ reg_lomba?.submission?.title }}</td>
                                        <td>{{ reg_lomba?.team?.instansi }}</td>
                                        <td>{{ reg_lomba.value_total }}</td>
                                        <td>{{ reg_lomba.status_kelulusan }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!--end row-->
            </div>
        </div>
    </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
import { defineProps, computed } from 'vue';

const props = defineProps({
    userData: Object,
    reg_lombas: Array,
    lomba: Object,
    settings: {
        type: Object, 
        default: () => ({}), 
    },
    logo1: {
        type: String,
    },
});

const groupedLombas = computed(() => {
    return props.reg_lombas
        .filter(reg_lomba => reg_lomba.status_kelulusan !== 'menunggu')
        .reduce((acc, reg_lomba) => {
            const name_lomba = reg_lomba?.lomba?.name_lomba;
            if (!acc[name_lomba]) {
                acc[name_lomba] = [];
            }
            acc[name_lomba].push(reg_lomba);
            acc[name_lomba].sort((a, b) => b.value_total - a.value_total);
            return acc;
        }, {});
});
</script>
