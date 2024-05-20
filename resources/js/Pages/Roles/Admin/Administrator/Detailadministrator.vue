<script setup>
import { Link } from '@inertiajs/vue3';
import { useForm } from "@inertiajs/vue3";
import { Head } from "@inertiajs/vue3";
import { router } from "@inertiajs/vue3";

const { name, username, users } = defineProps(['name', 'username', 'users']);

console.log(name); // Contoh penggunaan di dalam script setup
console.log(username);

// Definisikan properti yang diterima oleh komponen
const props = {
    users: {
        type: Array,
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
                        <div class="navbar-left">
                            <a href="/">
                                <img src="/bootstrap/images/logo.png" alt="Logo">
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
                                <label class="c-mb5-black"><b>Nama Lengkap</b></label>
                                <div class="data-tim">{{ users.name }}</div>
                            </div>
                            <div class="col-md-6">
                                <label class="c-mb5-black"><b>Username</b></label>
                                <div class="data-tim">{{ users.username }}</div>
                            </div>
                            <!-- <div class="col-md-6">
                                <label class="c-mb5-black"><b>Password</b></label>
                                <div class="data-tim">{{ users.password }}</div>
                            </div> -->
                            <div class="col-md-6">
                                <label class="c-mb5-black"><b>Email</b></label>
                                <div class="data-tim">{{ users.email }}</div>
                            </div>
                            <div class="col-md-6">
                                <label class="c-mb5-black"><b>Role</b></label>
                                <div class="data-tim">{{ getRoleName(users.role) }}</div>
                            </div>
                            <div class="col-md-6">
                                <label class="c-mb5-black"><b>Tanggal Dibuat</b></label>
                                <div class="data-tim">{{ formatDate(users.created_at) }}</div>
                            </div>
                        </div>
                        <label class="c-mb5-black"><b>Lomba</b></label>
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