<script setup>

import { Link } from '@inertiajs/vue3';
import { useForm } from "@inertiajs/vue3";
import { Head } from "@inertiajs/vue3";
// import { usePage } from "@inertiajs/vue3";
import { router } from "@inertiajs/vue3";
// import { defineProps } from '@vue/runtime-core';


const { name, username, sponsors, settings, logo1 } = defineProps(['name', 'username', 'sponsors', 'settings', 'logo1']);


// Definisikan properti yang diterima oleh komponen
const props = {
    sponsors: {
        type: Array,
        baseUrl: String,
    },
    settings: {
        type: Object, // Menggunakan "type" untuk menentukan tipe data props
        default: () => ({}), // Menggunakan "default" jika props tidak diberikan
    },
    logo1: {
        type: String, // Menentukan tipe data logo sebagai String
    },

};



// const props = defineProps({
//     sponsors: Object,
//     logo: String
// });
const goBack = () => {
    window.history.back();
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
        <div class="page-wrapper-new">
            <div class="page-content">
                <div class="card">
                    <div class="card-body">
                        <h4 class="mb-0">DETAIL SPONSOR</h4>
                        <hr />
                        <div>
                            <div class="col-md-6 c-mb10">
                                <label class="c-mb5-black"><b>NAMA SPONSOR</b></label>
                                <div class="c-mb20">{{ sponsors.name }}</div>
                            </div>
                            <div>
                                <label class="col-md-6 c-mb10 warna-hitam"><b>LINK</b></label>
                                <div class="c-mb20" :href="sponsors.link_file" target="_blank"><a >{{ sponsors.link_file  }}</a></div>
                            </div>
                            <div class="c-mb10">
                                <label class="c-mb5-black"><b>LOGO</b></label><br>
                                <div>
                                    <img :src="'/storage/' + sponsors.logo" alt="Product Image" class="c-maxw400" />
                                </div>
                            </div>
                        </div>
                        <div class="btn-posisi">
                            <button class="btn btn-danger btn-kembali" @click="goBack()">Kembali</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--end page wrapper -->
    </div>
</template>