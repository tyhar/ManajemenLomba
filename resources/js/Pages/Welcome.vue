<script setup>
import { Head, Link } from "@inertiajs/vue3";
import { defineProps, ref } from 'vue';
import { router } from "@inertiajs/vue3";

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
    settings: {
        type: Array,
        required: true,
    },
    beritas: {
        type: Array,
        required: true,
    },
    lombas: {
        type: Array,
        required: true,
    },
});

function detail(id) {
    router.get("/berita/" + id + "/detail");
}

const getBeritaImageUrl = (imageName) => {
    return imageName ? `/storage/uploads/admin/berita/${imageName}` : "";
};
// console.log('Sponsors:', sponsors);

//front-end
function handleImageError() {
    document.getElementById("screenshot-container")?.classList.add("!hidden");
    document.getElementById("docs-card")?.classList.add("!row-span-1");
    document.getElementById("docs-card-content")?.classList.add("!flex-row");
    document.getElementById("background")?.classList.add("!hidden");
}
</script>

<template>
    <div class="bg-index">
        <nav class="navbar navbar-expand-lg main_menu">
            <div class="container">
                <a class="navbar-brand" href="#" v-for="setting in settings" :key="setting.id">
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
                            <a class="nav-link active" href="/#">Beranda</a>
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
                            <a class="nav-link" href="/#berita-section">Berita</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/#sponsor-section">Sponsor</a>
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

        <section v-for="setting in settings" :key="setting.id" class="tf__banner"
            :style="{ background: 'url(' + setting.logo2 + ')' }">
            <div class="container">
                <div class="row">
                    <div class="col-xl-7 col-lg-8">
                        <div class="tf__banner_text wow fadeInUp" v-for="setting in settings" :key="setting.id">
                            <h1 class="teks-judul">
                                <b>{{ setting.judul }}</b>
                            </h1>
                            <h1 class="teks-judul2">
                                <b>{{ setting.sub_judul }}</b>
                            </h1>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <br />
        <section id="tentang-section" class="tf__home_2_about pt_100 pb_100"
            style="background: url(bootstrap/images/about_2_bg.jpg)">
            <div class="container">
                <div class="row">
                    <div class="col-xl-6 col-lg-6 wow fadeInLeft">
                        <div v-for="setting in settings" :key="setting.id" class="tf__home_2_about_img">
                            <img :src="setting.logo3" :alt="setting.name" class="img-fluid w-100" />
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 wow fadeInRight">
                        <div>
                            <!-- <div class="tf__home_2_about_text"-->
                            <div class="tf__heading_area tf__heading_area_left mb_25" v-for="setting in settings"
                                :key="setting.id">
                                <h5 class="jud">{{ setting.judul_des }}</h5>
                            </div>
                            <div v-for="setting in settings" :key="setting.id">
                                <p class="tentang">{{ setting.deskripsi }}</p>
                            </div>
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
                        <div class="col" v-for="lomba in lombas" :key="lomba.id">
                            <div class="card radius-15 card-overview">
                                <img :src="lomba.picture ? `/storage/${lomba.picture}` : '/bootstrap/images/default.jpg'"
                                    class="border-radius" />
                                <a class="btn btn-danger btn-landing-page" :href="`/detailpeserta/${lomba.id}`">
                                    {{ lomba.name_lomba }}
                                </a>
                            </div>
                        </div>
                    </div>
                    <!--end row-->
                </div>
            </div>
        </section>
        <br />
        <!-- Timeline 4 - Bootstrap Brain Component -->
        <section id="timeline-section" class="bsb-timeline-4">
            <div class="container">
                <div class="row justify-content-center" v-for="setting in settings" :key="setting.id">
                    <!-- <div class="col-xl-6 col-md-8 col-lg-6 m-auto wow fadeInUp"> -->
                    <div class="tf__heading_area mb_15">
                        <h5 class="c-mb-40">Timeline</h5>
                        <div class="card bg-timeline">
                            <div class="card-body p-4 text-center">
                                <ul class="timeline">
                                    <li class="timeline-item left">
                                        <div class="timeline-body">
                                            <div class="timeline-meta">
                                                <div
                                                    class="d-inline-flex flex-column px-2 py-1 text-success-emphasis bg-success-subtle border border-success-subtle rounded-2 text-md-end">
                                                    <span>{{ setting.mulai }}</span>
                                                </div>
                                            </div>
                                            <div class="timeline-content timeline-indicator">
                                                <div class="card border-0 shadow">
                                                    <div class="card-body p-xl-4">
                                                        <h3 class="cuyy">
                                                            PENDAFTARAN
                                                        </h3>
                                                        <p class="card-text m-0 cuyyy">
                                                            {{ setting.des_pendaftaran }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="timeline-item right">
                                        <div class="timeline-body">
                                            <div class="timeline-meta">
                                                <div
                                                    class="d-inline-flex flex-column px-2 py-1 text-success-emphasis bg-success-subtle border border-success-subtle rounded-2 text-md-end">
                                                    <span>{{ setting.pengumpulan }}</span>
                                                </div>
                                            </div>
                                            <div class="timeline-content timeline-indicator">
                                                <div class="card border-0 shadow">
                                                    <div class="card-body p-xl-4">
                                                        <h3 class="cuyy">
                                                            PENGUMPULAN KARYA
                                                        </h3>
                                                        <p class="card-text m-0 cuyyy">
                                                            {{ setting.des_pengumpulan }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="timeline-item left">
                                        <div class="timeline-body">
                                            <div class="timeline-meta">
                                                <div
                                                    class="d-inline-flex flex-column px-2 py-1 text-success-emphasis bg-success-subtle border border-success-subtle rounded-2 text-md-end">
                                                    <span>{{ setting.pengumuman }}</span>
                                                </div>
                                            </div>
                                            <div class="timeline-content timeline-indicator">
                                                <div class="card border-0 shadow">
                                                    <div class="card-body p-xl-4">
                                                        <h3 class="cuyy">
                                                            PENGUMUMAN FINALIS
                                                        </h3>
                                                        <p class="card-text m-0 cuyyy">
                                                            {{ setting.des_pengumuman }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="timeline-item right">
                                        <div class="timeline-body">
                                            <div class="timeline-meta">
                                                <div
                                                    class="d-inline-flex flex-column px-2 py-1 text-success-emphasis bg-success-subtle border border-success-subtle rounded-2 text-md-end">
                                                    <span>{{ setting.presentasi }}</span>
                                                </div>
                                            </div>
                                            <div class="timeline-content timeline-indicator">
                                                <div class="card border-0 shadow">
                                                    <div class="card-body p-xl-4">
                                                        <h3 class="cuyy">
                                                            PRESENTASI FINAL
                                                        </h3>
                                                        <p class="card-text m-0 cuyyy">
                                                            {{ setting.des_presentasi }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

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
                    <div class="col-xl-4 wow fadeInUp" v-for="berita in beritas">
                        <div class="tf__single_event">
                            <button @click.prevent="detail(berita.id)">
                                <div class="tf__single_courses_img">
                                    <img :src="getBeritaImageUrl(berita.images)" alt="event" class="img-fluid w-100" />
                                </div>
                                <div class="tf__single_event_text">
                                    <a class="title">{{ berita.judul }}</a>
                                    <p>{{ berita.deskripsi_awal }}</p>
                                    <div class="tf__single_event_footer">
                                        <span>{{ berita.tanggal_upload }}</span>
                                    </div>
                                </div>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="sponsor-section" class="tf__categories mt_95">
            <div class="container">
                <div class="row">
                    <div class="tf__heading_area mb_15">
                        <h5>Sponsor</h5>
                        <div class="sponsor-grid">
                            <div v-for="sponsor in sponsors" :key="sponsor.id">
                                <a :href="sponsor.link_file">
                                    <img :src="sponsor.logo" :alt="sponsor.name" class="img-fluid" />
                                </a>
                            </div>
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

<style scoped>
.lg-index {
    width: 150px;
}
</style>
