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
                                <p class="user-role">Admin</p>					
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
                        <h4 class="mb-0">Detail Lomba</h4>
                        <hr/>
                        <div class="row">
                            <div class="col-md-6 c-mb10">
                                <label class="c-mb5-black"><b>Nama Lomba</b></label>
                                <div class="data-tim" id="name">{{ lomba && lomba.name ? lomba.name : 'Nama Lomba tidak tersedia' }}</div>
                            </div>
                            <div class="col-md-6">
                                <label class="c-mb5-black"><b>Nama PJ</b></label>
                                <div class="data-tim" id="pj">{{ lomba && lomba.pj ? lomba.pj : 'Nama PJ tidak tersedia' }}</div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label class="c-mb5-black"><b>Deskripsi</b></label>
                                <div class="col-12">
                                    <div class="data-tim" id="description">{{ lomba && lomba.description ? lomba.description : 'Deskripsi tidak tersedia' }}</div>
                                </div>
                                <div class="col-md-6">
                                    <label class="c-mb5-black"><b>Gambar</b></label>
                                     <div class="col-12" id="picture">
                                        <img :src="pictureUrl" alt="Gambar" width="200" >		
                                    </div>
                                </div>
                                <div class="col-md-6 jarak-sertifikat">
                                    <label class="c-mb5-black"><b>Sertifikat</b></label>
                              <div class="col-12" id="sertifikat">
                                <img :src="sertifikatUrl" alt="Sertifikat" width="200" >	
                               </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="c-mb5-black"><b>Kontak PJ</b></label>
                                <div class="data-tim" id="kontak">{{ lomba && lomba.kontak ? lomba.kontak : 'Kontak PJ tidak tersedia' }}</div>
     
                                <label class="c-mb5-black"><b>Tempat</b></label>
                                <div class="data-tim" id="tempat">{{ lomba && lomba.tempat ? lomba.tempat : 'Tempat tidak tersedia' }}</div>

                                <div class="margin-top5-crud">
                                    <label class="c-mb5-black"><b>Biaya Pendaftaran</b></label>
                                    <div class="data-tim" id="biaya_pendaftaran">{{ lomba && lomba.biaya_pendaftaran ? lomba.biaya_pendaftaran : 'Biaya Pendaftaran tidak tersedia' }}</div>
                               </div>                              
                            </div>           
                        </div>
                        <div class="col-md-6 c-mb10">
                                <label class="c-mb5-black"><b>Nama Kriteria</b></label>
                                <!-- Menampilkan nama kriteria yang dipilih -->
                                <div class="data-tim" v-if="kriteria && kriteria.selectedCriteria && kriteria.selectedCriteria.length > 0">
                                    <ul>
                                        <li v-for="selectedId in kriteria.selectedCriteria" :key="selectedId">
                                            {{ getKriteriaName(selectedId) }}
                                        </li>
                                    </ul>
                                </div>
                                <div class="data-tim" v-else>
                                    Tidak ada kriteria yang dipilih.
                                </div>
                            </div>
                        </div>
                        <div class="btn-posisi">
                            <button class="btn btn-danger btn-kembali" @click="goBack()">Kembali</button>
                        </div>
                    </div>
                </div>
            
        </div>
        <!--end page wrapper -->
    </div>
</template>


<script setup>
import { defineProps } from "vue";
import { useForm, usePage } from '@inertiajs/vue3';

// Definisikan properti yang diterima oleh komponen
const props = defineProps({
    lomba: {
        type: Object,
        required: true
    },
    kriteria: {
        type: Array,
        required: true
    }
});

const picture = props.lomba.picture;
const sertifikat = props.lomba.sertifikat;

// const form = useForm({
//     selectedCriteria: props.kriteria.selectedCriteria,
// })
// Buat URL untuk gambar dan sertifikat
const pictureUrl = picture ? `/storage/${picture}` : null;
 const sertifikatUrl = sertifikat ? `/storage/${sertifikat}` : null;

 const getKriteriaName = (kriteriaId) => {
    const kriteria = props.kriteriaz.find(kriteria => kriteria.id === kriteriaId);
    return kriteria ? kriteria.name_kriteria : 'Kriteria tidak ditemukan';
};

const goBack = () => {
    window.history.back();
};

</script>
