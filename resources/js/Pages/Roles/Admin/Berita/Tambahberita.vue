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
                                    alt="Logo" style="width: 135px; margin-left: -15px;">
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
                        <h4 class="mb-0">TAMBAH BERITA</h4>
                        <hr />
                        <form @submit.prevent="submit">
                            <div class="c-mb10">
                                <label class="c-mb5-black"><b>Judul</b></label>
                                <input type="text" class="form-control" v-model="form.judul"
                                    placeholder="Masukan judul berita" required>
                            </div>
                            <div>
                                <label class="c-mb5-black"><b>Deskripsi Awal</b></label>
                                <div class="col-12">
                                    <textarea class="c-mb10" id="descriptionaddl" rows="2" v-model="form.deskripsi_awal"
                                        placeholder="Masukan deskripsi awal berita (max 20 kata)" required></textarea>
                                </div>
                            </div>
                            <div>
                                <label class="c-mb5-black"><b>Deskripsi</b></label>
                                <div class="col-12">
                                    <textarea class="c-mb10" id="descriptionaddl" rows="5" v-model="form.deskripsi"
                                        placeholder="Masukan deskripsi berita" required></textarea>
                                </div>
                            </div>
                            <div class="c-mb10">
                                <label class="c-mb5-black"><b>Penerbit</b></label>
                                <input type="text" class="form-control" v-model="form.penerbit"
                                    placeholder="Masukan penerbit berita" required>
                            </div>
                            <div>
                                <label class="form-label warna-hitam"><b>Tanggal Upload</b></label>
                                <input type="date" class="form-control jarak-btn8" v-model="form.tanggal_upload">
                            </div>
                            <div>
                                <label for="formFile" class="form-label warna-hitam"><b>Upload Gambar</b></label>
                                <input class="form-control" type="file" id="formFile" v-on:change="onFileChange"
                                    required>
                                <p class="keterangan-foto f-italic">Max file size: 2MB (640 x 500 px)</p>
                                <p class="keterangan-foto f-italic">Format: .jpg, .png, .jpeg</p>
                            </div>
                            <div class="btn-posisi">
                                <button class="btn btn-danger button-left"
                                    onclick="window.location.href='/berita'">Batal</button>
                                <button class="btn btn-primary button-right" type="submit">Tambah</button>
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
import { reactive, ref } from 'vue'
import { router } from '@inertiajs/vue3'

const props = defineProps({
    settings: {
        type: Object, // Menggunakan "type" untuk menentukan tipe data props
        default: () => ({}), // Menggunakan "default" jika props tidak diberikan
    },
    logo1: {
        type: String, // Menentukan tipe data logo sebagai String
    },
})

const form = reactive({
    judul: null,
    deskripsi_awal: null,
    deskripsi: null,
    penerbit: null,
    tanggal_upload: null,
    images: null
})

const selectedFile = ref(null)

function submit() {
    const formData = new FormData();
    formData.append('judul', form.judul);
    formData.append('deskripsi_awal', form.deskripsi_awal);
    formData.append('deskripsi', form.deskripsi);
    formData.append('penerbit', form.penerbit);
    formData.append('tanggal_upload', form.tanggal_upload);
    formData.append('images', selectedFile.value);

    router.post('/berita', formData);
}

function onFileChange(event) {
    selectedFile.value = event.target.files[0];
}

const getImageUrl = (imageName) => {
    return imageName ? `/storage/uploads/admin/setting/${imageName}` : '';
};
</script>