<template>
    <!--wrapper-->
    <div class="wrapper">
        <!--sidebar wrapper -->
        <div class="sidebar-wrapper" data-simplebar="true">
            <div class="sidebar-header">
                <div>
                    <a href="/">
                        <img src="bootstrap/images/logocb.png" class="logo-icon" alt="logo icon">
                    </a>
                </div>
                <div class="toggle-icon ms-auto"><i class="fadeIn animated bx bx-menu"></i>
                </div>
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
                    <a href="/daftarlomba">
                        <div class="parent-icon"><i class="fadeIn animated bx bx-street-view"></i>
                        </div>
                        <div class="menu-title">Daftar Lomba</div>
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
                        <div class="menu-title">Notifikasi<span class="alert-count">1</span></div>
                    </a>
                </li>
                <li>
                <li>
                    <a href="/reportpeserta">
                        <div class="parent-icon"><i class="fadeIn animated bx bx-comment-detail"></i>
                        </div>
                        <div class="menu-title">Report <span class="alert-count">1</span></div>
                    </a>
                </li>
                <a href="/">
                    <div class="parent-icon"><i class="fadeIn animated bx bx-log-out"></i>
                    </div>
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
                <div class="card">
                    <div class="card-body">
                        <h4 class="mb-0 jarak-teks1">Daftar lomba</h4>
                        <div class="card">
                            <h5 class="p-3">Info Tim Lomba</h5>
                            <hr class="garis">
                            <div class="row">
                                <div class="col-md-2 jarak-daftar-lomba" v-if="team">
                                    <label class="c-mb5-black"><b>NAMA TIM</b></label>
                                    <div class="data-tim">{{ team.name_team }}</div>
                                </div>
                                <div class="col-md-2 jarak-daftar-lomba" v-if="team">
                                    <label class="c-mb5-black"><b>INSTANSI</b></label>
                                    <div class="data-tim">{{ team.instansi }}</div>
                                </div>
                                <div class="col-md-2 jarak-daftar-lomba" v-if="team">
                                    <label class="c-mb5-black"><b>LOMBA</b></label>
                                    <ul>
                                        <li v-for="lomba in team.lomba" :key="lomba.id">{{ lomba.name_lomba }}</li>
                                    </ul>
                                </div>
                                <div class="col-md-2 jarak-daftar-lomba" v-if="team">
                                    <label class="c-mb5-black"><b>EMAIL</b></label>
                                    <div class="data-tim">{{ team.email }}</div>
                                </div>
                                <div class="col-md-2 jarak-daftar-lomba" v-if="team">
                                    <label class="c-mb5-black"><b>NO WHATSAPP</b></label>
                                    <div class="data-tim">{{ team.phone }}</div>
                                </div>
                                <div class="col-md-2 jarak-daftar-lomba" v-if="team">
                                    <label class="c-mb5-black"><b>STATUS</b></label>
                                    <div class="data-tim">{{ team.status }}</div>
                                </div>
                                <div class="col-md-2 jarak-daftar-lomba" v-if="team">
                                    <label class="c-mb5-black"><b>PEMBAYARAN</b></label>
                                    <div class="data-tim c-mb-70"><a :href="`/datatim/${team.id}`">Lihat Bukti</a></div>
                                </div>
                                <div>
                                    <button onclick="window.location.href='/datatim/create'"
                                        class="btn btn-primary radius-5 isi-data">Isi Data</button>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <h5 class="p-3">Input Anggota Tim</h5>
                            
                            <div class="row row-cards jarak-data-peserta">
                                
                                <div class="col-md-6 col-lg-3 crud-max-width260" v-for="member in teamMembers"
                                    :key="member.id">
                                    <div class="card">
                                        <div class="card-header btn-crud ">
                                            <h6><b>{{ member.role }}</b></h6>
                                        </div>
                                        <div class="card-body p-4 text-center posisi-mb23">
                                            <div class="btn-crud ">
                                                <img :src="member.photo ? `/storage/${member.photo}` : '/bootstrap/images/default2.png'"
                                                    height="120" alt="..." class="img-fluid rounded">
                                            </div>
                                            <br>
                                            <h6><b>{{ member.name }}</b></h6>
                                            <br>
                                            <div class="posisi-mb7">{{ member.nik }}</div>
                                            <div class="text-muted">{{ member.instansi }}</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-3 crud-max-width260">
                                    <div class="card">
                                        <div class="card-header btn-crud">
                                            <h6><b>anggota 1</b></h6>
                                        </div>
                                        <div class="card-body p-4 text-center posisi-mb23">
                                            <div class="btn-crud ">
                                                <button class="btn btn-white btn-putih" @click="showPopup"> + </button>
                                            </div>
                                            <br>
                                        </div>
                                    </div>
                                    <div class="btn-dl">
        <button @click="saveTeamMembers" class="btn btn-primary radius-5 lebar-btn">Save</button>
    </div>
                                </div>
                                
                            </div>
                            
                        </div>
                        <div v-if="isPopupVisible" class="popup">
                            <div class="popup-content">
                                <span class="close" @click="hidePopup">&times;</span>
                                <h5>Input Anggota Tim</h5>
                                <hr />
                                <div class="position-relative">
                                    <input type="text" class="form-control ps-5" placeholder="Search by name"
                                        v-model="searchQuery">
                                    <span class="position-absolute top-50 product-show-edit translate-middle-y">
                                        <i class="bx bx-search"></i>
                                    </span>
                                </div>
                                <div class="overflow-auto">
                                    <ul class="search-results">
                                        <li v-for="user in filteredUsers" :key="user.id" @click="selectUser(user)"
                                            :class="{ 'selected': user.selected }" class="user-item">
                                            <div class="user-info csearch">
                                                {{ user.name }} ({{ user.email }})
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                <div class="border-top btn-crud pt-3">
                                    <button @click="addMember" class="btn-success btn btn-block">
                                        Tambah anggota
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <h5 class="p-3">PENGUMPULAN KARYA</h5>
                            <div class="card-body p-4 text-center">
                                <div class="row">
                                    <div class="col-md-3 text-left" v-if="submissions">
                                        <label class="jarak-teks05"><b>JUDUL</b></label>
                                        <div class="data-tim">{{ submissions.title }}</div>
                                    </div>
                                    <div class="col-md-3 text-left" v-if="submissions">
                                        <label class="jarak-teks05"><b>DESKRIPSI</b></label>
                                        <div class="data-tim">{{ submissions.description }}</div>
                                    </div>
                                    <div class="col-md-3 text-left" v-if="submissions">
                                        <label class="jarak-teks05"><b>File</b></label>
                                        <div class="data-tim"><a :href="`/daftarlomba/${submissions.id}`">Lihat File</a>
                                        </div>
                                    </div>
                                    <div class="col-md-3 text-left" v-if="submissions">
                                        <label class="jarak-teks05"><b>LINK VIDEO</b></label>
                                        <div class="data-tim c-mb-70"> <a :href="submissions.link" target="_blank">Link
                                                Video</a></div>
                                    </div>
                                    <div>
                                        <button onclick="window.location.href='/pengumpulankarya'"
                                            class="btn btn-primary radius-5 isi-data jarak-isi-data">Isi Data</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="btn-dl">
                            <button href="#" class="btn btn-primary radius-5 lebar-btn">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--end page wrapper -->
    </div>
</template>

<script setup>
import { defineProps, ref, computed, watch } from 'vue';
import { Link, useForm, router } from '@inertiajs/vue3';
import Swal from 'sweetalert2';

const { userData, users, team, submissions } = defineProps(['userData', 'users', 'team', 'submissions']);

// Define form state using Inertia's useForm
const form = useForm({
    name: userData.name,
    username: userData.username,
    email: userData.email,
    instansi: userData.instansi,
    nik: userData.nik,
    photo: null
});

const props = {
    team: {
        type: Object,
    },
    submissions: {
        type: Object,
    },
};

const isPopupVisible = ref(false);
const searchQuery = ref('');
const searchResults = ref(users); // Use the users data passed from the controller
const teamMembers = ref([
    {
        id: userData.id, // Ensure the `id` field is included
        role: 'ketua',
        name: userData.name,
        nik: userData.nik,
        instansi: userData.instansi,
        photo: userData.photo
    }
]);

const filteredUsers = computed(() => {
    if (!searchQuery.value) {
        return [];
    }
    return searchResults.value.filter(user =>
        user.name.toLowerCase().includes(searchQuery.value.toLowerCase()) ||
        user.email.toLowerCase().includes(searchQuery.value.toLowerCase())
    );
});

watch(searchQuery, () => {
    searchUsers();
});

function showPopup() {
    isPopupVisible.value = true;
}

function hidePopup() {
    isPopupVisible.value = false;
}

function searchUsers() {
    // Since we are using local data, there's no need for an API call here
    // The filteredUsers computed property will handle the search functionality
}

function selectUser(user) {
    searchResults.value.forEach(u => u.selected = false);
    user.selected = true;
}

function addMember() {
    const selectedUser = searchResults.value.find(user => user.selected);
    if (selectedUser) {
        teamMembers.value.push({
            id: selectedUser.id,
            role: `anggota ${teamMembers.value.length}`,
            name: selectedUser.name,
            nik: selectedUser.nik,
            instansi: selectedUser.instansi,
            photo: selectedUser.photo
        });
        hidePopup();
        Swal.fire({
            title: 'Berhasil!',
            text: 'Anggota berhasil ditambahkan.',
            icon: 'success',
            confirmButtonText: 'OK'
        });
    }
}

async function saveTeamMembers() {
    try {
        await router.post('/team-member', {
            members: teamMembers.value.map(member => ({
                user_id: member.id, // Ensure the `user_id` field is included
                role: member.role === 'ketua' ? 'ketua' : 'member'
            }))
        });
        Swal.fire({
            title: 'Berhasil!',
            text: 'Anggota tim berhasil disimpan!',
            icon: 'success',
            confirmButtonText: 'OK'
        });
    } catch (error) {
        console.error('Error saving team members:', error);
        Swal.fire({
            title: 'Gagal!',
            text: 'Gagal menyimpan anggota tim.',
            icon: 'error',
            confirmButtonText: 'OK'
        });
    }
}
</script>