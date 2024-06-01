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
                                <img src="/bootstrap/images/lg.png" alt="Logo" class="lg3">
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
                                <p class="user-name mb-0">{{ userData.name }}</p>
                                <p class="user-role">{{ userData.username }}</p>
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
                        <h4 class="mb-0">DETAIL TIM {{ team.name_team }}</h4>
                        <button class="btn btn-primary crud-width-150 btn-petugas btn-verifikasi posisi-ver">Beri
                            Nilai</button>
                        <hr />
                        <div class="row">
                            <div class="col-md-3 c-mb10" v-if="team">
                                <label class="c-mb5-black"><b>INSTANSI</b></label>
                                <div class="c-mb20">{{ team.instansi }}</div>
                            </div>
                            <div class="col-md-3" v-if="team">
                                <label class="c-mb5-black"><b>KETUA</b></label>
                                <div class="c-mb20">ASEP => static</div>
                            </div>
                            <div class="col-md-3" v-if="team">
                                <label class="c-mb5-black"><b>EMAIL</b></label>
                                <div class="c-mb20">{{ team.email }}</div>
                            </div>
                            <div class="col-md-3" v-if="team">
                                <label class="c-mb5-black"><b>NO WHATSAPP</b></label>
                                <div class="c-mb20">{{ team.phone }}</div>
                            </div>
                        </div>
                        <br><br><br>

                        <div class="card card-height400">
                            <div class="card-body p-4 text-center">
                                <h6 class="sub-judul-tim"><b>KARYA TIM</b></h6>
                                <hr />
                                <div class="row">
                                    <div class="col-md-4 label-left" v-if="submissions">
                                        <label class="jarak-teks05"><b>JUDUL</b></label>
                                        <div class="c-mb20">{{ submissions.title }}</div>
                                    </div>
                                    <div class="col-md-3 label-left" v-if="submissions">
                                        <label class="jarak-teks05"><b>DOKUMEN</b></label>
                                        <div class="c-mb20"><a href="#">Lihat Dokumen</a></div>
                                    </div>
                                    <div class="col-md-3 label-left" v-if="submissions">
                                        <label class="jarak-teks05"><b>FILE</b></label>
                                        <div class="c-mb20"><a href="#">Lihat File</a></div>
                                    </div>
                                    <div class="col-md-2 label-left" v-if="submissions">
                                        <label class="jarak-teks05"><b>LINK</b></label>
                                        <div class="c-mb20"><a href="#">Buka Link</a></div>
                                    </div>
                                    <div class="label-left">
                                        <label class="jarak-teks05"><b>DESKRIPSI</b></label>
                                        <div class="c-mb20 rata-tengah">OLIVIA merupakan singkatan
                                            dari Olimpiade Vokasi Indonesia,
                                            sebuah ajang kompetisi tingkat nasional bagi mahasiswa vokasi dari perguruan
                                            tinggi negeri maupun swasta di seluruh Indonesia. OLIVIA ini diselenggarakan
                                            oleh Forum Pendidikan Tinggi Vokasi Indonesia (FPTVI) sebagai wadah forum
                                            pendidikan tinggi khusus bidang ilmu terapan atau vokasi yang memiliki
                                            agenda rutin tahunan berupa kompetisi ilmiah mahasiswa antar perguruan
                                            tinggi vokasi se-Indonesia. Kegiatan ini memiliki tujuan untuk meningkatkan
                                            daya saing insan vokasi, terutama mahasiswa. Dengan berlandaskan pada
                                            prinsip-prinsip kompetisi, seperti sportivitas, profesionalitas, dan
                                            transparansi. Melalui OLIVIA ini, mahasiswa vokasi dari seluruh Indonesia
                                            menyajikan karya hasil kreativitas dan inovasi mereka.</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { defineProps, ref, reactive } from 'vue';
import Swal from 'sweetalert2';
import { router } from '@inertiajs/vue3';

const { userData, members, team, submissions } = defineProps(['userData', 'members', 'team', 'submissions']);

const form = reactive({
    description: ''
});

const isPopupVisible = ref(false);

const showPopup = () => {
    isPopupVisible.value = true;
};

const hidePopup = () => {
    isPopupVisible.value = false;
};

</script>
<style scoped>
/* DAFTAR LOMBA EDIT */
.crud-max-width260 {
    /* flex: 1 1 calc(25% - 1rem); */
    display: flex;
    flex-direction: column;
}

.card {
    display: flex;
    flex-direction: column;
    flex-grow: 1;
}

.lg3 {
    width: 100px;
    margin-left: -15px;
}
</style>