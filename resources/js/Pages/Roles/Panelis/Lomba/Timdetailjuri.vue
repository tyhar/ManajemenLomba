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
        <div class="page-wrapper-new" >
            <div class="page-content">
                <div class="card" >
                    <div class="card-body">
                        <h4 class="mb-0">DETAIL TIM {{ team.name_team }}</h4>
                        <button class="btn btn-primary crud-width-150 btn-petugas btn-verifikasi posisi-ver" @click="checkStatusAndRedirect">Beri Nilai</button>
                        <hr />
                        <div class="row">
                            <div class="col-md-3 c-mb10" v-if="team">
                                <label class="c-mb5-black"><b>INSTANSI</b></label>
                                <div class="c-mb20">{{ team.instansi }}</div>
                            </div>
                            <div class="col-md-3" v-if="team">
                                <label class="c-mb5-black"><b>KETUA</b></label>
                                <div class="c-mb20">{{ team?.user?.name }}</div>
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
                                        <div class="data-tim"><a :href="`/submissionsurat/${submissions.id}`">Lihat Dokumen</a></div>
                                    </div>
                                    <div class="col-md-3 label-left" v-if="submissions">
                                        <label class="jarak-teks05"><b>FILE</b></label>
                                        <div class="data-tim"><a :href="`/submissionshow/${submissions.id}`">Lihat
                                                File</a>
                                        </div>
                                    </div>
                                    <div class="col-md-2 label-left" v-if="submissions">
                                        <label class="jarak-teks05"><b>LINK</b></label>
                                        <div class="data-tim c-mb-70"><a :href="submissions.link" target="_blank">Buka Link</a></div>
                                    </div>
                                    <div class="label-left">
                                        <label class="jarak-teks05"><b>DESKRIPSI</b></label>
                                        <div class="c-mb20 rata-tengah">{{ submissions.description }}</div>
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

const { userData, members, team, submissions,reg_lombas, lomba, settings, logo1 } = defineProps(['userData', 'members', 'team', 'submissions', 'reg_lombas','lomba','settings', 'logo1']);


const props = {
    settings: {
        type: Object, 
        default: () => ({}), 
    },
    logo1: {
        type: String,
    },
    reg_lombas: {
        type: Object,
    },
};

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

const checkStatusAndRedirect = () => {
    if (reg_lombas.status_kelulusan === 'terverifikasi') {
        const url = route('value.create', { reg_lomba_id: reg_lombas.id, team_id: reg_lombas.team.id, lomba_id: reg_lombas.lomba.id });
        window.location.href = url;
    } else {
        Swal.fire({
            icon: 'error',
            title: 'Tidak dapat menilai',
            text: 'Anda tidak dapat menilai tim yang belum terverifikasi atau telah dinilai sebelumnya',
        });
    }
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
