<template>
    <div class="wrapper">
        <!--start header -->
        <header>
            <div class="c-topbar">
                <nav class="navbar navbar-expand">
                    <!-- Navbar tambah untuk logo di kiri -->
                    <div class="navbar-tambah">
                        <div class="navbar-left" v-for="setting in settings" :key="setting.id">
                            <a href="/">
                                <img :src="setting.logo1 ? `/storage/${setting.logo1}` : '/bootstrap/images/logo1default.jpg'"
                                    style="width: 100px; margin-left: -15px;">
                            </a>
                        </div>
                    </div>
                    <!-- Mobile toggle menu -->
                    <!-- Search bar -->
                    <div class="search-bar flex-grow-1">
                    </div>
                    <!-- Top menu -->
                    <div class="top-menu ms-auto">
                        <ul class="navbar-nav align-items-center">
                            <div class="user-info ps-3">
                                <p class="user-name mb-0">{{ $page.props.userData.name }}</p>
                                <p class="user-role">{{ $page.props.userData.username }}</p>
                            </div>
                            <div class="parent-icon posisi-icon"><i class="bx bx-user-circle c-font48"></i>
                            </div>
                        </ul>
                    </div>
                </nav>
            </div>
        </header>
        <!--end header -->
        <!--start page wrapper -->
        <div class="page-wrapper-new">
            <div class="page-content">
                <div class="card">
                    <h5 class="p-3">ANGGOTA TIM</h5>
                    <div class="row row-cards jarak-data-peserta">
                        <div class="col-md-6 col-lg-3 crud-max-width260" v-for="member in teamMembers" :key="member.id">
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
                        <div class="col-md-6 col-lg-3 crud-max-width260">
                            <div class="card">
                                <div class="card-header btn-crud">
                                    <br>
                                    <h6><b></b></h6>
                                </div>
                                <div class="card-body p-4 text-center posisi-mb23">
                                    <button class="btn-close posisi-close" @click="removeMember(teamMembers.length - 1)"
                                        aria-label="Close">
                                        &times;
                                    </button>
                                    <div class="btn-crud">
                                        <button class="btn btn-white btn-putih" @click="showPopup"> + </button>
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="btn-posisi">
                        <button class="btn btn-danger button-left margin-afkar" @click="goBack()">Batal</button>
                        <button @click="saveTeamMembers" class="btn btn-primary button-right">Simpan</button>
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
                                        {{ user.name }}
                                        <br>
                                        ({{ user.email }})
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

const { userData, users, team, settings, logo1 } = defineProps(['userData', 'users', 'team', 'settings', 'logo1']);


const props = {
    settings: {
        type: Object, // Menggunakan "type" untuk menentukan tipe data props
        default: () => ({}), // Menggunakan "default" jika props tidak diberikan
    },
    logo1: {
        type: String, // Menentukan tipe data logo sebagai String
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

const teamMembers = ref([
    {
        id: userData.id, // Pastikan field `id` termasuk
        role: 'Ketua',
        name: userData.name,
        nik: userData.nik,
        instansi: userData.instansi,
        photo: userData.photo
    },
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
                role: `Anggota ${teamMembers.value.length}`,
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
        text: ' ',
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
                    role: member.role === 'Ketua' ? 'Ketua' : 'Anggota'
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


const goBack = () => {
    window.history.back();
};
</script>
