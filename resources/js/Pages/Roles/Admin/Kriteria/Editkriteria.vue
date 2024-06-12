<script setup>
import { Link } from '@inertiajs/vue3';
import { router } from "@inertiajs/vue3";
// import { usePage } from "@inertiajs/vue3";

defineProps({
    settings: {
        type: Array,
    }
});
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
                                <img :src="setting.logo1" :alt="setting.name"
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
                                <p class="user-name mb-0">Habib Shohiburrotib</p>
                                <p class="user-role">habib</p>
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
                        <h4 class="mb-0">EDIT KRITERIA PENILAIAN</h4>
                        <hr />
                        <div class="row">
                            <div class="col-md-6 c-mb10">
                                <label class="c-mb5-black"><b>Kriteria Penilaian</b></label>
                                <input type="namalomba" class="form-control">
                            </div>
                            <div class="col-md-6 c-mb10">
                                <label class="c-mb5-black"><b>Bobot (%)</b></label>
                                <input type="namalomba" class="form-control">
                            </div>
                        </div>
                        <div class="btn-posisi">
                            <button class="btn btn-primary button-tabel-right"
                                onclick="window.location.href='/kriteria'">Simpan</button>
                            <button class="btn btn-danger button-tabel-left"
                                onclick="window.location.href='/kriteria'">Batal</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--end page wrapper -->
    </div>
</template>
