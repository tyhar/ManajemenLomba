<script setup>

import { Link } from '@inertiajs/vue3';
import { useForm } from "@inertiajs/vue3";
import { Head } from "@inertiajs/vue3";
import { usePage } from "@inertiajs/vue3";
import { router } from "@inertiajs/vue3";
// import { inertia } from "@inertiajs/inertia";

// defineProps({
//     sponsors: {
//         type: Object
//     },
// });

const props = defineProps({
    sponsors: Object,
    logo: String
});

//with resource
// const sponsor = usePage().props.sponsors; //props.sponsors "sponsors" are from controller

const form = useForm({
    // name: sponsor.data.name,
    // logo: sponsor.data.logo,
    // link_file: sponsor.data.link_file,
    name: props.sponsors.name,
    logo: null,
    link_file: props.sponsors.link_file,
});

const submit = () => {
    // form.put(route("sponsor.update", sponsor.data.id), {
    //     preserveScroll: true,
    // });
    // form.put(route("sponsor.update", props.sponsors.id), {
    //     preserveScroll: true,
    // });
    router.post(route("sponsor.update", props.sponsors.id), { 
        // preserveScroll: true,
        _method: "put",
        name: form.name,
        logo: form.logo,
        link_file: form.link_file
    });

};


</script>
<template>
    <div class="wrapper">
        <header>
            <div class="c-topbar">
                <nav class="navbar navbar-expand">
                    <!-- Navbar tambah untuk logo di kiri -->
                    <div class="navbar-tambah">
                        <div class="navbar-left">
                            <img src="/bootstrap/images/logo.png" alt="Logo">
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
                    <form @submit.prevent="submit">
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
                                    <div class="m-2 p-2">
                                        <img :src="logo" class="w-32 h-32" style="width: 500px;" />
                                    </div>
                                    <input 
                                        class="form-control"
                                        type="file"
                                        @input="form.logo = $event.target.files[0]"
                                        id="logo"
                                    >
                                    <p class="keterangan-foto">Max 2 MB (500 x 500 px)</p>
                                </div>
                            </div>
                            <div class="btn-posisi">
                                <!-- <button class="btn btn-primary button-tabel-right" onclick="window.location.href='/sponsor'">Tambah</button>
                                <button class="btn btn-danger button-tabel-left" onclick="window.location.href='/sponsor'">Batal</button> -->
                                <button
                                    type="submit"
                                    class="btn btn-primary button-tabel-right"
                                >
                                    Update
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
    
   