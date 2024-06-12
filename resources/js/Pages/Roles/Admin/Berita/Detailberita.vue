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
                                <img :src="setting.logo1" :alt="setting.name"
                                    style="width: 100px; margin-left: -15px;">
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
                                <p class="user-name mb-0">Habib Shohiburrotib</p>
                                <p class="user-role">habib</p>
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
                        <h4 class="mb-0">DETAIL BERITA</h4>
                        <hr />
                        <div>
                            <div class="col-md-6 c-mb10">
                                <label class="c-mb5-black"><b>JUDUL</b></label>
                                <div class="c-mb20">{{ form.judul }}</div>
                            </div>
                            <div>
                                <label class="c-mb5-black"><b>DESKRIPSI AWAL</b></label>
                                <div class="c-mb20">{{ form.deskripsi_awal }}</div>
                            </div>
                            <div>
                                <label class="c-mb5-black"><b>DESKRIPSI</b></label>
                                <div class="c-mb20">{{ form.deskripsi }}</div>
                            </div>
                            <div class="col-md-6 c-mb10">
                                <label class="c-mb5-black"><b>PENERBIT</b></label>
                                <div class="c-mb20">{{ form.penerbit }}</div>
                            </div>
                            <div class="col-md-6 c-mb10">
                                <label class="c-mb5-black"><b>TANGGAL UPLOAD</b></label>
                                <div class="c-mb20">{{ form.tanggal_upload }}</div>
                            </div>
                            <div class="c-mb10">
                                <label class="c-mb5-black"><b>GAMBAR</b></label><br>
                                <img :src="getBeritaImageUrl(form.images)" class="c-maxw400">
                            </div>
                        </div>
                        <div class="btn-posisi">
                            <button class="btn btn-danger btn-kembali"
                                onclick="window.location.href='/berita'">Kembali</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--end page wrapper -->
    </div>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3';
import { router } from '@inertiajs/vue3'

const props = defineProps({
    errors: Object,
    berita: Object,
    settings: Object,
});

const form = useForm({
    judul: props.berita.judul,
    deskripsi_awal: props.berita.deskripsi_awal,
    deskripsi: props.berita.deskripsi,
    penerbit: props.berita.penerbit,
    tanggal_upload: props.berita.tanggal_upload,
    images: props.berita.images,
})

const getBeritaImageUrl = (imageName) => {
    return imageName ? `/storage/uploads/admin/berita/${imageName}` : '';
};
const getSettingImageUrl = (imageName) => {
    return imageName ? `/storage/uploads/admin/setting/${imageName}` : '';
};
</script>