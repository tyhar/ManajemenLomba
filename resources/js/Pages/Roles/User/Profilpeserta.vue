<script setup>
import { Link, useForm } from '@inertiajs/vue3';
import { defineProps, ref, onMounted, computed } from 'vue';
import axios from 'axios';
import Swal from 'sweetalert2';

// Define props
const { userData } = defineProps(['userData']);
const notifCount = ref(0);

// Define form state using Inertia's useForm
const form = useForm({
    name: userData.name,
    username: userData.username,
    email: userData.email,
    instansi: userData.instansi,
    nik: userData.nik,
    phone: userData.phone,
    photo: null
});

onMounted(async () => {
    try {
        const response = await axios.get('/api/unread-notifikasi');
        notifCount.value = response.data.notifCount;
    } catch (error) {
        console.error(error);
    }

});

// Method to handle form submission
const submit = () => {
    form.post(route('profilpeserta.store'), {
        onSuccess: () => {
            form.reset('photo');
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: 'Your profile data has been successfully updated',
                confirmButtonText: 'OK'
            });
        }
    });
};





</script>

<template>
    <!--wrapper-->
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
                    <a href="/notifikasipeserta">
                        <div class="parent-icon"><i class="bx bx-user-circle"></i></div>
                        <div class="menu-title">Notifikasi<span class="alert-count">{{ notifCount }}</span></div>
                    </a>
                </li>
                <li>
                    <a href="/reportpeserta">
                        <div class="parent-icon"><i class="fadeIn animated bx bx-comment-detail"></i></div>
                        <div class="menu-title">Report <span class="alert-count">1</span></div>
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
                <div class="container">
                    <div class="main-body">
                        <form @submit.prevent="submit">
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="d-flex flex-column align-items-center text-center">
                                                <div class="ukuran-foto">
                                                    <img :src="userData.photo ? `/storage/${userData.photo}` : '/bootstrap/images/default1.jpg'"
                                                        alt="Profile" class="rounded-circle p-1 bg-primary" width="190"
                                                        height="150">
                                                </div>
                                                <input type="file"
                                                    class="form-control form-control-sm btn-profil2 img-profil"
                                                    @change="e => form.photo = e.target.files[0]">
                                            </div>
                                            <div class="c-mtk">
                                                <p class="keterangan-foto f-italic">Max file size: 2MB</p>
                                                <p class="keterangan-foto f-italic">Format: .jpg, .png, .jpeg</p>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-8">
                                    <div class="card">
                                        <div class="card-body label-bawah">
                                            <div class="row mb-3">
                                                <div class="col-sm-3">
                                                    <h6 class="mb-0 profil-font15">Nama Lengkap</h6>
                                                </div>
                                                <div class="col-sm-9 text-secondary">
                                                    <input type="text" class="form-control" v-model="form.name">
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-sm-3">
                                                    <h6 class="mb-0">Username</h6>
                                                </div>
                                                <div class="col-sm-9 text-secondary">
                                                    <input type="text" class="form-control" v-model="form.username">
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-sm-3">
                                                    <h6 class="mb-0">Email</h6>
                                                </div>
                                                <div class="col-sm-9 text-secondary">
                                                    <input type="email" class="form-control" v-model="form.email"
                                                        readonly>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-sm-3">
                                                    <h6 class="mb-0">NIK</h6>
                                                </div>
                                                <div class="col-sm-9 text-secondary">
                                                    <input type="text" class="form-control" v-model="form.nik">
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-sm-3">
                                                    <h6 class="mb-0">Instansi</h6>
                                                </div>
                                                <div class="col-sm-9 text-secondary">
                                                    <input type="text" class="form-control" v-model="form.instansi">
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-sm-3">
                                                    <h6 class="mb-0">Kontak</h6>
                                                </div>
                                                <div class="col-sm-9 text-secondary">
                                                    <input type="text" class="form-control" v-model="form.phone">
                                                </div>
                                            </div>
                                            <div class="pperbarui">
                                                <button type="submit"
                                                    class="btn btn-primary  crud-width-435">Perbarui</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!--end page wrapper -->
    </div>
    <!--end switcher-->
</template>
