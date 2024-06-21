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
                        <h4 class="mb-0">EDIT BERITA</h4>
                        <hr />
                        <form @submit.prevent="submit(berita.id)">
                            <div class="c-mb10">
                                <label class="c-mb5-black"><b>Judul</b></label>
                                <input type="text" class="form-control" placeholder="Masukan judul berita"
                                    v-model="form.judul">
                            </div>
                            <div>
                                <label class="c-mb5-black"><b>Deskripsi Awal</b></label>
                                <div class="col-12">
                                    <textarea class="form-control c-mb10"
                                        placeholder="Masukan deskripsi awal berita (max 20 kata)"
                                        id="inputProductDescription" rows="2" v-model="form.deskripsi_awal"></textarea>
                                </div>
                            </div>
                            <div>
                                <label class="c-mb5-black"><b>Deskripsi</b></label>
                                <div class="col-12">
                                    <textarea class="form-control c-mb10" placeholder="Masukan deskripsi berita"
                                        id="inputProductDescription" rows="7" v-model="form.deskripsi"></textarea>
                                </div>
                            </div>
                            <div class="c-mb10">
                                <label class="c-mb5-black"><b>Penerbit</b></label>
                                <input type="text" class="form-control" placeholder="Masukan penerbit berita"
                                    v-model="form.penerbit">
                            </div>
                            <div>
                                <label class="form-label warna-hitam"><b>Tanggal Upload</b></label>
                                <input type="date" class="form-control jarak-btn8" v-model="form.tanggal_upload">
                            </div>
                            <div>
                                <label for="formFile" class="form-label warna-hitam"><b>Upload Gambar</b></label>
                                <input class="form-control" type="file" id="formFile"
                                    @input="form.images = $event.target.files[0]">
                                <p class="keterangan-foto f-italic">Max file size: 2MB (640 x 500 px)</p>
                                <p class="keterangan-foto f-italic">Format: .jpg, .png, .jpeg</p>
                            </div>
                            <div class="btn-posisi">
                                <a class="btn btn-danger button-left" onclick="window.location.href='/berita'">Batal</a>
                                <button class="btn btn-primary button-right" type="submit">Simpan</button>
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
import { useForm, router } from '@inertiajs/vue3';
import { ref } from 'vue'

const props = defineProps({
    errors: Object,
    berita: Object,
    settings: {
        type: Object, // Menggunakan "type" untuk menentukan tipe data props
        default: () => ({}), // Menggunakan "default" jika props tidak diberikan
    },
    logo1: {
        type: String, // Menentukan tipe data logo sebagai String
    },
})
const selectedFile = ref(null)

const form = useForm({
    judul: props.berita.judul,
    deskripsi_awal: props.berita.deskripsi_awal,
    deskripsi: props.berita.deskripsi,
    penerbit: props.berita.penerbit,
    tanggal_upload: props.berita.tanggal_upload,
    images: null,
})
function submit(id) {
    router.post('/berita/' + id, {
        _method: 'put',
        form
    });
}

const getSettingImageUrl = (imageName) => {
    return imageName ? `/storage/uploads/admin/setting/${imageName}` : '';
};
</script>