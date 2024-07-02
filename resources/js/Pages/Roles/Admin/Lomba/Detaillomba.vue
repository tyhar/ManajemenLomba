DetailLOMBA
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
                                <img :src="setting.logo1 ? `/storage/${setting.logo1}` : '/bootstrap/images/logo1default.jpg'"  alt="Logo"
                                    style="width: 135px; margin-left: -15px;">
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
                        <h4 class="mb-0">DETAIL LOMBA</h4>
                        <hr/>
                        <div class="row">
                            <div class="col-md-6 c-mb10">
                                <label class="c-mb5-black"><b>NAMA LOMBA</b></label>
                                <div class="data-tim" id="name">{{ lomba && lomba.name_lomba ? lomba.name_lomba : 'Nama Lomba tidak tersedia' }}</div>
                            </div>
                            <div class="col-md-6">
                                <label class="c-mb5-black"><b>NAMA PJ</b></label>
                                <div class="data-tim" id="pj">{{ lomba && lomba.pj ? lomba.pj : 'Nama PJ tidak tersedia' }}</div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label class="c-mb5-black"><b>DESKRIPSI</b></label>
                                <div class="col-12">
                                    <span v-if="!showFullDescription">{{ truncatedDescription }}...</span>
                                    <span v-if="showFullDescription" class="data-tim">{{ lomba && lomba.description ? lomba.description : 'Deskripsi tidak tersedia' }}</span>
                                    <a @click="toggleDescription" class="btn-link">
                                        {{ showFullDescription ? 'Sembunyikan' : 'Lihat semuanya' }}
                                    </a>
                                </div>
                 
                                <div class="col-md-6">
                                    <label class="c-mb5-black"><b>GAMBAR</b></label>
                                     <div class="col-12" id="picture">
                                        <img :src="pictureUrl" alt="Gambar" width="200" >		
                                    </div>
                                </div>
                                <div class="col-md-6 jarak-sertifikat">
                                    <label class="c-mb5-black"><b>SERTIFIKAT</b></label>
                              <div class="col-12" id="sertifikat">
                                <a :href="`/sertikatlomba/${lomba.id}`">Lihat Sertifikat</a>
                               </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="c-mb5-black"><b>KONTAK PJ</b></label>
                                <div class="data-tim" id="kontak">{{ lomba && lomba.kontak ? lomba.kontak : 'Kontak PJ tidak tersedia' }}</div>
     
                                <label class="c-mb5-black"><b>TEMPAT</b></label>
                                <div class="data-tim" id="tempat">{{ lomba && lomba.tempat ? lomba.tempat : 'Tempat tidak tersedia' }}</div>

                                <div class="margin-top5-crud">
                                    <label class="c-mb5-black"><b>BIAYA PENDAFTARAN</b></label>
                                    <div class="data-tim" id="biaya_pendaftaran">{{ lomba && lomba.biaya_pendaftaran ? lomba.biaya_pendaftaran : 'Biaya Pendaftaran tidak tersedia' }}</div>
                               </div>   
                                <!-- Tambahkan bagian untuk menampilkan kriteria -->
                                <label class="c-mb5-black"><b>KRITERIA PENILAIAN (100/100%)</b></label>
                                <ul>
                                <li v-for="kriteria in lomba.kriteria" :key="kriteria.id">
                                    {{ kriteria.name_kriteria }} {{kriteria.pivot.bobot}}%
                                </li>
                            </ul>
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
import { ref, computed } from 'vue';

import { useForm, usePage } from '@inertiajs/vue3';

// Mendefinisikan properti yang diterima oleh komponen
const props = defineProps({
    name: String,
    username: String,
    lomba: Object,
    settings: Object,
    logo1: Object,
});

const showFullDescription = ref(false);

// Method to toggle full description visibility
const toggleDescription = () => {
    showFullDescription.value = !showFullDescription.value;
};

// Computed property for truncated description (first 30 words)
const truncatedDescription = computed(() => {
    if (props.lomba && props.lomba.description) {
        const words = props.lomba.description.split(' ');
        return words.slice(0, 30).join(' ');
    }
    return '';
});

// Menampilkan properti name dan username yang diterima
console.log(props.name);
console.log(props.username);

// Mendeklarasikan variabel pictureUrl dan sertifikatUrl
const pictureUrl = props.lomba && props.lomba.picture ? `/storage/${props.lomba.picture}` : null;
// const sertifikatUrl = props.lomba && props.lomba.sertifikat ? `/storage/${props.lomba.sertifikat}` : null;

// Menampilkan URL gambar dan sertifikat jika tersedia
console.log(pictureUrl);
// console.log(sertifikatUrl);


const goBack = () => {
    window.history.back();
};

</script>