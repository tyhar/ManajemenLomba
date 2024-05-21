<script setup>
import { Link } from '@inertiajs/vue3';
import { useForm } from "@inertiajs/vue3";
import { Head } from "@inertiajs/vue3";
import Swal from 'sweetalert2/dist/sweetalert2.min.js';

const form = useForm({
    name: "",
    logo: null,
    link_file: "",
});

const store = () => {
    form.post(route("sponsor.store"), {
        onSuccess: () => form.reset(),
        preserveScroll: true,
    });
};

// const submit = () => {
//     form.post('/superadmin/sponsor'), {
//         preserveScroll: true,
//     };
// };


</script>
<template>
    <div class="wrapper">
        <!--start header -->
        <header>
            <div class="c-topbar">
                <nav class="navbar navbar-expand">
                    <!-- Navbar tambah untuk logo di kiri -->
                    <div class="navbar-tambah">
                        <a href="/">
                            <div class="navbar-left">
                                <img src="/bootstrap/images/logo.png" alt="Logo">
                            </div>
                        </a>
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
                    <form @submit.prevent="store">
                        <div class="card-body">
                            <h4 class="mb-0">Tambah Sponsor</h4>
                            <hr/>
                            <div>
                                <div class="c-mb10">
                                    <label
                                        for="name" 
                                        class="c-mb5-black"
                                    >
                                        <b>Nama Sponsor</b>
                                    </label>
                                    <input 
                                        type="text" 
                                        class="form-control"
                                        v-model="form.name"
                                        id="name"
                                    >
                                </div>
                                <div>
                                    <label
                                        for="link_file" 
                                        class="c-mb5-black"
                                    >
                                        <b>Link</b>
                                    </label>
                                    <div class="col-12">
                                        <input
                                            type="text"
                                            v-model="form.link_file"
                                            id="link_file"  
                                            class="form-control c-mb10" rows="2"
                                        >
                                    </div>
                                </div>
                                <div>
                                    <label 
                                        for="logo" 
                                        class="form-label warna-hitam"
                                    >
                                        <b>Logo</b>
                                    </label>
                                    <input 
                                        class="form-control"
                                        type="file"
                                        @input="form.logo = $event.target.files[0]"
                                        id="logo"
                                    >
                                    <!-- <input 
                                        class="form-control"
                                        type="text"
                                        v-model="form.logo"
                                        id="logo"
                                    > -->
                                    <p class="keterangan-foto">Max 2 MB (200 x 200 px)</p>
                                </div>
                            </div>
                            <div class="btn-posisi">
                                <!-- <button class="btn btn-primary button-tabel-right" onclick="window.location.href='/sponsor'">Tambah</button>
                                <button class="btn btn-danger button-tabel-left" onclick="window.location.href='/sponsor'">Batal</button> -->
                                <button
                                    type="submit"
                                    class="btn btn-primary button-tabel-right"
                                >
                                    Tambah
                                </button>
                                <a 
                                    class="btn btn-danger button-tabel-left"
                                    :href="route('sponsor.index')"
                                >
                                    Batal
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!--end page wrapper -->
    </div>
</template>
    
   