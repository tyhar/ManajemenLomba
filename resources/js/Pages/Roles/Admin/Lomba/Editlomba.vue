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
                                    alt="Logo" style="width: 100px; margin-left: -15px;">
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
                    <form @submit.prevent="submit" enctype="multipart/form-data">
                        <div class="card-body">
                            <h4 class="mb-0">EDIT LOMBA</h4>
                            <hr />
                            <div class="row">
                                <div class="col-md-6 c-mb10">
                                    <label class="c-mb5-black"><b>Nama Lomba</b></label>
                                    <input type="text" class="form-control" v-model="form.name_lomba" id="name">
                                </div>
                                <div class="col-md-6 c-mb10">
                                    <label class="c-mb5-black"><b>Nama PJ</b></label>
                                    <input type="text" class="form-control" v-model="form.pj" id="pj">
                                </div>
                                <div class="col-md-6">
                                    <label class="c-mb5-black"><b>Deskripsi</b></label>
                                    <div class="col-12">
                                        <textarea class="form-control c-mb10" id="deskripsi" rows="4"
                                            v-model="form.description"></textarea>
                                    </div>
                                    <div>
                                        <label for="picture" class="form-label judul-form"><b>Gambar</b></label>
                                        <input type="file" id="picture" accept="image/*" class="form-control"
                                            @input="form.picture = $event.target.files[0]">
                                        <p class="keterangan-foto f-italic">Max file size: 2MB (500 x 500 px)</p>
                                        <p class="keterangan-foto f-italic">Format: .jpg, .png, .jpeg</p>
                                    </div>
                                    <br>
                                    <div>
                                        <label for="sertifikat" class="form-label judul-form"><b>Sertifikat</b></label>
                                        <input type="file" id="sertifikat" class="form-control"
                                            @input="form.sertifikat = $event.target.files[0]">
                                        <p class="keterangan-foto f-italic">Max file size: 2MB (500 x 500 px)</p>
                                        <p class="keterangan-foto f-italic">Format: .pdf</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="c-mb5-black"><b>Kontak PJ</b></label>
                                    <input type="number" class="form-control" v-model="form.kontak" id="kontak">
                                    <div>
                                        <label class="c-mb5-black"><b>Tempat</b></label>
                                        <input type="text" class="form-control" v-model="form.tempat" id="tempat">
                                    </div>
                                    <div class="c-mt10">
                                        <label class="c-mb5-black"><b>Biaya Pendaftaran</b></label>
                                        <input type="text" class="form-control" v-model="form.biaya_pendaftaran"
                                            id="biaya_pendaftaran">
                                    </div>
                                    <div>
                                        <label class="role-add"><b class="warna-hitam">Kriteria Penilaian
                                                (0%/100%)</b></label>
                                        <div>
                                            <div class="form-check" v-for="kriteria in kriterias.data"
                                                :key="kriteria.id">
                                                <input class="form-check-input" type="checkbox"
                                                    :id="'kriteria' + kriteria.id" v-model="form.selectedCriteria"
                                                    :value="kriteria.id">
                                                <label class="form-check-label" :for="'kriteria' + kriteria.id">{{
                                                    kriteria.name_kriteria }} {{ kriteria.nilai_bobot }} %</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="btn-posisi">
                                <button class="btn btn-danger button-left" @click="goBack()">Kembali</button>
                                <button type="submit" class="btn btn-primary button-right">Update</button>
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
import { router, useForm, usePage } from "@inertiajs/vue3";
import Swal from 'sweetalert2'; // Import SweetAlert
import { reactive, computed } from 'vue'

const { name, username, settings, logo1, kriterias } = defineProps(['name', 'username', 'kriterias', 'settings', 'logo1']);

const props = {
    settings: {
        type: Object, // Menggunakan "type" untuk menentukan tipe data props
        default: () => ({}), // Menggunakan "default" jika props tidak diberikan
    },
    logo1: {
        type: String, // Menentukan tipe data logo sebagai String
    },
};

const lomba = usePage().props.lombas;


const form = useForm({
    name_lomba: lomba.data.name_lomba,
    pj: lomba.data.pj,
    description: lomba.data.description,
    kontak: lomba.data.kontak,
    tempat: lomba.data.tempat,
    biaya_pendaftaran: lomba.data.biaya_pendaftaran,
    picture: lomba.data.picture ? `/storage/${lomba.data.picture}` : null,
    sertifikat: lomba.data.sertifikat ? `/storage/${lomba.data.sertifikat}` : null,
    selectedCriteria: [],
});



async function submit() {
    // Validate total bobot
    const totalBobot = form.selectedCriteria.reduce((acc, id) => {
        const kriteria = kriterias.data.find(k => k.id === id);
        return acc + parseInt(kriteria.nilai_bobot);
    }, 0);

    if (totalBobot !== 100) {
        Swal.fire({
            icon: 'error',
            title: 'Gagal',
            text: 'Total bobot kriteria harus 100%',
        });
        return; // Stop execution if total bobot is not 100%
    }

    const formData = {
        _method: 'put',
        name_lomba: form.name_lomba,
        pj: form.pj,
        description: form.description,
        tempat: form.tempat,
        kontak: form.kontak,
        picture: form.picture,
        sertifikat: form.sertifikat,
        biaya_pendaftaran: form.biaya_pendaftaran,
        selectedCriteria: form.selectedCriteria,
    };

    try {
        await router.post(`/lomba/${lomba.data.id}`, formData);
        // Display SweetAlert on success
        Swal.fire({
            icon: 'success',
            title: 'Success',
            text: 'Lomba berhasil diperbarui!',
        });
    } catch (error) {
        console.error('Error:', error);
        // Handle error if needed
    }
}

const goBack = () => {
    window.history.back();
};

</script>
