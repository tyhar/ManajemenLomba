<template>
    <div class="wrapper">
        <header>
            <div class="c-topbar">
                <nav class="navbar navbar-expand">
                    <div class="navbar-tambah">
                        <div class="navbar-left" v-for="setting in settings" :key="setting.id">
                            <a href="/">
                                <img :src="setting.logo1 ? `/storage/${setting.logo1}` : '/bootstrap/images/logo1default.jpg'" alt="Logo" style="width: 135px; margin-left: -15px;">
                            </a>
                        </div>
                    </div>
                    <div class="search-bar flex-grow-1"></div>
                    <div class="top-menu ms-auto">
                        <ul class="navbar-nav align-items-center">
                            <div class="user-info ps-3">
                                <p class="user-name mb-0">{{ userData.name }}</p>
                                <p class="user-role">{{ userData.username }}</p>
                            </div>
                            <div class="parent-icon posisi-icon">
                                <i class="bx bx-user-circle c-font48"></i>
                            </div>
                        </ul>
                    </div>
                </nav>
            </div>
        </header>

        <div class="page-wrapper-new">
            <div class="page-content">
                <div class="card">
                    <div class="card-body" v-if="team">
                        <h4 class="mb-0">DETAIL TIM {{ team.name_team }}</h4>
                        <button v-if="team.status !== 'verified' && userStatus.status_kelulusan !== 'tidak_lolos'" class="btn btn-danger crud-width-150 btn-petugas btn-gagal" @click="showPopup">Gagal</button>
                        <div v-if="isPopupVisible" class="popup">
                            <div class="popup-content">
                                <span class="close" @click="hidePopup">&times;</span>
                                <h5>Input Notifikasi</h5>
                                <hr />
                                <div>
                                    <label class="c-mb5-black c-ml20"><b>Deskripsi</b></label>
                                    <div class="col-11">
                                        <textarea v-model="form.description" class="form-control c-mb10 c-ml20" id="inputProductDescription" rows="3" placeholder="Tulis Notifikasi"></textarea>
                                    </div>
                                    <button class="btn btn-primary crud-width100 btn-mid c-mt40" @click="sendNotification">Kirim</button>
                                </div>
                            </div>
                        </div>

                        <button v-if="team.status !== 'verified' && userStatus.status_kelulusan !== 'tidak_lolos'" class="btn btn-primary crud-width-150 btn-petugas btn-verifikasi posisi-ver" @click="verifyTeam">Verifikasi</button>
                        <button v-if="team.status === 'verified'" class="btn btn-success crud-width-150 btn-petugas btn-verifikasi posisi-ver">Tervifikasi</button>
                        <hr />
                        <div class="row">
                            <div class="col-md-3 c-mb10" v-if="team">
                                <label class="c-mb5-black"><b>INSTANSI</b></label>
                                <div class="c-mb20">{{ team.instansi }}</div>
                            </div>
                            <div class="col-md-2" v-if="team">
                                <label class="c-mb5-black"><b>LOMBA</b></label>
                                <ul>
                                    <li>{{ team?.lomba?.name_lomba }}</li>
                                </ul>
                            </div>
                            <div class="col-md-3" v-if="team">
                                <label class="c-mb5-black"><b>EMAIL</b></label>
                                <div class="c-mb20">{{ team.email }}</div>
                            </div>
                            <div class="col-md-2" v-if="team">
                                <label class="c-mb5-black"><b>NO WHATSAPP</b></label>
                                <div class="c-mb20">{{ team.phone }}</div>
                            </div>
                            <div class="col-md-2" v-if="team">
                                <label class="c-mb5-black"><b>PEMBAYARAN</b></label>
                                <div class="c-mb20"><a :href="`/datatimshow/${team.id}`">Lihat Bukti</a></div>
                            </div>
                            <div class="col-md-3" v-if="team">
                                <label class="c-mb5-black"><b>STATUS</b></label>
                                <div class="c-mb20">{{ team.status }}</div>
                            </div>
                        </div>
                        <br><br><br>
                        <div class="row row-cards justify-content-center">
                            <div class="col-md-4 col-lg-3 crud-max-width260" v-for="member in members" :key="member.id">
                                <div class="card">
                                    <div class="card-header btn-crud">
                                        <h6><b>{{ member.role }}</b></h6>
                                    </div>
                                    <div class="card-body p-4 text-center posisi-mb23">
                                        <div class="btn-crud">
                                            <img :src="member.user.photo ? `/storage/${member.user.photo}` : '/bootstrap/images/default2.png'" height="120" alt="..." class="img-fluidc rounded">
                                        </div>
                                        <br>
                                        <h6><b>{{ member.user.name }}</b></h6>
                                        <br>
                                        <div class="posisi-mb7">{{ member.user.nik }}</div>
                                        <div class="text-muted">{{ member.user.instansi }}</div>
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
                                    <div class="col-md-3 label-left">
                                        <label class="jarak-teks05"><b>SURAT</b></label>
                                        <div class="data-tim"><a :href="`/submissionsurat/${submissions.id}`">Dokumen.pdf</a></div>
                                    </div>
                                    <div class="col-md-3 label-left" v-if="submissions">
                                        <label class="jarak-teks05"><b>FILE</b></label>
                                        <div class="data-tim"><a :href="`/submissionshow/${submissions.id}`">Lihat File</a></div>
                                    </div>
                                    <div class="col-md-2 label-left" v-if="submissions">
                                        <label class="jarak-teks05"><b>LINK KARYA</b></label>
                                        <div class="data-tim c-mb-70"><a :href="submissions.link" target="_blank">Buka Link</a></div>
                                    </div>
                                    <div class="label-left" v-if="submissions">
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
import { defineProps, ref, reactive, watch } from 'vue';
import Swal from 'sweetalert2';
import { router } from '@inertiajs/vue3';
import axios from 'axios';

const { userData, members, team, submissions, settings,userStatus } = defineProps(['userData', 'members', 'team', 'submissions', 'settings','userStatus']);

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

const sendNotification = async () => {
    try {
        await axios.post('/notifications', {
            team_id: team.id,
            user_id: team.user_id,
            description: form.description
        });
        await axios.patch('/api/update-status/kelulusan2', {
            team_id: team.id,
            status: 'tidak_lolos'
        });
        Swal.fire({
            title: 'Berhasil!',
            text: 'Pesan berhasil dikirim',
            icon: 'success',
            confirmButtonText: 'OK',
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = route('timpetugas.show', team.id);
            }
        });

        // Hide the popup after successful notification
        hidePopup();

        // Disable the "Gagal" button and hide the "Verifikasi" button if 'tidak_lolos'
        if (userStatus.status_kelulusan === 'tidak_lolos') {
            disableGagalButton();
            hideVerifikasiButton();
        }
    } catch (error) {
        console.error('Error submitting form:', error);
        Swal.fire({
            title: 'Gagal!',
            text: 'Gagal menyimpan data.',
            icon: 'error',
            confirmButtonText: 'OK'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = route('timpetugas.show', team.id);
            }
        });
    }
};

const verifyTeam = async () => {
    Swal.fire({
        title: 'Apakah Anda yakin?',
        text: 'Silahkan cek kelengkapan data team!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Verifikasi',
        cancelButtonText: 'Batal'
    }).then(async (result) => {
        if (result.isConfirmed) {
            try {
                const response = await axios.put(`/teams/${team.id}/status`, {
                    status: 'verified'
                });

                if (response.status === 200) {
                    team.status = 'verified';
                    Swal.fire({
                        title: 'Success!',
                        text: 'Team telah berhasil diverifikasi',
                        icon: 'success',
                        confirmButtonText: 'OK'
                    });
                } else {
                    console.error('Failed to verify the team');
                }
            } catch (error) {
                console.error('An error occurred while verifying the team:', error);
            }
        }
    });
};

// Function to disable the "Gagal" button
const disableGagalButton = () => {
    const gagalButton = document.querySelector('.btn-gagal');
    if (gagalButton) {
        gagalButton.disabled = true;
    }
};

// Function to hide the "Verifikasi" button
const hideVerifikasiButton = () => {
    const verifikasiButton = document.querySelector('.btn-verifikasi');
    if (verifikasiButton) {
        verifikasiButton.style.display = 'none';
    }
};
</script>

<style scoped>
.crud-max-width260 {
    display: flex;
    flex-direction: column;
}

.card {
    display: flex;
    flex-direction: column;
    flex-grow: 1;
}

.popup {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.5);
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 1000;
}

.popup-content {
    background: white;
    padding: 20px;
    border-radius: 8px;
    max-width: 500px;
    width: 100%;
    position: relative;
}

.close {
    position: absolute;
    top: 10px;
    right: 10px;
    cursor: pointer;
}
</style>
