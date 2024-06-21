<script setup>
import { Link } from '@inertiajs/vue3';
import { useForm } from "@inertiajs/vue3";
import { Head } from "@inertiajs/vue3";
import { router } from "@inertiajs/vue3";
// import { usePage } from "@inertiajs/vue3";

defineProps({
    settings: {
        type: Array,
    },
});
</script>

<template>
    <!--wrapper-->
    <div class="wrapper">
        <!--sidebar wrapper -->
        <div class="sidebar-wrapper" data-simplebar="true">
            <div class="sidebar-header">
                <div v-for="setting in settings" :key="setting.id">
                    <a href="/">
                        <img id="logo-img" :src="setting.logo1" :alt="setting.name" class="lg2">
                    </a>
                </div>
                <div id="menu-toggle" class="toggle-icon ms-auto"><i class="fadeIn animated bx bx-menu"></i></div>
            </div>
            <ul class="metismenu" id="menu">
                <li>
                    <a href="/superadmin">
                        <div class="parent-icon">
                            <i class="bx bx-home-circle"></i>
                        </div>
                        <div class="menu-title">Dashboard</div>
                    </a>
                </li>
                <li>
                    <a href="javascript:;" class="has-arrow">
                        <div class="parent-icon">
                            <i class="fadeIn animated bx bx-plus-circle"></i>
                        </div>
                        <div class="menu-title">Event</div>
                    </a>
                    <ul>
                        <li class="jarak-dropdown"><a href="/lomba">Lomba</a></li>
                        <li class="jarak-dropdown"><a href="/administrator">Administrator</a></li>
                        <li class="jarak-dropdown"><a href="/sponsor">Sponsor</a></li>
                        <li class="jarak-dropdown"><a href="/berita">Berita</a></li>
                        <li class="jarak-dropdown"><a href="/setting">Setting</a></li>
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
                        <div class="parent-icon">
                            <i class="fadeIn animated bx bx-street-view"></i>
                        </div>
                        <div class="menu-title">Partisipan</div>
                    </a>
                </li>
                <li>
                    <a href="/pesan">
                        <div class="parent-icon">
                            <i class="fadeIn animated bx bx-comment-detail"></i>
                        </div>
                        <div class="menu-title">
                            Pesan <span class="alert-count">1</span>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="/rangking">
                        <div class="parent-icon">
                            <i class="fadeIn animated bx bx-trophy"></i>
                        </div>
                        <div class="menu-title">Rangking</div>
                    </a>
                </li>
                <li>
                    <a>
                        <div class="parent-icon">
                            <i class="fadeIn animated bx bx-log-out"></i>
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
                    <div class="mobile-toggle-menu">
                        <i class="bx bx-menu"></i>
                    </div>
                    <div class="search-bar flex-grow-1"></div>
                    <div class="top-menu ms-auto">
                        <ul class="navbar-nav align-items-center">
                            <div class="user-info ps-3">
                                <p class="user-name mb-0">{{ $page.props.userData.name }}</p>
                                <p class="user-role">{{ $page.props.userData.username }}</p>
                            </div>
                            <div class="parent-icon posisi-icon">
                                <i class="bx bx-user-circle c-font48"></i>
                            </div>
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
                <div class="card">
                    <div class="card-body">
                        <h4 class="mb-0 jarak-top-kurang5">TABEL SETTING</h4>
                        <hr class="c-mt10" />
                        <div class="d-flex align-items-center">
                            <a class="btn btn-success jarak-top-kurang7 me-2" :href="route('setting.create')">
                                Tambah Event
                            </a>
                            <a class="btn btn-primary jarak-top-kurang7" href="/setting-project">
                                Setting Nama Email
                            </a>
                        </div>
                        <hr class="c-mt10" />
                        <div class="table-responsive">
                            <table id="example" class="table table-bordered">
                                <thead class="table-dark">
                                    <tr>
                                        <th class="width-id">ID</th>
                                        <th class="crud-width-180">
                                            Nama Event
                                        </th>
                                        <th class="crud-width-180">Judul</th>
                                        <th class="crud-width-180">
                                            Sub Judul
                                        </th>
                                        <th class="crud-width-180">
                                            Tanggal Mulai
                                        </th>
                                        <th class="crud-width-180">
                                            Tanggal Berakhir
                                        </th>
                                        <th class="crud-width-50">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="setting in settings" :key="setting.id">
                                        <td>
                                            {{ setting.id }}
                                        </td>
                                        <td>
                                            {{ setting.name }}
                                        </td>
                                        <td>
                                            {{ setting.judul }}
                                        </td>
                                        <td>
                                            {{ setting.sub_judul }}
                                        </td>
                                        <td>
                                            {{ setting.mulai }}
                                        </td>
                                        <td>
                                            {{ setting.berakhir }}
                                        </td>
                                        <td class="btn-crud">
                                            <a class="btn btn-primary" :href="route('setting.edit', setting.id)">
                                                <i class="bi bi-pencil-square"></i>
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
</template>
