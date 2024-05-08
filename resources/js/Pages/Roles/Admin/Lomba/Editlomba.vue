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
                    <form @submit.prevent="submit" enctype="multipart/form-data">
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
                                        <label for="picture" class="form-label judul-form"><b>Gambar</b></label>
                                        <input type="file" id="picture" accept="image/*" class="form-control" @input="form.picture = $event.target.files[0]">
                                        <p class="keterangan-foto">Ukuran 500 x 500</p>
                                    </div> 
                                    <!-- <div>
                                        <label for="picture" class="form-label judul-form"><b>Gambar</b></label>
                                        <input type="file" id="picture" accept="image/*" class="form-control" ref="pictureInput">
                                        <p class="keterangan-foto">Ukuran 500 x 500</p>
                                    </div>  -->
                                     <div>
                                        <label for="sertifikat" class="form-label judul-form"><b>Sertifikat</b></label>
                                        <input type="file" id="sertifikat" accept="image/*" class="form-control"  @input="form.sertifikat = $event.target.files[0]">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="c-mb5-black"><b>Kontak PJ</b></label>
                                    <input  
                                            type="number"
                                            class="form-control"
                                            v-model="form.kontak"
                                            id="kontak"
                                            >
                                            

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
                                <button
                                    type="submit"
                                    class="btn btn-primary button-tabel-right"
                                >
                                    Update
                                </button>
                                    <button class="btn btn-danger btn-kembali" @click="goBack()">Kembali</button>
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
import { router, useForm,usePage } from "@inertiajs/vue3";

// const props = defineProps({
//     lombas : Object,
//         picture: String,
//         sertifikat: String
// })




const lomba = usePage().props.lombas; //props.sponsors "sponsors" are from controller

const form = useForm({
   name: lomba.data.name,
   pj: lomba.data.pj,
   description: lomba.data.description,
   kontak: lomba.data.kontak,
   tempat: lomba.data.tempat,
   biaya_pendaftaran: lomba.data.biaya_pendaftaran,
   picture: lomba.data.picture ? `/storage/${lomba.data.picture}` : null,
   sertifikat: lomba.data.sertifikat ? `/storage/${lomba.data.sertifikat}` : null,

});


 function submit() {
    router.post(`/superadmin/lomba/${lomba.data.id }`, {
        _method: 'put',
        name: form.name,
        pj: form.pj,
        description: form.description,
        tempat: form.tempat,
        kontak: form.kontak,
        picture: form.picture,
        sertifikat: form.sertifikat,
        biaya_pendaftaran: form.biaya_pendaftaran,

    })
 }
// const submit = () => {
    // let formData = new FormData();
    // formData.append('name', form.name);
    // formData.append('pj', form.pj);
    // formData.append('description', form.description);
    // formData.append('kontak', form.kontak);
    // formData.append('tempat', form.tempat);
    // formData.append('biaya_pendaftaran', form.biaya_pendaftaran);
    
    // if (pictureInput.value.files[0]) {
    //     formData.append('picture', pictureInput.value.files[0]);
    // }
    // if (sertifikatInput.value.files[0]) {
    //     formData.append('sertifikat', sertifikatInput.value.files[0]);
    // }

    // form.put(route("lomba.update", lomba.data.id), formData, {
    //     preserveScroll: true,

    // })
// }
// Fungsi untuk kembali ke halaman sebelumnya
const goBack = () => {
    window.history.back();
};
</script>
