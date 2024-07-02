<template>
    <!--wrapper-->
    <div class="wrapper">
        <!--sidebar wrapper -->
        <div class="sidebar-wrapper" data-simplebar="true">
            <div class="sidebar-header" v-for="setting in settings" :key="setting.id">
                <div>
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
                    <a :href="route('admin')">
                        <div class="parent-icon"><i class='bx bx-home-circle'></i></div>
                        <div class="menu-title">Dashboard</div>
                    </a>
                </li>
                <li>
                    <a href="javascript:;" class="has-arrow">
                        <div class="parent-icon"><i class="fadeIn animated bx bx-plus-circle"></i></div>
                        <div class="menu-title">Event</div>
                    </a>
                    <ul>
                        <li class="jarak-dropdown"><a :href="route('lomba.index')">Lomba</a></li>
                        <li class="jarak-dropdown"><a href="/administrator">Administrator</a></li>
                        <li class="jarak-dropdown"><a href="/sponsor">Sponsor</a></li>
                        <li class="jarak-dropdown"><a href="/berita">Berita</a></li>
                        <li class="jarak-dropdown"><a href="/setting">Setting</a></li>
                    </ul>
                </li>
                <li>
                    <a href="/tim">
                        <div class="parent-icon"><i class="fadeIn animated lni lni-users"></i></div>
                        <div class="menu-title">Tim</div>
                    </a>
                </li>
                <li>
                    <a href="/partisipan">
                        <div class="parent-icon"><i class="fadeIn animated bx bx-user-circle c-font25"></i></div>
                        <div class="menu-title">Partisipan</div>
                    </a>
                </li>
                <li>
                    <a href="/pesan">
                        <div class="parent-icon"><i class="fadeIn animated bx bx-comment-detail"></i></div>
                        <div class="menu-title">Pesan <span class="alert-count">1</span></div>
                    </a>
                </li>
                <li>
                    <a href="/rangking">
                        <div class="parent-icon"><i class="fadeIn animated bx bx-trophy"></i></div>
                        <div class="menu-title">Rangking</div>
                    </a>
                </li>
                <li>
                    <a href="/">
                        <div class="parent-icon"><i class="fadeIn animated bx bx-log-out"></i></div>
                        <div class="menu-title">Keluar</div>
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
                        <h4 class="mb-0 jarak-top-kurang5">TABEL KRITERIA</h4>
                        <hr class="c-mt10" />
                        <a class="btn btn-success jarak-top-kurang7" :href="route('lomba.index')">Lomba</a>
                        <a class="btn btn-info jarak-top-kurang7" :href="route('kriteria.create')">Tambah Kriteria</a>
                        <hr class="c-mt10" />
                        <div class="table-responsive">
                            <table id="kriteriaTable" class="table mt-3 table-bordered">
                                <thead class="table-dark">
                                    <tr>
                                        <th class="width-id2">No</th>
                                        <th class="crud-width-290">Kriteria</th>
                                        <th class="crud-width60">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(kriteria, index)  in kriterias.data" :key="kriteria.id">
                                        <td>{{ index + 1 }}</td>
                                        <td>{{ kriteria.name_kriteria }}</td>
                                        <td class="btn-crud">
                                            <a class="btn btn-primary" :href="route('kriteria.edit', kriteria.id)"><i
                                                    class="bi bi-pencil-square"></i></a>
                                            <button class="btn btn-danger" @click="deleteKriteria(kriteria.id)"><i
                                                    class="bi bi-trash"></i></button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <br>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--end page wrapper -->
    </div>
    <!--end wrapper-->
</template>

<script setup>
import { defineProps } from "vue";
import { Link, useForm } from "@inertiajs/vue3";
import Swal from 'sweetalert2';
// import 'datatables.net';
// import $ from 'jquery';

const { name, username, kriterias, settings, logo1, bobots } = defineProps(['name', 'username', 'kriterias', 'settings', 'logo1', 'bobots']);

const props = {
    settings: {
        type: Object, // Menggunakan "type" untuk menentukan tipe data props
        default: () => ({}), // Menggunakan "default" jika props tidak diberikan
    },
    logo1: {
        type: String, // Menentukan tipe data logo sebagai String
    },

};

const deleteForm = useForm({});

const deleteKriteria = (id) => {
    Swal.fire({
        title: 'Apakah anda yakin?',
        text: "Apakah anda ingin menghapus kriteria !",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, hapus!'
    }).then((result) => {
        if (result.isConfirmed) {
            deleteForm.delete(route("kriteria.destroy", id), {
                preserveScroll: true,
                onSuccess: () => {
                    Swal.fire('Terhapus!', 'Kriteria berhasil dihapus.', 'Berhasil');
                }
            });
        }
    });
};

const deleteBobot = (id) => {
    Swal.fire({
        title: 'Apakah anda yakin?',
        text: "Apakah anda ingin menghapus kriteria !",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, hapus!'
    }).then((result) => {
        if (result.isConfirmed) {
            deleteForm.delete(route("bobot.destroy", id), {
                preserveScroll: true,
                onSuccess: () => {
                    Swal.fire('Berhasil!', 'Kriteria berhasil dihapus.', 'success');
                }
            });
        }
    });
};




$(document).ready(function () {
    $('#kriteriaTable').DataTable();
    $('#bobotTable').DataTable();
});
</script>