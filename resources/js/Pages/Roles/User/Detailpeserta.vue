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
        <div class="kotak-putih">
            <div class="page-wrapper-peserta">
                <div class="page-content">
                    <div class="card container-hgnew">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-7 label-left">
                                    <h5 class="judul-detail c-ml-25 c-mt10"><b>{{
                                        lombax.name_lomba }}</b></h5>
                                    <div class="judul-lomba-index c-ml-25 warna-hitam" id="name_lomba">OLINAS
                                    </div>
                                </div>
                                <div>
                                    <div class="div-class">
                                        <a class="btn btn-pink c-mtkc"
                                            href="https://drive.google.com/drive/folders/1IJhmIv8W5TI7-kUyZyUx-bw5Eq2CD7GG?usp=sharing">BUKU
                                            PANDUAN</a>
                                        <!-- <a class="btn btn-success width200 c-mtk mg-t10 warna-hitam"
                                            @click="handleLombaSaya(lombax.id)">DAFTAR LOMBA</a> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="des-biru">
            <a v-html="lombax.description"></a>
            <br><br>
            <h5 class="deskripsil"><b>E. Informasi Tambahan</b></h5>
            <a class="deskripsil deskripsil-detailnew">Penanggung Jawab: {{
                lombax.pj }}
            </a>
            <br>
            <a class="deskripsil deskripsil-detailnew">Biaya Pendaftaran: {{
                lombax.biaya_pendaftaran }}
            </a>
            <br>
            <a class="deskripsil deskripsil-detailnew">Tempat: {{
                lombax.tempat }}
            </a>
            <br><br>
        </div>
        <!--end page wrapper -->
    </div>
</template>
<script setup>
import { defineProps } from "vue";
import { useForm, usePage } from '@inertiajs/vue3';
import Swal from 'sweetalert2';
import { router } from '@inertiajs/vue3';
// Mendefinisikan properti yang diterima oleh komponen
const props = defineProps({
    name: String,
    username: String,
    lombax: Object,
    settings: {
        type: Object, // Menggunakan "type" untuk menentukan tipe data props
        default: () => ({}), // Menggunakan "default" jika props tidak diberikan
    },
    logo1: {
        type: String, // Menentukan tipe data logo sebagai String
    },
});


function handleLombaSaya(lombaId) {
    axios.get(route('daftarlomba.show', lombaId))
        .then(response => {
            // Handle successful response
            router.get(route('daftarlomba.show', lombaId));
        })
        .catch(error => {
            // Handle error response
            router.get('/dashboard');
        });
}


</script>