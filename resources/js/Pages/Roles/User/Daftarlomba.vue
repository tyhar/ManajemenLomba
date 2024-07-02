<template>
    <!--wrapper-->
    <div class="wrapper">
        <!--sidebar wrapper -->
        <div class="sidebar-wrapper" data-simplebar="true">
            <div class="sidebar-header">
                <div  v-for="setting in settings" :key="setting.id">
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
                    <a @click="clearNotifications" href="/notifikasipeserta">
                        <div class="parent-icon"><i class="bx bx-user-circle"></i></div>
                        <div class="menu-title">Notifikasi <span class="alert-count" v-if="notifCount">{{ notifCount }}</span></div>
                    </a>
                </li>
                <li>
                <li>
                    <a href="/reportpeserta">
                        <div class="parent-icon"><i class="fadeIn animated bx bx-comment-detail"></i>
                        </div>
                        <div class="menu-title">Report <span></span></div>
                    </a>
                </li>
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
                <div class="card">
                    <div class="card-body" v-if="team">
                        <h4 class="mb-0 jarak-teks1">DAFTAR LOMBA </h4>
                        <div class="card">
                            <h5 class="p-3">TIM LOMBA {{ team?.lomba?.name_lomba }}</h5>
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
                                    <label class="c-mb5-black"><b>EMAIL</b></label>
                                    <div class="data-tim">{{ team.email }}</div>
                                </div>
                                <div class="col-md-2 jarak-daftar-lomba" v-if="team">
                                    <label class="c-mb5-black"><b>NO WHATSAPP</b></label>
                                    <div class="data-tim">{{ team.phone }}</div>
                                </div>
                                <div class="col-md-2 jarak-daftar-lomba" v-if="team">
                                    <label class="c-mb5-black"><b>PEMBAYARAN</b></label>
                                    <div class="data-tim c-mb-70"><a :href="`/datatimshow/${team.id}`">Lihat Bukti</a>
                                    </div>
                                </div v-if="team">
                                <a :href="`/datatim/${team.id}`" class="btn btn-primary radius-5 isi-data">Isi Data</a>
                            </div>
                        </div>

                        <div class="card">
                            <h5 class="p-3">ANGGOTA TIM</h5>
                            <div class="row row-cards jarak-data-peserta">
                                <div class="col-md-6 col-lg-3 crud-max-width260" v-for="member in members"
                                    :key="member.id">
                                    <div class="card">
                                        <div class="card-header btn-crud ">
                                            <h6><b>{{ member.role }}</b></h6>

                                        </div>
                                        <div class="card-body p-4 text-center posisi-mb23">
                                            <div class="btn-crud">
                                                <img :src="member.photo ? `/storage/${member.photo}` : '/bootstrap/images/default2.png'"
                                                    height="120" alt="..." class="img-fluidc rounded">
                                            </div>
                                            <br>
                                            <h6><b>{{ member.name }}</b></h6>
                                            <br>
                                            <div class="posisi-mb7">{{ member.nik }}</div>
                                            <div class="text-muted">{{ member.instansi }}</div>
                                        </div>
                                    </div>
                                </div>
                                <br><br>
                                <a class="btn btn-primary radius-5 isi-data2" :href="`/tambahanggota/${team.id}`">Isi
                                    Anggota</a>
                            </div>
                            <br><br> <br><br> 
                        </div>
                        <div class="card">
                            <h5 class="p-3">PENGUMPULAN KARYA</h5>
                            <div class="card-body p-4 text-center">
                                <div class="row">
                                    <div class="col-md-4 text-left" v-if="submissions">
                                        <label class="jarak-teks05"><b>JUDUL</b></label>
                                        <div class="data-tim">{{ submissions.title }}</div>
                                    </div>
                                    <div class="col-md-3 text-left" v-if="submissions">
                                        <label class="jarak-teks05"><b>DOKUMEN</b></label>
                                        <div class="data-tim"><a :href="`/submissionsurat/${submissions.id}`">Lihat
                                                Dokumen</a></div>
                                    </div>
                                    <div class="col-md-3 text-left" v-if="submissions">
                                        <label class="jarak-teks05"><b>FILE</b></label>
                                        <div class="data-tim"><a :href="`/submissionshow/${submissions.id}`">Lihat
                                                File</a>
                                        </div>
                                    </div>
                                    <div class="col-md-2 text-left" v-if="submissions">
                                        <label class="jarak-teks05"><b>LINK</b></label>
                                        <div class="data-tim c-mb-70">
                                            <a :href="submissions.link" target="_blank">Buka Link</a>
                                        </div>
                                    </div>

                                    <div>
                                        <a :href="`/submission/${team.id}`"
                                            class="btn btn-primary radius-5 isi-data jarak-isi-data">Isi Data</a>
                                    </div>
                                    <div class="text-left" v-if="submissions">
                                        <label class="jarak-teks05"><b>DESKRIPSI</b></label>
                                        <div class="c-mb20 rata-tengah">{{ submissions.description }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="btn-dl">
                            <button @click="submitForm" class="btn btn-primary radius-5 lebar-btn">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--end page wrapper -->
    </div>
</template>

<script setup>
import { defineProps, ref, onMounted, computed, watch } from 'vue';
import { Link, useForm, router } from '@inertiajs/vue3';
import Swal from 'sweetalert2';
import axios from 'axios';

const { userData, users, team, submissions, lombas, members,settings,logo1,notifCount } = defineProps(['userData', 'users', 'team', 'submissions', 'lombas', 'members','settings','logo1','notifCount']);




const props = {
    team: {
        type: Object,
    },
    submissions: {
        type: Object,
    },
    lombas: {
        type: String,
    },
    settings: {
        type: Object, // Menggunakan "type" untuk menentukan tipe data props
        default: () => ({}), // Menggunakan "default" jika props tidak diberikan
    },
    logo1: {
        type: String, // Menentukan tipe data logo sebagai String
    },
    notifCount: {
    type: [Number, null],
    default: null,
  },
};



// Define form state using Inertia's useForm
const form = useForm({
    name: userData.name,
    username: userData.username,
    email: userData.email,
    instansi: userData.instansi,
    nik: userData.nik,
    photo: null
});

const isPopupVisible = ref(false);
const searchQuery = ref('');
const searchResults = ref(users); // Use the users data passed from the controller


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

function removeMember(index) {
    if (teamMembers.value.length > 1) { // Pastikan setidaknya ada satu anggota tetap dalam tim
        teamMembers.value.splice(index, 1);
        Swal.fire({
            title: 'Berhasil!',
            text: 'Anggota berhasil dihapus.',
            icon: 'success',
            confirmButtonText: 'OK'
        });
    } else {
        Swal.fire({
            title: 'Peringatan!',
            text: 'Tim harus memiliki setidaknya satu anggota.',
            icon: 'warning',
            confirmButtonText: 'OK'
        });
    }
}

function addMember() {
    if (teamMembers.value.length >= 5) {
        Swal.fire({
            title: 'Peringatan!',
            text: 'Maksimal anggota tim adalah 5 peserta.',
            icon: 'warning',
            confirmButtonText: 'OK'
        });
    } else {
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
}

async function saveTeamMembers() {
    const result = await Swal.fire({
        title: 'Apakah anda yakin?',
        text: 'Data yang disimpan tidak dapat diubah. Apakah Anda ingin melanjutkan?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Simpan',
        cancelButtonText: 'Batal'
    });

    if (result.isConfirmed) {
        try {
            const url = `/team-member/${team.id}`;

            await axios.post(url, {
                members: teamMembers.value.map(member => ({
                    user_id: member.id,
                    role: member.role === 'ketua' ? 'ketua' : 'member'
                }))
            });

            Swal.fire({
                title: 'Berhasil!',
                text: 'Anggota tim berhasil disimpan!',
                icon: 'success',
                confirmButtonText: 'OK'
            }).then(() => {
                window.location.href = `/daftarlomba/${team?.lomba?.id}`;
            });
        } catch (error) {
            console.error('Error saving team members:', error);

            let errorMessage = 'Gagal menyimpan anggota tim.';
            if (error.response && error.response.data && error.response.data.message) {
                errorMessage = error.response.data.message;
            }

            Swal.fire({
                title: 'Gagal Menyimpan!',
                text: 'Maaf, anda tidak dapat menambahkan peserta yang sudah ada sebelumnya!',
                icon: 'warning',
                confirmButtonText: 'OK'
            }).then(() => {
                window.location.href = `/daftarlomba/${team?.lomba?.id}`;
            });
        }
    }
}

function showRole(memberId, role) {
    const memberElement = document.getElementById(`member-${memberId}`);
    if (memberElement && !memberElement.innerHTML.includes(role)) {
        memberElement.innerHTML += ` (${role})`;
    }
}

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
async function submitForm() {
    const result = await Swal.fire({
        title: 'Peringatan!',
        text: 'Periksa Kelengkapan Data Anda!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Ya, Submit',
        cancelButtonText: 'Batal'
    });

    if (result.isConfirmed) {
        try {
            await router.post('/daftarlomba', {
                user_id: userData.id,
                team_id: team.id,
                lomba_id: team?.lomba?.id,
                submission_id: submissions.id
            });

            await axios.patch(`/api/update-status-ketua/${team?.lomba?.id}`, { status: 'sudah_submit' });

            Swal.fire({
                title: 'Berhasil!',
                text: 'Data berhasil disimpan.',
                icon: 'success',
                confirmButtonText: 'OK',
            });
        } catch (error) {
            console.error('Error submitting form:', error);
            Swal.fire({
                title: 'Gagal!',
                text: 'Data yang anda isi belum lengkap silahkan periksa kembali!',
                icon: 'warning',
                confirmButtonText: 'OK'
            });
        }
    }
}

</script>
