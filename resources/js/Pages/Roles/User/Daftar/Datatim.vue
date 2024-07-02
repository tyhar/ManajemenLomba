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
                                <p class="user-name mb-0">{{ $page.props.userData.name }}</p>
                                <p class="user-role">{{ $page.props.userData.username }}</p>
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
                    <div class="card-body " v-if="teamz">
                        <h4 class="mb-0">LOMBA {{ teamz?.lomba?.name_lomba }}</h4>
                        <hr />
                        <form @submit.prevent="submit">
                            <div class="row">
                                <div class="col-md-6 c-mb10">
                                    <label class="jarak-input"><b>Nama Tim</b></label>
                                    <input v-model="form.name_team" type="text" class="form-control"
                                        placeholder="Masukan nama tim anda" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="jarak-input"><b>Instansi</b></label>
                                    <input v-model="form.instansi" type="text" class="form-control"
                                        placeholder="Masukan nama instansi" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="jarak-input"><b>No WhatsApp</b></label>
                                    <input v-model="form.phone" type="text" class="form-control c-mb8"
                                        placeholder="Masukan no whatsapp" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="jarak-input"><b>Email</b></label>
                                    <input v-model="form.email" type="email" class="form-control"
                                        placeholder="Masukan email" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="formFile" class="form-label jarak-teks12"><b>Bukti
                                            Pembayaran</b></label>
                                    <input class="form-control" type="file" name="payment"
                                        @change="e => form.payment = e.target.files[0]">
                                </div>
                                <p class="keterangan-foto f-italic">Max file size: 2MB </p>
                                <p class="keterangan-foto f-italic">Format: .jpg, .png, .jpeg</p>
                            </div>
                            <div class="btn-posisi">
                                <button type="button" class="btn btn-danger button-left"
                                    @click="goBack()">Batal</button>
                                <button type="submit" class="btn btn-primary button-right">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { defineProps, reactive } from "vue";
import { router, useForm, usePage } from "@inertiajs/vue3";
import Swal from 'sweetalert2';

const { userData, teamz, settings, logo1 } = defineProps(['userData', 'teamz', 'settings', 'logo1']);

const props = {
    team: {
        type: Object,
    },
    settings: {
        type: Object, // Menggunakan "type" untuk menentukan tipe data props
        default: () => ({}), // Menggunakan "default" jika props tidak diberikan
    },
    logo1: {
        type: String, // Menentukan tipe data logo sebagai String
    },
};

const team = usePage().props.teams;

const form = useForm({
    name_team: team.data.name_team,
    phone: team.data.phone,
    email: team.data.email,
    instansi: team.data.instansi,
    payment: null,
});
// Method to handle form submission

const submit = () => {
    form.post(route('datatim.update', teamz.id), {
        onSuccess: () => {
            form.reset('payment');
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: 'Data tim anda berhasil di perbaharui',
                confirmButtonText: 'OK'
            }).then(() => {
                // Redirect to dashboard
                window.location.href = `/daftarlomba/${teamz?.lomba?.id}`;
            });
        }
    });
};

const goBack = () => {
    window.history.back();
};
</script>