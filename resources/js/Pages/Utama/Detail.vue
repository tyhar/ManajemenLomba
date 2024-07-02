<!-- <script setup>
import { Head, Link } from '@inertiajs/vue3';

defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
    laravelVersion: {
        type: String,
        required: true,
    },
    phpVersion: {
        type: String,
        required: true,
    },
});

function handleImageError() {
    document.getElementById('screenshot-container')?.classList.add('!hidden');
    document.getElementById('docs-card')?.classList.add('!row-span-1');
    document.getElementById('docs-card-content')?.classList.add('!flex-row');
    document.getElementById('background')?.classList.add('!hidden');
}
</script> -->

<template>
    <div class="bg-index">
        <nav class="navbar navbar-expand-lg main_menu">
            <div class="container">
                <a class="navbar-brand" href="/" v-for="setting in settings" :key="setting.id">
                    <img :src="setting.logo1" :alt="setting.name" class="lg-index" />
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="far fa-bars menu_icon"></i>
                    <i class="far fa-times close_icon"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="/#">Beranda</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/#tentang-section">Tentang</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/#lomba-section">Lomba</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/#timeline-section">Timeline</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="/#berita-section">Berita</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/#sponsor-section">Sponsor</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/pesan/create">Kontak</a>
                        </li>
                        <li class="nav-item">
                            <template v-if="!$page.props.auth.user">
                                <div class="row">
                                    <div class="col">
                                        <a class="nav-link common_btn" href="/login">Login</a>
                                    </div>
                                    <!--<div class="col">
                                        <a class="nav-link common_btn" href="/register">Register</a>
                                    </div>-->
                                </div>
                            </template>
                            <template v-else>
                                <a class="nav-link common_btn" href="/dashboard">Dashboard</a>
                            </template>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!--=================================
       MAIN MENU END
   ==================================-->

        <br><br>
        <!--=================================
       BANNER START
   ==================================-->
        <section class="tf__event_details mt_195 xs_mt_100">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h2 class="c-mb50 btn-crud c-mt50"><b>{{ form.judul }}</b></h2>
                        <div class="paragraf-container">
                            <p class="warna-p">Oleh : {{ form.penerbit }}</p>
                            <p class="warna-p p-right c-mb50">Tanggal : {{ form.tanggal_upload }}</p>
                        </div>
                        <div class="tf__event_details_img ">
                            <img :src="getBeritaImageUrl(berita.images)" alt="event details" class="w-100">
                        </div>
                        <div class="tf__event_details_text mt_35 wow fadeInUp">
                            <!-- <ul class="location d-flex flex-wrap c-mt50">
                            <li><i class="fas fa-user"></i> Admin</li>
                            <li><i class="far fa-clock"></i> 12-12-2023</li>
                        </ul> -->
                            <p class="isi-p" v-html="form.deskripsi"></p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <footer class="tf__footer mt_100">
            <div class="text-center p-4 cfooter">
                Copyright ©2024 Tim Website OLINAS
            </div>
        </footer>
    </div>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3';

const props = defineProps({
    berita: Object,
    settings: {
        type: Object, // Menggunakan "type" untuk menentukan tipe data props
        default: () => ({}), // Menggunakan "default" jika props tidak diberikan
    },
    logo1: {
        type: String, // Menentukan tipe data logo sebagai String
    },
});

const form = useForm({
    judul: props.berita.judul,
    deskripsi: props.berita.deskripsi,
    penerbit: props.berita.penerbit,
    tanggal_upload: props.berita.tanggal_upload,
    images: props.berita.images,
})

const getBeritaImageUrl = (imageName) => {
    return imageName ? `/storage/uploads/admin/berita/${imageName}` : '';
};
</script>
<style scoped>
.lg-index {
    width: 150px;
}
</style>
