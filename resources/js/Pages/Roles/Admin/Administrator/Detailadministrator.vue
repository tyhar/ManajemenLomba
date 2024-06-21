<script setup>
import { Link } from '@inertiajs/vue3';
import { useForm } from "@inertiajs/vue3";
import { Head } from "@inertiajs/vue3";
import { router } from "@inertiajs/vue3";

const { name, username, users, settings, logo1 } = defineProps(['name', 'username', 'users', 'settings', 'logo1']);



// Definisikan properti yang diterima oleh komponen
const props = {
    users: {
        type: Array,
    },
    settings: {
        type: Object, // Menggunakan "type" untuk menentukan tipe data props
        default: () => ({}), // Menggunakan "default" jika props tidak diberikan
    },
    logo1: {
        type: String, // Menentukan tipe data logo sebagai String
    },
};






// Define the role names mapping
const roleNames = {
    1: 'Admin',
    2: 'Petugas',
    3: 'User',
    4: 'Juri',
};

// Create a function to get the role name based on the role number
const getRoleName = (role) => {
    return roleNames[role] || 'Unknown';
};

// Function to view user details
const viewDetails = (userId) => {
    // Logic to navigate to user details page, if needed
};

// Function to format date
const formatDate = (dateString) => {
    const date = new Date(dateString);
    return date.toLocaleDateString('en-US', {
        year: 'numeric',
        month: 'long',
        day: 'numeric',
        hour: 'numeric',
        minute: 'numeric',
        second: 'numeric',
        hour12: false // Use 24-hour format
    });
};
</script>
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
                                    alt="Logo" style="width: 135px; margin-left: -15px;">
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
                    <div class="card-body">
                        <h4 class="mb-0">DETAIL ADMINISTRATOR</h4>
                        <hr />
                        <div class="row">
                            <div class="col-md-6 c-mb10">
                                <label class="c-mb5-black"><b>NAMA LENGKAP</b></label>
                                <div class="data-tim">{{ users.name }}</div>
                            </div>
                            <div class="col-md-6">
                                <label class="c-mb5-black"><b>USERNAME</b></label>
                                <div class="data-tim">{{ users.username }}</div>
                            </div>
                            <div class="col-md-6">
                                <label class="c-mb5-black"><b>PASSWORD</b></label>
                                <div class="data-tim">*********</div>
                            </div>
                            <div class="col-md-6">
                                <label class="c-mb5-black"><b>EMAIL</b></label>
                                <div class="data-tim">{{ users.email }}</div>
                            </div>
                            <div class="col-md-6">
                                <label class="c-mb5-black"><b>ROLE</b></label>
                                <div class="data-tim">{{ getRoleName(users.role) }}</div>
                            </div>
                            <div class="col-md-6">
                                <label class="c-mb5-black"><b>TANGGAL</b></label>
                                <div class="data-tim">{{ formatDate(users.created_at) }}</div>
                            </div>
                        </div>
                        <label class="c-mb5-black"><b>LOMBA</b></label>
                        <ul>
                            <li v-for="lomba in users.lomba" :key="lomba.id">{{ lomba.name_lomba }}</li>
                        </ul>
                        <div class="btn-posisi">
                            <button class="btn btn-danger btn-kembali"
                                onclick="window.location.href='/administrator'">Kembali</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--end page wrapper -->
    </div>
</template>