<template>
    <div class="wrapper">
        <!--start header -->
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
                        <h4 class="mb-0">Edit Lomba</h4>
                        <hr/>
                        <div class="row">
                            <div class="col-md-6 c-mb10">
                                <label class="c-mb5-black"><b>Nama Lomba</b></label>
                                <input  type="text" 
                                        class="form-control"
                                        v-model="form.name"
                                        id="name">
                            </div>
                            <div class="col-md-6 c-mb10">
                                <label class="c-mb5-black"><b>Nama PJ</b></label>
                                <input  type="text" 
                                        class="form-control"
                                        v-model="form.pj"
                                        id="pj">
                            </div>
                            
                            <div class="col-md-6">
                                <label class="c-mb5-black"><b>Deskripsi</b></label>
                                <div class="col-12">
                                    <textarea  type="text" 
                                        class="form-control"
                                        v-model="form.description"
                                        id="description"></textarea>  
                                </div>
                                <div>
                                    <label for="formFile" class="form-label judul-form"><b>Gambar</b></label>
                                    <input  @change="handlePictureChange"
                                     type="file"
                                     accept="image/*"
                                     id="picture"
                                     class="form-control">
                                    <p class="keterangan-foto">Ukuran 500 x 500</p>
                                </div>
                                <div>
                                    <label for="formFile" class="form-label judul-form"><b>Sertifikat</b></label>
                                    <input  @change="handleSertifikatChange"
                                     type="file"
                                     accept="image/*"
                                     id="sertifikat"
                                     class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="c-mb5-black"><b>Kontak PJ</b></label>
                                <input  type="number" 
                                        class="form-control"
                                        v-model="form.kontak"
                                        id="kontak">
     
                                <div>
                                    <label class="c-mb5-black"><b>Tempat</b></label>
                                    <input  type="text" 
                                        class="form-control"
                                        v-model="form.tempat"
                                        id="tempat">
                                </div>
                                <div class="c-mt10">
                                    <label class="c-mb5-black"><b>Biaya Pendaftaran</b></label>
                                    <input  type="text" 
                                        class="form-control"
                                        v-model="form.biaya_pendaftaran"
                                        id="biaya_pendaftaran">
                                </div>
                            </div>
                        </div>
                        <div class="btn-posisi">
                            <button class="btn btn-primary button-tabel-right" onclick="window.location.href='/lomba'">Simpan</button>
                            <button class="btn btn-danger button-tabel-left" onclick="window.location.href='/lomba'">Batal</button>
                        </div>
                    </div>
                </form>
                </div>
            </div>
        </div>
        <!--end page wrapper -->
    </div>
</template>
    
<script setup>
import { Link } from '@inertiajs/vue3';
import { useForm } from "@inertiajs/vue3";
import { Head } from "@inertiajs/vue3";
import { usePage } from "@inertiajs/vue3";
import { router } from "@inertiajs/vue3";

// defineProps({
//     sponsors: {
//         type: Object,
//         required: true,
//     },
// });

const lomba = usePage().props.lombas; //props.sponsors "sponsors" are from controller

const form = useForm({
    name: lomba.data.name,
    pj: lomba.data.pj,
    kontak: lomba.data.kontak,
    description: lomba.data.description,
    tempat: lomba.data.tempat,
    picture: lomba.data.picture,
    sertifikat: lomba.data.sertifikat,
    biaya_pendaftaran: lomba.data.biaya_pendaftaran,


});

const handlePictureChange = (event) => {
    const file = event.target.files[0];
    form.picture = file;
};

const handleSertifikatChange = (event) => {
    const file = event.target.files[0];
    form.sertifikat = file;
};


const submit = () => {
    form.put(route("lomba.update",lomba.data.id), {
        preserveScroll: true,
    });
};

</script>