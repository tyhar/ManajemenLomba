<script setup>
import { Link } from '@inertiajs/vue3';
import { useForm } from "@inertiajs/vue3";
import { Head } from "@inertiajs/vue3";
import { router } from "@inertiajs/vue3";
// import { usePage } from "@inertiajs/vue3";

defineProps({
    // sponsors: {
    //     type: Object,
    //     required: true,
    // },
    sponsors: {
        type: Array,
    },
});

const deleteForm = useForm({});

const deleteSponsor = (id) => {
    if (confirm("Are you sure you want to delete this sponsor?")) {
        deleteForm.delete(route("sponsor.destroy", id), {
            preserveScroll: true,
        });
    }
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
                    <a :href="route('admin')">
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
                        <li class="jarak-dropdown"> <a href="/tim">Tim</a>
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
                <div class="card">
                    <div class="card-body">
                        <h4 class="mb-0 jarak-top-kurang5">Tabel Sponsor</h4>
                        <hr class="c-mt10" />
                        <!-- <button class="btn btn-success jarak-top-kurang7" onclick="window.location.href='sponsor/create'">Tambah Sponsor</button> -->
                        <a class="btn btn-success jarak-top-kurang7" :href="route('sponsor.create')">
                            Tambah Sponsor
                        </a>
                        <hr class="c-mt10" />
                        <div class="table-responsive">
                            <table id="example" class="table table-bordered">
                                <thead class="table-dark">
                                    <tr>
                                        <th class="width-id">ID</th>
                                        <th>Nama Sponsor</th>
                                        <th>Logo</th>
                                        <th>Link</th>
                                        <th class="crud-width-180">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="sponsor in sponsors" :key="sponsor.id">
                                        <!-- <tr
                                        v-for="sponsor in sponsors.data"
                                        :key="sponsor.id"
                                    > -->
                                        <td>
                                            {{ sponsor.id }}
                                        </td>
                                        <td>
                                            {{ sponsor.name }}
                                        </td>
                                        <td>
                                            <!-- {{ sponsor.logo }} -->
                                            <img :src="sponsor.logo" class="w-8 h-8 rounded" style="width: 120px;"
                                                alt="no image" />
                                        </td>
                                        <td>
                                            {{ sponsor.link_file }}
                                        </td>
                                        <td class="btn-crud">
                                            <a class="btn btn-secondary" :href="route('sponsor.show', sponsor.id)">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                            <a class="btn btn-primary" :href="route('sponsor.edit', sponsor.id)">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>
                                            <button class="btn btn-danger" @click="deleteSponsor(sponsor.id)">
                                                <i class="bi bi-trash"></i>
                                            </button>
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
</template>

<script>
$(document).ready(function () {
    $('#example').DataTable();
});
</script>