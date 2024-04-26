<template>
    <!-- wrapper -->
    <div class="wrapper">
        <!-- sidebar wrapper -->
        <div class="sidebar-wrapper" data-simplebar="true">
            <div class="sidebar-header">
                <div>
                    <a href="/">
                        <img src="/bootstrap/images/logocb.png" class="logo-icon" alt="logo icon">
                    </a>
                </div>
                <div class="toggle-icon ms-auto"><i class="fadeIn animated bx bx-menu"></i></div>
            </div>
            <!-- navigation -->
            <ul class="metismenu" id="menu">
                <li>
                    <a href="/superadmin">
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
                        <li class="jarak-dropdown"><a href="/lomba">Lomba</a></li>
                        <li class="jarak-dropdown"><a href="/administrator">Administrator</a></li>
                        <li class="jarak-dropdown"><a href="/tim">Tim</a></li>
                        <li class="jarak-dropdown"><a href="/sponsor">Sponsor</a></li>
                        <li class="jarak-dropdown"><a href="/berita">Berita</a></li>
                        <li class="jarak-dropdown"><a href="/setting">Setting</a></li>
                    </ul>
                </li>
                <li><a href="/partisipan">
                    <div class="parent-icon"><i class="fadeIn animated bx bx-street-view"></i></div>
                    <div class="menu-title">Partisipan</div>
                </a></li>
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
                    <a>
                        <div class="parent-icon"><i class="fadeIn animated bx bx-log-out"></i></div>
                        <div class="menu-title">
                            <Link class="menu-title"
                                  :href="route('logout')"
                                  method="post"
                                  as="button">Logout</Link>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="javascript:;" class="has-arrow">
                        <div class="parent-icon"><i class="fadeIn animated bx bx-plus-circle"></i></div>
                        <div class="menu-title">SEMENTARA</div>
                    </a>
                    <ul>
                        <li class="jarak-dropdown"><a href="/dashboardjuri">JURI</a></li>
                        <li class="jarak-dropdown"><a href="/dashboardpetugas">PETUGAS</a></li>
                        <li class="jarak-dropdown"><a href="/overviewpeserta">PESERTA</a></li>
                        <li class="jarak-dropdown"><a href="/index2">ADMIN</a></li>
                    </ul>
                </li>
            </ul>
            <!-- end navigation -->
        </div>
        <!-- end sidebar wrapper -->
        <!-- start header -->
        <header>
            <div class="topbar d-flex align-items-center">
                <nav class="navbar navbar-expand">
                    <div class="mobile-toggle-menu"><i class='bx bx-menu'></i></div>
                    <div class="search-bar flex-grow-1"></div>
                    <div class="top-menu ms-auto">
                        <ul class="navbar-nav align-items-center">
                            <div class="user-info ps-3">
                                <p class="user-name mb-0">Habib Shohiburrotib</p>
                                <p class="user-role">habib</p>
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
        <!-- end header -->
        <!-- start page wrapper -->
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
                        <h4 class="mb-0 jarak-top-kurang5">Tabel Partisipan</h4>
                        <hr class="c-mt10"/>
                        <label class="jarak-filterstatus">Filter by Status</label>
                        <select class="form-select2">
                            <option selected>Semua</option>
                            <option>Belum Dibaca</option>
                            <option>Sudah Dibaca</option>
                        </select>
                        <br><br>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead class="table-dark">
                                <tr>
                                    <th>ID</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th class="crud-width100">No WhatsApp</th>
                                    <th class="crud-width-290">Pesan</th>
                                    <th class="border-none">Status</th>
                                    <th class="border-none"></th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="pesans in pesans" :key="pesans.id">
                                    <td>{{ pesans.id }}</td>
                                    <td>{{ pesans.nama }}</td>
                                    <td>{{ pesans.email }}</td>
                                    <td>{{ pesans.nomor }}</td>
                                    <td>{{ pesans.pesan }}</td>
                                    <td class="border-none"><label>{{ pesans.status }}</label></td>
                                    <td class="border-none">
                                        <input type="checkbox" v-model="pesans.checked" @change="updateStatus(post)">
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { defineProps } from "vue";
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    pesans: {
        type: Array,
        default: () => [],
    },
});

const updateStatus = (_pesans) => {
    // Fungsi untuk memperbarui status post
};
</script>
