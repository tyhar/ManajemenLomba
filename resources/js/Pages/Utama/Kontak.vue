<script setup>
import { reactive } from "vue";
import { Head, Link, useForm, router } from "@inertiajs/vue3";
import Swal from "sweetalert2";

// Backend navbar
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
    settings: {
        type: Object,
        required: true,
    },
});

// Form data
const form = useForm({
    name: null,
    email: null,
    phone: null,
    value: null,
});

const submit = () => {
    form.post(route("pesan.store"), {
        preserveScroll: true,
        onSuccess: () => {
            Swal.fire({
                title: "Success!",
                text: "Pesan anda telah berhasil dikirim",
                icon: "success",
                confirmButtonText: "OK",
            });
        },
    });
};
</script>

<template>
    <div class="bg-index">
        <nav class="navbar navbar-expand-lg main_menu">
            <div class="container" v-for="setting in settings" :key="setting.id">
                <a class="navbar-brand" href="/">
                    <img :src="setting.logo1 ? `/storage/${setting.logo1}` : '/bootstrap/images/logo1default.jpg'"
                        class="lg-index" />
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
                            <a class="nav-link" href="/#berita-section">Berita</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/#sponsor-section">Sponsor</a>
                        </li>
                        <li class="nav-item">
                            <!-- <a class="nav-link" href="/kontak">Kontak</a> -->
                            <a class="nav-link active" :href="route('pesan.create')">Kontak</a>
                        </li>
                        <li class="nav-item">
                            <template v-if="!$page.props.auth.user">
                                <div class="row">
                                    <div class="col">
                                        <a class="nav-link common_btn" href="/login">Login</a>
                                    </div>
                                    <!-- <div class="col">
                                        <a class="nav-link common_btn" href="/register">Register</a>
                                    </div> -->
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
        <div v-for="setting in settings" :key="setting.id">
            <section class="tf__breadcrumb"
                :style="{ backgroundImage: `url(${setting.logo2 ? `/storage/${setting.logo2}` : '/bootstrap/images/logo1default.jpg'})` }">
            </section>
        </div>

        <section class="tf__contact_page mt_190">
            <div class="container" v-for="setting in settings" :key="setting.id">
                <div class="row">
                    <div class="tf__heading_area tf__heading_area_left mb_25">
                        <h5 class="c-mb-8 text25">INFORMASI KONTAK</h5>
                    </div>
                    <div class="row">
                        <div class="col-md-c3">
                            <h6 class="c-mb-13"><b>WhatsApp</b></h6>
                            <h6 class="c-mb20">{{ setting.whatsApp }}</h6>
                        </div>
                        <div class="col-md-3">
                            <h6 class="c-mb-13"><b>Instagram</b></h6>
                            <h6 class="c-mb20">{{ setting.instagram }}</h6>
                        </div>
                        <div class="col-md-3">
                            <h6 class="c-mb-13"><b>Email</b></h6>
                            <h6 class="c-mb20">{{ setting.email }}</h6>
                        </div>
                        <div class="col-md-2 cml30">
                            <h6 class="c-mb-13"><b>Youtube</b></h6>
                            <h6 class="c-mb20">{{ setting.youtube }}</h6>
                        </div>
                    </div>
                    <br /><br /><br /><br /><br />
                    <div class="col-xxl-8 col-xl-7 wow fadeInLeft">
                        <div class="tf__contact_form">
                            <form @submit.prevent="submit">
                                <input class="form-control ckontak" id="nama" type="text" v-model="form.name"
                                    placeholder="Nama Lengkap" />
                                <input class="form-control ckontak c-mtkc" id="nama" type="email" v-model="form.email"
                                    placeholder="Email" />
                                <input class="form-control ckontak c-mtkc" id="nomor" type="number" v-model="form.phone"
                                    placeholder="No. WhatsApp (cont. 085xxxxxxx)" />
                                <textarea class="c-mtkc" rows="4" type="textarea" v-model="form.value"
                                    placeholder="Pesan" />
                                <button type="submit" class="common_btn_2">
                                    Kirim
                                </button>
                            </form>
                        </div>
                    </div>
                    <div class="col-xxl-4 col-xl-5 col-lg-6 wow fadeInRight">
                        <div class="col-xl-12 wow fadeInUp">
                            <div class="tf__contact_map cmt_30">
                                <iframe
                                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3012.4794374146772!2d110.98160354801688!3d-7.591865364294748!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7a19d07a714fd3%3A0xaea18d5d16dea09d!2sWaduk%20Delingan!5e1!3m2!1sen!2sid!4v1711694566155!5m2!1sen!2sid"
                                    width="600" height="450" style="border: 0" allowfullscreen="" loading="lazy"
                                    referrerpolicy="no-referrer-when-downgrade"></iframe>
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
