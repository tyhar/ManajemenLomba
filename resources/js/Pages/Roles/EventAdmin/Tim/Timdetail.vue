<template>
    <div class="wrapper">
        <header>
            <div class="c-topbar">
                <nav class="navbar navbar-expand">
                    <div class="navbar-tambah">
                        <div class="navbar-left" v-for="setting in settings" :key="setting.id">
                            <a href="/">
                                <img :src="setting.logo1 ? `/storage/${setting.logo1}` : '/bootstrap/images/logo1default.jpg'"
                                    alt="Logo" style="width: 135px; margin-left: -15px;">
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
                            <div class="parent-icon posisi-icon"><i class="bx bx-user-circle c-font48"></i></div>
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
                        <button v-if="team.status !== 'verified'"
                            class="btn btn-danger crud-width-150 btn-petugas btn-gagal"
                            @click="showPopup">Gagal</button>
                        <div v-if="isPopupVisible" class="popup">
                            <div class="popup-content">
                                <span class="close" @click="hidePopup">&times;</span>
                                <h5>Input Notifikasi</h5>
                                <hr />
                                <div>
                                    <label class="c-mb5-black c-ml20"><b>Deskripsi</b></label>
                                    <div class="col-11">
                                        <textarea v-model="form.description" class="form-control c-mb10 c-ml20"
                                            id="inputProductDescription" rows="3"
                                            placeholder="Tulis Notifikasi"></textarea>
                                    </div>
                                    <button class="btn btn-primary crud-width100 btn-mid c-mt40"
                                        @click="sendNotification">Kirim</button>
                                </div>
                            </div>
                        </div>

                        <button v-if="team.status !== 'verified'"
                            class="btn btn-primary crud-width-150 btn-petugas btn-verifikasi posisi-ver"
                            @click="verifyTeam">Verifikasi</button>
                        <button v-if="team.status === 'verified'"
                            class="btn btn-success crud-width-150 btn-petugas btn-verifikasi posisi-ver">Tervifikasi</button>
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
                                            <img :src="member.user.photo ? `/storage/${member.user.photo}` : '/bootstrap/images/default2.png'"
                                                height="120" alt="..." class="img-fluidc rounded">
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
                                        <div class="data-tim"><a
                                                :href="`/submissionsurat/${submissions.id}`">Dokumen.pdf</a></div>
                                    </div>
                                    <div class="col-md-3 label-left" v-if="submissions">
                                        <label class="jarak-teks05"><b>FILE</b></label>
                                        <div class="data-tim"><a :href="`/submissionshow/${submissions.id}`">Lihat
                                                File</a></div>
                                    </div>
                                    <div class="col-md-2 label-left" v-if="submissions">
                                        <label class="jarak-teks05"><b>LINK KARYA</b></label>
                                        <div class="data-tim c-mb-70"><a :href="submissions.link" target="_blank">Buka
                                                Link</a></div>
                                    </div>
                                    <div class="label-left" v-if="submissions">
                                        <label class="jarak-teks05"><b>DESKRIPSI</b></label>
                                        <div class="c-mb20 rata-tengah">{{ submissions.title }}</div>
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

const { userData, members, team, submissions, settings, logo1 } = defineProps(['userData', 'members', 'team', 'submissions', 'settings', 'logo1']);

const props = {
    settings: {
        type: Object, // Menggunakan "type" untuk menentukan tipe data props
        default: () => ({}), // Menggunakan "default" jika props tidak diberikan
    },
    logo1: {
        type: String, // Menentukan tipe data logo sebagai String
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

async function sendNotification() {
    try {
        await router.post('/notifications', {
            team_id: team.id,
            description: form.description
        });
        Swal.fire({
            title: 'Berhasil!',
            text: 'Data berhasil disimpan.',
            icon: 'success',
            confirmButtonText: 'OK',
            onClose: () => {
                router.push('/notifications');
            }
        });
    } catch (error) {
        console.error('Error submitting form:', error);
        Swal.fire({
            title: 'Gagal!',
            text: 'Gagal menyimpan data.',
            icon: 'error',
            confirmButtonText: 'OK'
        });
    }
}

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
</style>
