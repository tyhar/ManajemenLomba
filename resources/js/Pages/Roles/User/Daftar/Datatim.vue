<template>
    <div class="wrapper">
        <header>
            <div class="c-topbar">
                <nav class="navbar navbar-expand">
                    <div class="navbar-tambah">
                        <div class="navbar-left" v-for="setting in settings" :key="setting.id">
                            <a href="/">
                                <img :src="setting.logo1" :alt="setting.name"
                                    style="width: 100px; margin-left: -15px;">
                            </a>
                        </div>
                    </div>
                    <div class="search-bar flex-grow-1"></div>
                    <div class="top-menu ms-auto">
                        <ul class="navbar-nav align-items-center">
                            <div class="user-info ps-3">
                                <p class="user-name mb-0">Lionel Andres</p>
                                <p class="user-role">leon</p>
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
                    <div class="card-body">
                        <h4 class="mb-0">LOMBA CYBER SECURITY</h4>
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
                                    <input v-model="form.instansi" type="text" class="form-control" required>
                                </div>
                                <!-- <div class="col-md-6">
                                    <label class="c-mb5-black"><b>Nama Lomba</b></label>
                                    <div class="col-12">
                                        <select v-model="form.SelectedLomba" class="form-select" required>
                                            <option v-for="lomba in lombas" :key="lomba.id" :value="lomba.id">
                                                {{ lomba.name_lomba }}
                                            </option>
                                        </select>
                                    </div>
                                </div> -->
                                <div class="col-md-6">
                                    <label class="jarak-input"><b>No WhatsApp</b></label>
                                    <input v-model="form.phone" type="text" class="form-control c-mb8" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="jarak-input"><b>Email</b></label>
                                    <input v-model="form.email" type="email" class="form-control" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="formFile" class="form-label jarak-teks12"><b>Bukti
                                            Pembayaran</b></label>
                                    <input class="form-control" type="file" name="payment"
                                        v-on:change="handlePaymentUpload">
                                </div>
                                <p class="keterangan-foto f-italic">Max file size: 2MB (500 x 500 px)</p>
                                <p class="keterangan-foto f-italic">Format: .jpg, .png, .jpeg</p>
                            </div>
                            <div class="btn-posisi">
                                <button type="submit" class="btn btn-primary button-tabel-right">Simpan</button>
                                <button class="btn btn-danger button-tabel-left" @click="goBack()">Batal</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!--end page wrapper -->
    </div>
</template>


<script setup>
import { defineProps } from "vue";
import { reactive } from 'vue';
import { router } from '@inertiajs/vue3';
import Swal from 'sweetalert2';

const form = reactive({
    name_team: '',
    instansi: '',
    SelectedLomba: [],
    phone: '',
    email: '',
    payment: null,
});

const { name, username, lombas, settings } = defineProps(['name', 'username', 'lombas', 'settings']);

// Definisikan properti yang diterima oleh komponen
const props = {
    lombas: {
        type: Array,
        default: () => [],
    },
    settings: {
        type: Array,
    },
};

const handlePaymentUpload = (event) => {
    form.payment = event.target.files[0];
};

async function submit() {
    // Menambahkan properti selectedCriteria ke dalam data yang disubmit
    const formData = { ...form, SelectedLomba: form.SelectedLomba };

    try {
        await router.post('/datatim', formData);
        // Tampilkan SweetAlert2 jika request berhasil
        Swal.fire({
            icon: 'success',
            title: 'Success!',
            text: 'Data tim berhasil ditambahkan.',
            confirmButtonText: 'OK',
        });
    } catch (error) {
        // Handle error
        console.error('Error:', error);
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Terjadi kesalahan saat menambahkan data tim.',
            confirmButtonText: 'OK',
        });
    }
}


const goBack = () => {
    window.history.back();
};
</script>
