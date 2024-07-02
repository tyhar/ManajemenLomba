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
                    <a href="/lombajuri">
                        <div class="parent-icon"><i class="bx bx-award"></i>
                        </div>
                        <div class="menu-title">Lomba</div>
                    </a>
                </li>
                <li>
                    <a href="/rangkingjuri">
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
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item">
                            </li>
                        </ol>
                    </nav>
                </div>
                <div class="card">
                    <div class="card-body">
                        <h4 class="mb-0 jarak-top-kurang5">TABEL KARYA</h4>
                        <hr class="c-mt10" />
                        <label class="jarak-filterstatus">Filter by Status</label>
                        <select class="form-select2" v-model="filterStatus">
                            <option value="Semua">Semua</option>
                            <option value="Sudah Dinilai">Sudah Dinilai</option>
                            <option value="Belum Dinilai">Belum Dinilai</option>
                        </select>
                        <br><br>
                        <div class="table-responsive">
                            <table id="example" class="table table-bordered">
                                <thead class="table-dark">
                                    <tr>
                                        <th class="width-id">ID</th>
                                        <th class="crud-width120">Nama Tim</th>
                                        <th class="crud-width-150">Judul</th>
                                        <th class="crud-width-50">Status</th>
                                        <th class="crud-width-90">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(reg_lomba, index) in filteredRegLombas" :key="reg_lomba?.id">
                                        <td>{{ index + 1 }}</td>
                                        <td>{{ reg_lomba?.team?.name_team }}</td>
                                        <td>{{ reg_lomba?.submission?.title }}</td>
                                        <td>{{ reg_lomba?.status }}</td>
                                        <td class="btn-crud">
                                            <a class="btn btn-secondary"
                                                :href="getRegLombaTeamUrl(reg_lomba.id, reg_lomba.team.id)">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                            <a v-if="reg_lomba.status.toLowerCase() === 'sudah_dinilai'" class="btn btn-primary"
                                                :href="getRegEditTeamUrl(reg_lomba.id, reg_lomba.lomba.id)">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!--end row-->
            </div>
        </div>
        <!--end page wrapper -->
    </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
import { defineProps, ref, computed } from 'vue';

const props = defineProps({
    name: {
        type: String,
        required: true,
    },
    username: {
        type: String,
        required: true,
    },
    reg_lombas: {
        type: Array,
        required: true,
    },
    settings: {
        type: Object,
        default: () => ({}),
    },
    logo1: {
        type: String,
    },
});

const filterStatus = ref('Semua');

const filteredRegLombas = computed(() => {
    return props.reg_lombas.filter(reg_lomba => {
        const isStatusValid = reg_lomba.status_kelulusan !== 'menunggu' && reg_lomba.status_kelulusan !== 'tidak_lolos';
        const isTeamVerified = reg_lomba.team.status !== 'unverified';
        if (!isStatusValid || !isTeamVerified) {
            return false;
        }
        if (filterStatus.value === 'Semua') {
            return true;
        }
        const isRated = reg_lomba.status.toLowerCase() === 'sudah_dinilai';
        return filterStatus.value === 'Sudah Dinilai' ? isRated : !isRated;
    });
});

const getRegEditTeamUrl = (regLombaId, lombaId) => {
    return route('value.edit', { reg_lomba_id: regLombaId, lomba_id: lombaId });
};

const getRegLombaTeamUrl = (regLombaId, teamId) => {
    return route('value.show', { reg_lomba_id: regLombaId, team_id: teamId });
};
</script>
