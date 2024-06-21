<script setup>
import { Link } from "@inertiajs/vue3";
import { useForm } from "@inertiajs/vue3";
import { Head } from "@inertiajs/vue3";
import { usePage } from "@inertiajs/vue3";
import { router } from "@inertiajs/vue3";

const props = defineProps({
    settings: Object,
    logo1: String,
    logo2: String,
    logo3: String
});

const form = useForm({
    name: props.settings.name,
    judul: props.settings.judul,
    sub_judul: props.settings.sub_judul,
    judul_des: props.settings.judul_des,
    deskripsi: props.settings.deskripsi,
    mulai: props.settings.mulai,
    berakhir: props.settings.berakhir,
    des_pendaftaran: props.settings.des_pendaftaran,
    pengumpulan: props.settings.pengumpulan,
    des_pengumpulan: props.settings.des_pengumpulan,
    pengumuman: props.settings.pengumuman,
    des_pengumuman: props.settings.des_pengumuman,
    presentasi: props.settings.presentasi,
    des_presentasi: props.settings.des_presentasi,
    whatsApp: props.settings.whatsApp,
    instagram: props.settings.instagram,
    email: props.settings.email,
    youtube: props.settings.youtube,
    logo1: null,
    logo2: null,
    logo3: null,
});

const submit = () => {
    router.post(route("setting.update", props.settings.id), {
        // preserveScroll: true,
        _method: "put",
        name: form.name,
        judul: form.judul,
        sub_judul: form.sub_judul,
        judul_des: form.judul_des,
        deskripsi: form.deskripsi,
        mulai: form.mulai,
        berakhir: form.berakhir,
        des_pendaftaran: form.des_pendaftaran,
        pengumpulan: form.pengumpulan,
        des_pengumpulan: form.des_pengumpulan,
        pengumuman: form.pengumuman,
        des_pengumuman: form.des_pengumuman,
        presentasi: form.presentasi,
        des_presentasi: form.des_presentasi,
        whatsApp: form.whatsApp,
        instagram: form.instagram,
        email: form.email,
        youtube: form.youtube,
        logo1: form.logo1,
        logo2: form.logo2,
        logo3: form.logo3,
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
                        <div class="navbar-left">
                            <a href="/">
                                <img :src="logo1" alt="Logo" style="width: 135px; margin-left: -15px;">
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
                            <h4 class="mb-0">EDIT SETTING</h4>
                            <hr />
                            <div>
                                <div class="c-mb10">
                                    <label for="name" class="c-mb5-black">
                                        <b>Nama Event</b>
                                    </label>
                                    <input type="text" class="form-control" placeholder="Masukan nama event"
                                        v-model="form.name" id="name" />
                                </div>
                                <div class="c-mb10">
                                    <label for="judul" class="c-mb5-black">
                                        <b>Judul</b>
                                    </label>
                                    <input type="text" class="form-control" placeholder="Masukan judul event"
                                        v-model="form.judul" id="judul" />
                                </div>
                                <div class="c-mb10">
                                    <label for="sub_judul" class="c-mb5-black">
                                        <b>Sub Judul</b>
                                    </label>
                                    <input type="text" class="form-control" placeholder="Masukan sub judul event"
                                        v-model="form.sub_judul" id="sub_judul" />
                                </div>
                                <div class="c-mb10">
                                    <label for="judul_des" class="c-mb5-black">
                                        <b>Judul Deskripsi</b>
                                    </label>
                                    <input type="text" class="form-control" placeholder="Masukan judul deskripsi"
                                        v-model="form.judul_des" id="judul_des" />
                                </div>
                                <div class="c-mb10">
                                    <label for="deskripsi" class="c-mb5-black">
                                        <b>Deskripsi</b>
                                    </label>
                                    <textarea rows="4" v-model="form.deskripsi" placeholder="Masukan deskripsi event"
                                        id="descriptionaddl" required></textarea>
                                </div>
                                <div class="row">
                                    <div class="col-md-5 c-mb10">
                                        <label for="mulai" class="c-mb5-black">
                                            <b>Tanggal Mulai</b>
                                        </label>
                                        <input type="date" class="form-control" v-model="form.mulai" id="mulai" />
                                    </div>
                                    <div class="col-md-2 dash-container">
                                        <span class="dash">-</span>
                                    </div>
                                    <div class="col-md-5 c-mb10">
                                        <label for="berakhir" class="c-mb5-black">
                                            <b>Tanggal Berakhir</b>
                                        </label>
                                        <input type="date" class="form-control" v-model="form.berakhir" id="berakhir" />
                                    </div>
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
                                    <input type="date" class="form-control label-8 date370" v-model="form.pengumpulan"
                                        id="pengumpulan" />
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
                                    <input type="date" class="form-control label-8 date370" v-model="form.pengumuman"
                                        id="pengumuman" />
                                </div>
                                <div class="c-mb10">
                                    <label for="des_pengumuman" class="c-mb5-black"><b>Deskripsi Pengumuman
                                            Finalis</b></label>
                                    <textarea rows="2" v-model="form.des_pengumuman"
                                        placeholder="Masukan deskripsi pengumuman finalis" id="descriptionaddl"
                                        required></textarea>
                                </div>
                                <div class="c-mb10">
                                    <label for="presentasi" class="form-label warna-hitam"><b>Presentasi
                                            Finalis</b></label>
                                    <input type="date" class="form-control label-8 date370" v-model="form.presentasi"
                                        id="presentasi" />
                                </div>
                                <div class="c-mb10">
                                    <label for="des_presentasi" class="c-mb5-black"><b>Deskripsi Presentasi
                                            Finalis</b></label>
                                    <textarea rows="2" v-model="form.des_presentasi"
                                        placeholder="Masukan deskripsi presentasi finalis" id="des_presentasi"
                                        required></textarea>
                                </div>
                                <div class="c-mb10">
                                    <label for="whatsApp" class="c-mb5-black"><b>WhatsApp</b></label>
                                    <input type="text" class="form-control" v-model="form.whatsApp"
                                        placeholder="Masukan no whatsapp" id="whatsApp" />
                                </div>
                                <div class="c-mb10">
                                    <label for="instagram" class="c-mb5-black"><b>Instagram</b></label>
                                    <input type="text" class="form-control" v-model="form.instagram"
                                        placeholder="Masukan username instagram" id="instagram" />
                                </div>
                                <div class="c-mb10">
                                    <label for="email" class="c-mb5-black"><b>Email</b></label>
                                    <input type="text" class="form-control" v-model="form.email"
                                        placeholder="Masukan email yang dapat dihubungi" id="email" />
                                </div>
                                <div class="c-mb10">
                                    <label for="youtube" class="c-mb5-black"><b>Youtube</b></label>
                                    <input type="text" class="form-control" v-model="form.youtube"
                                        placeholder="Masukan link youtube" id="youtube" />
                                </div>
                                <div class="c-mb10">
                                    <label for="logo1" class="c-mb5-black"><b>Logo 1</b></label>
                                    <div class="m-2 p-2">
                                        <img :src="logo1" alt="Product Image" class="img-fluid c-maxw400new" />
                                    </div>
                                    <input class="form-control" type="file" @input="form.logo1 = $event.target.files[0]"
                                        id="logo1" />
                                    <p class="keterangan-foto f-italic">Max file size: 2MB (180 x 55 px)</p>
                                    <p class="keterangan-foto f-italic">Format: .jpg, .png, .jpeg</p>
                                </div>
                                <br>
                                <div class="c-mb10">
                                    <label for="logo2" class="c-mb5-black"><b>Logo 2 (background)</b></label>
                                    <div class="m-2 p-2">
                                        <img :src="logo2" alt="Product Image" class="img-fluid c-maxw400new" />
                                    </div>
                                    <input class="form-control" type="file" @input="form.logo2 = $event.target.files[0]"
                                        id="logo2" />
                                    <p class="keterangan-foto f-italic">Max file size: 2MB (1200 x 800 px)</p>
                                    <p class="keterangan-foto f-italic">Format: .jpg, .png, .jpeg</p>
                                </div>
                                <br>
                                <div class="c-mb10">
                                    <label for="logo3" class="c-mb5-black"><b>Logo 3</b></label>
                                    <div class="m-2 p-2">
                                        <img :src="logo3" alt="Product Image" class="img-fluid c-maxw400new" />
                                    </div>
                                    <input class="form-control" type="file" @input="form.logo3 = $event.target.files[0]"
                                        id="logo3" />
                                    <p class="keterangan-foto f-italic">Max file size: 2MB (450 x 450 px)</p>
                                    <p class="keterangan-foto f-italic">Format: .jpg, .png, .jpeg</p>
                                </div>
                            </div>
                            <div class="btn-posisi">
                                <a class="btn btn-danger button-left" :href="route('setting.index')">Batal</a>
                                <button type="submit" class="btn btn-primary button-right">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!--end page wrapper -->
    </div>
</template>
