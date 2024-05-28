<script setup>
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
    sponsors: {
        type: Array,
        required: true,
    },
});

// console.log('Sponsors:', sponsors);

//front-end
function handleImageError() {
    document.getElementById('screenshot-container')?.classList.add('!hidden');
    document.getElementById('docs-card')?.classList.add('!row-span-1');
    document.getElementById('docs-card-content')?.classList.add('!flex-row');
    document.getElementById('background')?.classList.add('!hidden');
}
</script>


<template>
    <div class="bg-index">
        <nav class="navbar navbar-expand-lg main_menu">
            <div class="container">
                <a class="navbar-brand" href="#">
                    <img src="/bootstrap/images/lg.png" alt="Logo" class="lg-index">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="far fa-bars menu_icon"></i>
                    <i class="far fa-times close_icon"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link active" href="#">Beranda</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#tentang-section">Tentang</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#lomba-section">Lomba</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#timeline-section">Timeline</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#berita-section">Berita</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#sponsor-section">Sponsor</a>
                        </li>
                        <li class="nav-item">
                            <!-- <a class="nav-link" href="/kontak">Kontak</a> -->
                            <a class="nav-link" :href="route('pesan.create')">Kontak</a>
                        </li>
                        <li class="nav-item">
                            <template v-if="!$page.props.auth.user">
                                <div class="row">
                                    <div class="col">
                                        <a class="nav-link common_btn" href="/login">Login</a>
                                    </div>
                                    <!-- <div v-if="canRegister" class="col"></div> -->
                                    <div class="col">
                                        <a class="nav-link common_btn" href="/register">Register</a>
                                    </div>
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

        <section class="tf__banner" style="background: url(bootstrap/images/home2.jpg);">
            <div class="container">
                <div class="row">
                    <div class="col-xl-7 col-lg-8">
                        <div class="tf__banner_text wow fadeInUp">
                            <h1 class="teks-judul"><b>Olimpiade Informatika Nasional</b></h1>
                            <h1 class="teks-judul2"><b>OLINAS 2024</b></h1>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <br>
        <section id="tentang-section" class="tf__home_2_about pt_100 pb_100"
            style="background: url(bootstrap/images/about_2_bg.jpg);">
            <div class="container">
                <div class="row">
                    <div class="col-xl-6 col-lg-6 wow fadeInLeft">
                        <div class="tf__home_2_about_img">
                            <img src="bootstrap/images/about_2_img_3.jpg" alt="about us" class="img-fluid w-100">
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 wow fadeInRight">
                        <div> <!-- <div class="tf__home_2_about_text"-->
                            <div class="tf__heading_area tf__heading_area_left mb_25">
                                <h5 class="jud">Apa itu OLINAS ?</h5>
                            </div>
                            <p class="tentang"> Olinas adalah Olimpiade Informatika Nasional, ajang kompetisi nasional
                                bagi
                                mahasiswa vokasi di Indonesia. Event ini memajukan keterampilan teknologi dan
                                kreativitas,
                                penting
                                dalam menghadapi era digital. Olinas, acara tahunan yang dinantikan, menginspirasi
                                pelajar
                                untuk
                                eksplorasi dan berkembang dalam teknologi informasi. Dengan peran yang semakin penting,
                                Olinas
                                memberikan motivasi bagi generasi mendatang untuk mengeksplorasi dunia digital.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="lomba-section" class="tf__categories mt_95">
            <div class="tf__activities_slider_area">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-6 col-md-8 col-lg-6 m-auto wow fadeInUp">
                            <div class="tf__heading_area mb_15">
                                <h5 class="judul-lomba-index">Lomba</h5>
                            </div>
                        </div>
                    </div>
                    <!--breadcrumb-->
                    <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-3">
                        <div class="col">
                            <div class="card radius-15 card-overview">
                                <img src="bootstrap/images/desain.jpg" alt="New Image" class="border-radius">
                                <button class="btn btn-danger btn-landing-page" href="/detailpeserta">UI / UX </button>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card radius-15 card-overview">
                                <img src="bootstrap/images/ar-vr.jpg" alt="New Image" class="border-radius">
                                <a class="btn btn-danger btn-landing-page" href="/detailpeserta">AR / VR </a>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card radius-15 card-overview">
                                <img src="bootstrap/images/aplikasi-mobile.jpg" alt="New Image" class="border-radius">
                                <a class="btn btn-danger btn-landing-page" href="#">Aplikasi Mobile</a>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card radius-15 card-overview">
                                <img src="bootstrap/images/desain-website.jpg" alt="New Image" class="border-radius">
                                <a class="btn btn-danger btn-landing-page" href="/detailpeserta">Aplikasi Mobile</a>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card radius-15 card-overview">
                                <img src="bootstrap/images/sistem-keamanan-data.jpg" alt="New Image"
                                    class="border-radius">
                                <a class="btn btn-danger btn-landing-page" href="/detailpeserta">Desain Website </a>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card radius-15 card-overview">
                                <img src="bootstrap/images/membuat-game.jpg" alt="New Image" class="border-radius">
                                <a class="btn btn-danger btn-landing-page" href="#">Membuat Game </a>
                            </div>
                        </div>
                    </div>
                    <!--end row-->
                </div>
            </div>
        </section>

        <section id="timeline-section" class="tf__categories mt_95">
            <div class="container jarak-container">
                <div class="row">
                    <div class="col-xl-6 col-md-8 col-lg-6 m-auto wow fadeInUp">
                        <div class="tf__heading_area mb_15">
                            <h5 class="c-mb-40">Timeline</h5>
                            <div class="card container-hg180-index">
                                <div class="card-body p-4 text-center">
                                    <h6 class="h6-landing-page1"><b>Event OLINAS</b></h6>
                                    <h6 class="h6-landing-page2"><b>Tanggal Mulai : 12 April 2024</b></h6>
                                    <h6 class="h6-landing-page2"><b>Tanggal Berakhir : 13 Mei 2024</b></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <br><br>
        <section id="berita-section" class="tf__event mt_95">
            <div class="container">
                <div class="row">
                    <div class="col-xl-6 col-md-8 col-lg-6 m-auto wow fadeInUp">
                        <div class="tf__heading_area mb_40">
                            <h5>Berita</h5>
                        </div>
                    </div>
                </div>
                <div class="row event_slider">
                    <div class="col-xl-4 wow fadeInUp" onclick="window.location.href='/informasiberita'">
                        <div class="tf__single_event">
                            <div class="tf__single_event_img">
                                <img src="bootstrap/images/event_img_1.jpg" alt="event" class="img-fluid w-100">
                            </div>
                            <div class="tf__single_event_text">
                                <a class="title" href="/informasiberita">Monitoring Perkembangan Projek Manajemen Lomba
                                    Prodi</a>
                                <p>Platform yang sering kami gunakan untuk melakukan diskusi online selain whatsapp
                                    adalah
                                    discord </p>
                                <div class="tf__single_event_footer">
                                    <span>27 Februari 2024</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 wow fadeInUp" onclick="window.location.href='/informasiberita'">
                        <div class="tf__single_event">
                            <div class="tf__single_event_img">
                                <img src="bootstrap/images/liburan.jpg" alt="event" class="img-fluid w-100">
                            </div>
                            <div class="tf__single_event_text">
                                <a class="title" href="/informasiberita">Berlibur Sebagai Persiapan Sebelum Memulai
                                    Proyek</a>
                                <p>Sebelum memulai proyek, kami melakukan liburan agar pikiran segar.</p>
                                <div class="tf__single_event_footer">
                                    <span>29 Februari 2024</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 wow fadeInUp" onclick="window.location.href='/informasiberita'">
                        <div class="tf__single_event">
                            <div class="tf__single_event_img">
                                <img src="bootstrap/images/farel.png" alt="event" class="img-fluid w-100">
                            </div>
                            <div class="tf__single_event_text">
                                <a class="title" href="/informasiberita">Profil Ketua Emailkomp Periode 2024</a>
                                <p>Emailkomp adalah sebuah organisasi dibawah pengawasan langsung oleh Prodi Teknik
                                    Informatika
                                </p>
                                <div class="tf__single_event_footer">
                                    <span>12 Desember 2023</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 wow fadeInUp" onclick="window.location.href='/informasiberita'">
                        <div class="tf__single_event">
                            <div class="tf__single_event_img">
                                <img src="bootstrap/images/game.png" alt="event" class="img-fluid w-100">
                            </div>
                            <div class="tf__single_event_text">
                                <a class="title" href="/informasiberita">Bermain Game Untuk Melatih Kekompakan Tim</a>
                                <p>Hal yang sering kami lakukan ketika selesai diskusi yaitu bermain game gartic</p>
                                <div class="tf__single_event_footer">
                                    <span>25 Februari 2024</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--=================================
       EVENT END
   ==================================-->

        <section id="sponsor-section" class="tf__categories mt_95">
            <div class="container">
                <div class="row">
                    <div class="tf__heading_area mb_15">
                        <h5> Sponsor</h5>
                        <div class="sponsor-grid">
                            <div v-for="sponsor in sponsors" :key="sponsor.id" class="sponsor-item2">
                                <a :href="sponsor.link_file">
                                    <img :src="sponsor.logo" :alt="sponsor.name" class="img-fluid" />
                                    <!-- style="max-width: 200px; -->
                                </a>
                            </div>
                            <!-- <div class=" sponsor-item">
                                <img src="bootstrap/images/logo-sv.png" alt="about" class="img-fluid">
                        </div>
                        <div class="sponsor-item">
                            <img src="bootstrap/images/UNS.png" alt="about" class="img-fluid">
                        </div>
                        <div class="sponsor-item">
                            <img src="bootstrap/images/d3ti.png" alt="about" class="img-fluid">
                        </div>
                        <div class="sponsor-item">
                            <img src="bootstrap/images/em.png" alt="about" class="img-fluid">
                        </div> -->
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
