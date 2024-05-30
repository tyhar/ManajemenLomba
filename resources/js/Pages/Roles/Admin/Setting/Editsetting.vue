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
                                <img src="/bootstrap/images/lg.png" alt="Logo"
                                    style="width: 100px; margin-left: -15px;">
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
                                <p class="user-name mb-0">
                                    Habib Shohiburrotib
                                </p>
                                <p class="user-role">habib</p>
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
                                    <input type="text" class="form-control" v-model="form.name" id="name" />
                                </div>
                                <div class="c-mb10">
                                    <label for="judul" class="c-mb5-black">
                                        <b>Judul</b>
                                    </label>
                                    <input type="text" class="form-control" v-model="form.judul" id="judul" />
                                </div>
                                <div class="c-mb10">
                                    <label for="sub_judul" class="c-mb5-black">
                                        <b>Sub Judul</b>
                                    </label>
                                    <input type="text" class="form-control" v-model="form.sub_judul" id="sub_judul" />
                                </div>
                                <div class="c-mb10">
                                    <label for="judul_des" class="c-mb5-black">
                                        <b>Judul Deskripsi</b>
                                    </label>
                                    <input type="text" class="form-control" v-model="form.judul_des" id="judul_des" />
                                </div>
                                <div class="c-mb10">
                                    <label for="deskripsi" class="c-mb5-black">
                                        <b>Deskripsi</b>
                                    </label>
                                    <input type="text" class="form-control" v-model="form.deskripsi" id="deskripsi" />
                                </div>
                                <div class="c-mb10">
                                    <label for="mulai" class="c-mb5-black">
                                        <b>Tanggal Mulai</b>
                                    </label>
                                    <input type="date" class="form-control" v-model="form.mulai" id="mulai" />
                                </div>
                                <div class="c-mb10">
                                    <label for="berakhir" class="c-mb5-black">
                                        <b>Tanggal Berakhir</b>
                                    </label>
                                    <input type="date" class="form-control" v-model="form.berakhir" id="berakhir" />
                                </div>
                                <div class="c-mb10">
                                    <label for="logo1" class="c-mb5-black">
                                        <b>Logo 1</b>
                                    </label>
                                    <div class="m-2 p-2">
                                        <!-- <img :src="logo" class="w-32 h-32" style="width: 500px;" /> -->
                                        <img :src="logo1" alt="Product Image" class="img-fluid c-maxw400new" />
                                    </div>
                                    <input class="form-control" type="file" @input="form.logo1 = $event.target.files[0]"
                                        id="logo1" />
                                    <p class="keterangan-foto">
                                        Max 2 MB ( 180 x 55 px )
                                    </p>
                                </div>
                                <div class="c-mb10">
                                    <label for="logo2" class="c-mb5-black">
                                        <b>Logo 2 (background)</b>
                                    </label>
                                    <div class="m-2 p-2">
                                        <!-- <img :src="logo" class="w-32 h-32" style="width: 500px;" /> -->
                                        <img :src="logo2" alt="Product Image" class="img-fluid c-maxw400new" />
                                    </div>
                                    <input class="form-control" type="file" @input="
                                        form.logo2 = $event.target.files[0]
                                        " id="logo2" />
                                    <p class="keterangan-foto">
                                        Max 2 MB ( 1200 x 800 px )
                                    </p>
                                </div>
                                <div class="c-mb10">
                                    <label for="logo3" class="c-mb5-black">
                                        <b>Logo 3</b>
                                    </label>
                                    <div class="m-2 p-2">
                                        <!-- <img :src="logo" class="w-32 h-32" style="width: 500px;" /> -->
                                        <img :src="logo3" alt="Product Image" class="img-fluid c-maxw400new" />
                                    </div>
                                    <input class="form-control" type="file" @input="
                                        form.logo3 = $event.target.files[0]
                                        " id="logo3" />
                                    <p class="keterangan-foto">
                                        Max 2 MB ( 450 x 450 px )
                                    </p>
                                </div>
                            </div>
                            <div class="btn-posisi">
                                <button type="submit" class="btn btn-primary button-tabel-right">
                                    Update
                                </button>
                                <a class="btn btn-danger button-tabel-left" :href="route('setting.index')">
                                    Batal
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!--end page wrapper -->
    </div>
</template>
