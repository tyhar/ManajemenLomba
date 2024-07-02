<script setup>

import { Link } from "@inertiajs/vue3";
import { useForm } from "@inertiajs/vue3";
import { Head } from "@inertiajs/vue3";

const { name, username, sponsors, settings, logo1 } = defineProps(['name', 'username', 'sponsors', 'settings', 'logo1']);

const form = useForm({
    name: "",
    judul: "",
    sub_judul: "",
    judul_des: "",
    deskripsi: "",
    mulai: "",
    berakhir: "",
    des_pendaftaran: "",
    pengumpulan: "",
    des_pengumpulan: "",
    pengumuman: "",
    des_pengumuman: "",
    presentasi: "",
    des_presentasi: "",
    whatsApp: "",
    instagram: "",
    email: "",
    youtube: "",
    logo1: null,
    logo2: null,
    logo3: null,
});

const props = {
    settings: {
        type: Object, // Menggunakan "type" untuk menentukan tipe data props
        default: () => ({}), // Menggunakan "default" jika props tidak diberikan
    },
    logo1: {
        type: String, // Menentukan tipe data logo sebagai String
    },
};

const submit = () => {
    form.post(route("setting.store"), {
        preserveScroll: true,
    });
};
</script>

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
                    <div class="search-bar flex-grow-1"></div>
                    <!-- Top menu -->
                    <div class="top-menu ms-auto">
                        <ul class="navbar-nav align-items-center">
                            <div class="user-info ps-3">
                                <p class="user-name mb-0">{{ $page.props.userData.name }}</p>
                                <p class="user-role">{{ $page.props.userData.username }}</p>
                            </div>
                            <div class="parent-icon posisi-icon">
                                <i class="bx bx-user-circle c-font48"></i>
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
                    <form @submit.prevent="submit">
                        <div class="card-body">
                            <h4 class="mb-0">TAMBAH SETTING</h4>
                            <hr />
                            <div>
                                <div class="c-mb10">
                                    <label for="name" class="c-mb5-black"><b>Nama Event</b></label>
                                    <input type="text" class="form-control" v-model="form.name" id="name"
                                        placeholder="Masukan nama event" required />
                                </div>
                                <div class="c-mb10">
                                    <label for="judul" class="c-mb5-black"><b>Judul</b></label>
                                    <input type="text" class="form-control" v-model="form.judul"
                                        placeholder="Masukan judul event" id="judul" required />
                                </div>
                                <div class="c-mb10">
                                    <label for="sub_judul" class="c-mb5-black"><b>Sub Judul</b></label>
                                    <input type="text" class="form-control" v-model="form.sub_judul"
                                        placeholder="Masukan sub judul event" id="sub_judul" required />
                                </div>
                                <div class="c-mb10">
                                    <label for="judul_des" class="c-mb5-black"><b>Judul Deskripsi</b></label>
                                    <input type="text" class="form-control" v-model="form.judul_des"
                                        placeholder="Masukan judul deskripsi" id="judul_des" required />
                                </div>
                                <div class="c-mb10">
                                    <label for="deskripsi" class="c-mb5-black"><b>Deskripsi</b></label>
                                    <textarea rows="4" v-model="form.deskripsi" placeholder="Masukan deskripsi event"
                                        id="descriptionaddl" required></textarea>
                                </div>
                                <div class="row">
                                    <div class="col-md-5 c-mb10">
                                        <label for="mulai" class="form-label warna-hitam"><b>Pendaftaran
                                                Mulai</b></label>
                                        <input type="date" class="form-control label-8" v-model="form.mulai"
                                            id="mulai" />
                                    </div>
                                    <div class="col-md-2 dash-container">
                                        <span class="dash">-</span>
                                    </div>
                                    <div class="col-md-5 c-mb10">
                                        <label for="berakhir" class="form-label warna-hitam"><b>Pendaftaran
                                                Berakhir</b></label>
                                        <input type="date" class="form-control label-8" v-model="form.berakhir"
                                            id="berakhir" />
                                    </div>
                                    <div class="c-mb10">
                                        <label for="des_pendaftaran" class="c-mb5-black"><b>Deskripsi Mulai
                                                Pendaftaran</b></label>
                                        <textarea rows="2" v-model="form.des_pendaftaran"
                                            placeholder="Masukan deskripsi mulai pendaftaran" id="descriptionaddl"
                                            required></textarea>
                                    </div>
                                    <div class="c-mb10">
                                        <label for="pengumpulan" class="form-label warna-hitam"><b>Pengumpulan
                                                Karya</b></label>
                                        <input type="date" class="form-control label-8 date370"
                                            v-model="form.pengumpulan" id="pengumpulan" />
                                    </div>
                                    <div class="c-mb10">
                                        <label for="des_pengumpulan" class="c-mb5-black"><b>Deskripsi Pengumpulan
                                                Karya</b></label>
                                        <textarea rows="2" v-model="form.des_pengumpulan"
                                            placeholder="Masukan deskripsi pengumpulan karya" id="descriptionaddl"
                                            required></textarea>
                                    </div>
                                    <div class="c-mb10">
                                        <label for="pengumuman" class="form-label warna-hitam"><b>Pengumuman
                                                Finalis</b></label>
                                        <input type="date" class="form-control label-8 date370"
                                            v-model="form.pengumuman" id="pengumuman" />
                                    </div>
                                    <div class="c-mb10">
                                        <label for="des_pengumuman" class="c-mb5-black"><b>Deskripsi Pengumuan
                                                Finalis</b></label>
                                        <textarea rows="2" v-model="form.des_pengumuman"
                                            placeholder="Masukan deskripsi timeline" id="descriptionaddl"
                                            required></textarea>
                                    </div>
                                    <div class="c-mb10">
                                        <label for="presentasi" class="form-label warna-hitam"><b>Presentasi
                                                Finalis</b></label>
                                        <input type="date" class="form-control label-8 date370"
                                            v-model="form.presentasi" id="presentasi" />
                                    </div>
                                    <div class="c-mb10">
                                        <label for="des_presentasi" class="c-mb5-black"><b>Deskripsi Presentasi
                                                Finalis</b></label>
                                        <textarea rows="2" v-model="form.des_presentasi"
                                            placeholder="Masukan deskripsi timeline" id="descriptionaddl"
                                            required></textarea>
                                    </div>
                                </div>
                                <div class="c-mb10">
                                    <label for="whatsApp" class="c-mb5-black"><b>No WhatsApp</b></label>
                                    <input type="number" class="form-control" v-model="form.whatsApp"
                                        placeholder="Masukan no whatsapp" id="whatsApp" required />
                                </div>
                                <div class="c-mb10">
                                    <label for="instagram" class="c-mb5-black"><b>Instagram</b></label>
                                    <input type="text" class="form-control" v-model="form.instagram"
                                        placeholder="Masukan username instagram" id="instagram" required />
                                </div>
                                <div class="c-mb10">
                                    <label for="email" class="c-mb5-black"><b>Email</b></label>
                                    <input type="email" class="form-control" v-model="form.email"
                                        placeholder="Masukan email yang dapat dihubungi" id="email" required />
                                </div>
                                <div class="c-mb10">
                                    <label for="youtube" class="c-mb5-black"><b>Youtube</b></label>
                                    <input type="text" class="form-control" v-model="form.youtube"
                                        placeholder="Masukan link youtube" id="youtube" required />
                                </div>
                                <div>
                                    <label for="logo1" class="form-label warna-hitam"><b>Logo 1</b></label>
                                    <input class="form-control" type="file" @input="form.logo1 = $event.target.files[0]"
                                        id="logo1" />
                                    <p class="keterangan-foto f-italic">
                                        Max file size: 2MB (180 x 55 px)
                                    </p>
                                    <p class="keterangan-foto f-italic">
                                        Format: .jpg, .png, .jpeg
                                    </p>
                                </div>
                                <br />
                                <div>
                                    <label for="logo2" class="form-label warna-hitam"><b>Logo 2</b></label>
                                    <input class="form-control" type="file" @input="form.logo2 = $event.target.files[0]"
                                        id="logo2" />
                                    <p class="keterangan-foto f-italic">
                                        Max file size: 2MB (1200 x 800 px)
                                    </p>
                                    <p class="keterangan-foto f-italic">
                                        Format: .jpg, .png, .jpeg
                                    </p>
                                </div>
                                <br />
                                <div>
                                    <label for="logo3" class="form-label warna-hitam"><b>Logo 3</b>
                                    </label>
                                    <input class="form-control" type="file" @input="form.logo3 = $event.target.files[0]"
                                        id="logo3" />
                                    <p class="keterangan-foto f-italic">
                                        Max file size: 2MB (450 x 450 px)
                                    </p>
                                    <p class="keterangan-foto f-italic">
                                        Format: .jpg, .png, .jpeg
                                    </p>
                                </div>
                            </div>
                            <div class="btn-posisi">
                                <a class="btn btn-danger button-left" :href="route('setting.index')">Batal</a>
                                <button type="submit" class="btn btn-primary button-right">
                                    Tambah
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!--end page wrapper -->
    </div>
</template>
