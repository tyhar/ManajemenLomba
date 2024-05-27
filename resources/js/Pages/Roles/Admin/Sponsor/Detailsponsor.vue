<script setup>

import { Link } from '@inertiajs/vue3';
import { useForm } from "@inertiajs/vue3";
import { Head } from "@inertiajs/vue3";
// import { usePage } from "@inertiajs/vue3";
import { router } from "@inertiajs/vue3";
// import { defineProps } from '@vue/runtime-core';

defineProps({
    // sponsors: {
    //     type: Object,
    // },
    // logo: {
    //     type: String
    // }
    sponsors: Array,
    baseUrl: String
});

// const props = defineProps({
//     sponsors: Object,
//     logo: String
// });


</script>

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
                                <img src="/bootstrap/images/logo.png" alt="Logo">
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
                        <h4 class="mb-0">DETAIL SPONSOR</h4>
                        <hr />
                        <div>
                            <div class="col-md-6 c-mb10">
                                <label class="c-mb5-black"><b>NAMA SPONSOR</b></label>
                                <div class="c-mb20">{{ sponsors.name }}</div>
                            </div>
                            <div>
                                <label class="col-md-6 c-mb10 warna-hitam"><b>LINK</b></label>
                                <div class="c-mb20"><a href="#">{{ sponsors.link_file }}</a></div>
                            </div>
                            <div class="c-mb10">
                                <label class="c-mb5-black"><b>LOGO</b></label><br>
                                <div>
                                    <img :src="'/storage/' + sponsors.logo" alt="Product Image"
                                        class="img-fluid c-maxw400" />
                                </div>
                            </div>
                        </div>
                        <div class="btn-posisi">
                            <a class="btn btn-danger btn-kembali" :href="route('sponsor.index')">Kembali</a>
                            <a class="btn btn-danger btn-kembali" :href="route('sponsor.edit', sponsors.id)">Edit</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--end page wrapper -->
    </div>
</template>