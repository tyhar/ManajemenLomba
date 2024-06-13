<template>
    <!--wrapper-->
    <div class="wrapper">
        <!--sidebar wrapper -->
        <div class="sidebar-wrapper" data-simplebar="true">
            <div class="sidebar-header">
                <div>
                    <a href="/">
                        <img src="/bootstrap/images/logocb.png" class="logo-icon" alt="logo icon">
                    </a>
                </div>
                <div class="toggle-icon ms-auto"><i class="fadeIn animated bx bx-menu"></i>
                </div>
            </div>
            <!--navigation-->
            <ul class="metismenu" id="menu">
                <li>
                    <a href="/eventadmin">
                        <div class="parent-icon"><i class='bx bx-home-circle'></i></div>
                        <div class="menu-title">Dashboard</div>
                    </a>
                </li>
                <li>
                    <a href="/partisipanpetugas">
                        <div class="parent-icon"><i class="fadeIn animated bx bx-user-circle c-font25"></i></div>
                        <div class="menu-title">Partisipan</div>
                    </a>
                </li>
                <li>
                    <a href="/timpetugas">
                        <div class="parent-icon"><i class="fadeIn animated lni lni-users"></i></div>
                        <div class="menu-title">Tim</div>
                    </a>
                </li>
                <li>
                    <a href="/pesanpetugas">
                        <div class="parent-icon"><i class="fadeIn animated bx bx-comment-detail"></i></div>
                        <div class="menu-title">Pesan <span class="alert-count">{{ unreadCount }}</span></div>
                    </a>
                </li>
                <li>
                    <a href="/rangkingpetugas">
                        <div class="parent-icon"><i class="fadeIn animated bx bx-trophy"></i></div>
                        <div class="menu-title">Rangking</div>
                    </a>
                </li>
                <li>
                    <a>
                        <div class="parent-icon"><i class="fadeIn animated bx bx-log-out"></i></div>
                        <div class="menu-title">
                            <Link class="menu-title" :href="route('logout')" method="post" as="button">Keluar</Link>
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
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"></li>
                        </ol>
                    </nav>
                </div>
                <div class="card">
                    <div class="card-body">
                        <h4 class="mb-0 jarak-top-kurang5">TABEL RANKING LOMBA UI /UX</h4>
                        <hr class="c-mt10" />
                        <a class="btn btn-danger" @click="updateStatus('tidak_lolos')">Tidak lolos</a>
                        <a class="btn btn-primary crud-width120" @click="updateStatus('lolos')">Lolos</a>
                        <br><br>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead class="table-dark">
                                    <tr>
                                        <th class="width-id">ID</th>
                                        <th class="crud-width-150">Nama Tim</th>
                                        <th class="crud-width-180">Judul</th>
                                        <th class="crud-width100">Instansi</th>
                                        <th class="crud-width100">Hasil</th>
                                        <th class="crud-width-70">Status</th>
                                        <th class="crud-width-70">Aksi</th>
                                        <td class="crud-width-40">
                                            <input type="checkbox" v-model="selectAll" @change="toggleSelectAll">
                                        </td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="reg_lomba in reg_lombas" :key="reg_lomba?.id">
                                        <td>{{ reg_lomba.id }}</td>
                                        <td>{{ reg_lomba?.team?.name_team }}</td>
                                        <td>{{ reg_lomba?.submission?.title }}</td>
                                        <td>{{ reg_lomba?.team?.instansi }}</td>
                                        <td>{{ reg_lomba.value_total }}</td>
                                        <td>{{ reg_lomba.status_kelulusan }}</td>
                                        <td class="btn-crud">
                                            <a class="btn btn-secondary"
                                                :href="`/detailtimpetugas/${reg_lomba?.team?.id}`"><i
                                                    class="bi bi-eye"></i></a>
                                        </td>
                                        <td>
                                            <input type="checkbox" v-model="selectedLombas" :value="reg_lomba.id">
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
import { defineProps, ref, onMounted } from 'vue';
import axios from 'axios';
import Swal from 'sweetalert2';

const { name, username, reg_lombas } = defineProps(['name', 'username', 'reg_lombas']);

const unreadCount = ref(0);
const selectedLombas = ref([]);
const selectAll = ref(false);

const props = {
    name: {
        type: String,
    },
    username: {
        type: String,
    },
    reg_lombas: {
        type: Array,
    },
};

onMounted(async () => {
    try {
        const response = await axios.get('/api/unread-messages');
        unreadCount.value = response.data.unreadCount;
    } catch (error) {
        console.error(error);
    }
});

const updateStatus = async (status) => {
    try {
        await axios.post('/api/update-status/kelulusan', {
            ids: selectedLombas.value,
            status: status
        });
        // Update the local data to reflect changes
        selectedLombas.value.forEach(id => {
            const regLomba = reg_lombas.find(lomba => lomba.id === id);
            if (regLomba) {
                regLomba.status_kelulusan = status;
            }
        });
        await Swal.fire({
            title: 'Success!',
            text: 'Status telah diubah !',
            icon: 'success',
            confirmButtonText: 'OK'
        });
        selectedLombas.value = [];
    } catch (error) {
        console.error(error);
    }
};

const toggleSelectAll = () => {
    if (selectAll.value) {
        selectedLombas.value = reg_lombas.map(lomba => lomba.id);
    } else {
        selectedLombas.value = [];
    }
};
</script>
