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
                                <img src="/bootstrap/images/lg.png" alt="Logo"
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
        <div class="kotak-putih">
            <div class="page-wrapper-peserta">
                <div class="page-content">
                    <div class="card container-hgnew">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-7 label-left">
                                    <h5 class="judul-detail c-ml-25 c-mt10"><b>Tema Lomba</b></h5>
                                    <div class="judul-lomba-index c-ml-25 warna-hitam" id="name_lomba">{{
                                        lombax.name_lomba }}
                                    </div>
                                </div>
                                <div>
                                    <div class="div-class">
                                        <a class="btn btn-pink c-mtkc" href="#">BUKU
                                            PANDUAN</a>
                                        <a class="btn btn-success c-mtk mg-t10 warna-hitam"
                                            :href="route('daftarlomba.index')">DAFTAR
                                            LOMBA</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class=" des-biru">
            <a class="kont">{{ lombax.description }}</a>
        </div>
        <!--end page wrapper -->
    </div>
</template>
<script setup>
import { defineProps } from "vue";
import { useForm, usePage } from '@inertiajs/vue3';

// Mendefinisikan properti yang diterima oleh komponen
const props = defineProps({
    name: String,
    username: String,
    lombax: Object,
});

</script>