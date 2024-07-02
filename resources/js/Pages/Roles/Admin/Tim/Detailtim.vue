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
        <div class="page-wrapper-new">
            <div class="page-content">
                <div class="card">
                    <div class="card-body">
                        <h4 class="mb-0">DETAIL TIM {{ team.name_team }}</h4>
                        <hr />
                        <div class="row">
                            <div class="col-md-3 c-mb10">
                                <label class="c-mb5-black"><b>INSTANSI</b></label>
                                <div class="c-mb20">{{ team.instansi }}</div>
                            </div>
                            <div class="col-md-2">
                                <label class="c-mb5-black"><b>LOMBA</b></label>
                                <div class="c-mb20">{{ team?.lomba?.name_lomba }}</div>
                            </div>
                            <div class="col-md-3">
                                <label class="c-mb5-black"><b>EMAIL</b></label>
                                <div class="c-mb20">{{ team.email }}</div>
                            </div>
                            <div class="col-md-2">
                                <label class="c-mb5-black"><b>NO WHATSAPP</b></label>
                                <div class="c-mb20">{{ team.phone }}</div>
                            </div>
                            <div class="col-md-2">
                                <label class="c-mb5-black"><b>PEMBAYARAN</b></label>
                                <div class="c-mb20"><a href="#">Lihat Bukti</a></div>
                            </div>
                        </div>
                        <br><br><br>
                        <div class="row row-cards justify-content-center">
                            <div class="col-md-6 col-lg-3 crud-max-width260" v-for="member in members" :key="member.id">
                                <div class="card">
                                    <div class="card-header btn-crud">
                                        <h6><b>{{ member.role }}</b></h6>
                                    </div>
                                    <div class="card-body p-4 text-center posisi-mb23">
                                        <div class="btn-crud">
                                            <img :src="member.photo ? `/storage/${member.photo}` : '/bootstrap/images/default2.png'"
                                                height="120" alt="..." class="img-fluidc rounded">
                                        </div>
                                        <br>
                                        <h6><b>{{ member.name }}</b></h6>
                                        <br>
                                        <div class="posisi-mb7">{{ member.nik }}</div>
                                        <div class="text-muted">{{ member.instansi }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
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
                                        <label class="jarak-teks05"><b>SURAT</b></label>
                                        <div class="data-tim"><a
                                                :href="`/submissionsurat/${submissions.id}`">Dokumen.pdf
                                            </a></div>
                                    </div>
                                    <div class="col-md-3 label-left" v-if="submissions">
                                        <label class="jarak-teks05"><b>FILE</b></label>
                                        <div class="data-tim"><a :href="getDownloadLink()" download>Lihat
                                                File</a>
                                        </div>
                                    </div>
                                    <div class="col-md-2 label-left" v-if="submissions">
                                        <label class="jarak-teks05"><b>LINK KARYA</b></label>
                                        <div class="data-tim c-mb-70"><a :href="submissions.link" target="_blank">Buka
                                                Link</a></div>
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

const { userData, members, team, submissions, reg_lombas, lomba, settings } = defineProps(['userData', 'members', 'team', 'submissions', 'reg_lombas', 'lomba', 'settings']);

const form = reactive({
    description: ''
});

const props = {
    settings: {
        type: Object, // Menggunakan "type" untuk menentukan tipe data props
        default: () => ({}), // Menggunakan "default" jika props tidak diberikan
    },
};

const isPopupVisible = ref(false);

const showPopup = () => {
    isPopupVisible.value = true;
};

const hidePopup = () => {
    isPopupVisible.value = false;
};

const getRegLombaTeamUrl = (regLombaId, teamId, lombaId) => {
    return route('value.create', { reg_lomba_id: regLombaId, team_id: teamId, lomba_id: lombaId });
};

const getDownloadLink = () => {
    if (submissions && submissions.file) {
        return `/storage/${submissions.file}`;
    } else {
        return '#'; // or an appropriate default value
    }
};
</script>

<style scoped>
/* DAFTAR LOMBA EDIT */
.crud-max-width260 {
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
