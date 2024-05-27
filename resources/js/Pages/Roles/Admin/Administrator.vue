<script setup>
import { Link, useForm, router } from '@inertiajs/vue3';
import { Head } from "@inertiajs/vue3";
import { ref, computed } from "vue";
// import { usePage } from "@inertiajs/vue3";

defineProps({
    users: {
        type: Object,
    },
});

const deleteForm = useForm({});

const deleteAdministrator = (id) => {
    if (confirm("Are you sure you want to delete this user?")) {
        deleteForm.delete(route("administrator.destroy", id), {
            preserveScroll: true,
        });
    }
};

// Define the users prop (pake ini juga bisa)
// const props = defineProps({
//   users: {
//     type: Array,
//     required: true,
//   },
// });

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

</script>
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
                    <a href="/superadmin">
                        <div class="parent-icon"><i class='bx bx-home-circle'></i>
                        </div>
                        <div class="menu-title">Dashboard</div>
                    </a>
                </li>
                <li>
                    <a href="javascript:;" class="has-arrow">
                        <div class="parent-icon"><i class="fadeIn animated bx bx-plus-circle"></i>
                        </div>
                        <div class="menu-title">Event</div>
                    </a>
                    <ul>
                        <li class="jarak-dropdown"> <a href="/lomba">Lomba</a>
                        </li>
                        <li class="jarak-dropdown"> <a href="/administrator">Administrator</a>
                        </li>
                        <li class="jarak-dropdown"> <a href="/sponsor">Sponsor</a>
                        </li>
                        <li class="jarak-dropdown"> <a href="/berita">Berita</a>
                        </li>
                        <li class="jarak-dropdown"> <a href="/setting">Setting</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="/tim">
                        <div class="parent-icon"><i class="fadeIn animated lni lni-users"></i>
                        </div>
                        <div class="menu-title">Tim</div>
                    </a>
                </li>
                <li>
                    <a href="/partisipan">
                        <div class="parent-icon"><i class="fadeIn animated bx bx-street-view"></i>
                        </div>
                        <div class="menu-title">Partisipan</div>
                    </a>
                </li>
                <li>
                    <a href="/pesan">
                        <div class="parent-icon"><i class="fadeIn animated bx bx-comment-detail"></i>
                        </div>
                        <div class="menu-title">Pesan <span class="alert-count">1</span></div>
                    </a>
                </li>
                <li>
                    <a href="/rangking">
                        <div class="parent-icon"><i class="fadeIn animated bx bx-trophy"></i>
                        </div>
                        <div class="menu-title">Rangking</div>
                    </a>
                </li>
                <li>
                    <a>
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
                                <p class="user-name mb-0">Habib Shohiburrotib</p>
                                <p class="user-role">habib</p>
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
                        <h4 class="mb-0 jarak-top-kurang5">Tabel Administrator</h4>
                        <hr class="c-mt10" />
                        <a class="btn btn-success jarak-top-kurang7" :href="route('administrator.create')">
                            Tambah Administrator
                        </a>
                        <hr class="c-mt10" />
                        <div class="table-responsive">
                            <label class="dropdown-crud">Tampilkan Role</label>
                            <select class="form-select2">
                                <option selected>Semua</option>
                                <option>Admin</option>
                                <option>Juri</option>
                                <option>Petugas</option>
                            </select>
                            <br><br>
                            <table id="example" class="table table-bordered">
                                <thead class="table-dark">
                                    <tr>
                                        <th class="width-id">ID</th>
                                        <th class="crud-width-90">Nama</th>
                                        <th class="crud-width-70">Username</th>
                                        <th class="crud-width-110">Email</th>
                                        <th class="crud-width-50">Role</th>
                                        <th class="crud-width-90">Lomba</th>
                                        <th class="crud-width-90">Tanggal</th>
                                        <th class="crud-width-50">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="user in users" :key="user.id">
                                        <td>{{ user.id }}</td>
                                        <td>{{ user.username }}</td>
                                        <td>{{ user.name }}</td>
                                        <td>{{ user.email }}</td>
                                        <td>{{ getRoleName(user.role) }}</td>
                                        <td></td>
                                        <td></td>
                                        <!-- <td>Lomba Desain</td>
                                            <td>Maret 1, 2024</td> -->
                                        <td class="btn-crud">
                                            <a class="btn btn-secondary" :href="route('administrator.show', user.id)">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--end page wrapper -->
    </div>
    <!--end wrapper-->
</template>
<script>
$(document).ready(function () {
    $('#example').DataTable();
});
</script>