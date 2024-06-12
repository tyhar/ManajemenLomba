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
        <div class="kotak-putih">
            <div class="page-wrapper-peserta">
                <div class="page-content">
                    <div class="card container-hgnew">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-7 label-left">
                                    <h5 class="judul-detail c-ml-25 c-mt10"><b>Tema Lomba</b></h5>
                                    <div class="judul-lomba-index c-ml-25 warna-hitam" id="name_lomba">{{
                                        lombax.name_lomba }}
                                    </div>
                                </div>
                                <div>
                                    <div class="div-class">
                                        <a class="btn btn-pink c-mtkc" href="#">BUKU
                                            PANDUAN</a>
                                        <a class="btn btn-success width200 c-mtk mg-t10 warna-hitam" ar
                                            :href="route('daftarlomba.index')">DAFTAR
                                            LOMBA</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class=" des-biru"><br>
            <!-- <a class="kont">{{ lombax.description }}</a> -->
            <h5 class="deskripsil"><b>A. Deskripsi</b></h5>
            <a class="deskripsil deskripsil-detail">Lomba UI/UX adalah suatu kompetisi yang ditujukan pada para calon
                peserta
                untuk berkreativitas merancang antarmuka pengguna (UI) dan pengalaman
                pengguna (UX) dengan tema yang diusung adalah “Creative Design Innovation in the Digital Era to Realize
                Indonesia Emas 2045”.
            </a>
            <a class="deskripsil deskripsil-detail">Dari tema tersebut para calon peserta akan mengungkapkan
                permasalahan dan
                tantangan yang dihadapi oleh masyarakat Indonesia dan memberikan solusi melalui perancangan aplikasi
                mobile, situs web, atau sistem interaktif lain dengan
                tujuan untuk mencapai tujuan Indonesia Emas 2045. Selain merancang sesuai
                kebutuhan dan kegunaan, para calon peserta juga perlu menggunakan kretivitas
                mereka agar desain UI/UX dapat lebih unik, variatif, dan memiliki daya tarik.
            </a>
            <a class="deskripsil deskripsil-detail"> Tujuan dari kompetisi ini adalah mengajak para sinergis muda untuk
                berkolaborasi dalam tim menyalurkan kemampuan desain mereka dalam
                menyajikan suatu UI/UX yang akan berdampak positif bagi pengguna. Selain itu,
                dengan diselenggarakan kompetisi ini maka akan memperluas jaringan para
                desiner UI/UX untuk dapat dilirik oleh perusahaan atau organisasi.
            </a>
            <br><br>
            <h5 class="deskripsil"><b>B. Tema Lomba</b></h5>
            <a class="deskripsil deskripsil-detailnew">Kompetisi kali ini mengusung tema “Creative Design Innovation in
                the Digital Era to Realize Indonesia Emas 2045”
            </a>
            <br><br>
            <h5 class="deskripsil"><b>C. Ketentuan Peserta</b></h5>
            <ol class="deskripsil-detail2">
                <li>Peserta merupakan seorang mahasiswa/i aktif program Diploma (D1-D4)/Sarjana (S1) dari Perguruan
                    Tinggi Negeri/Swasta yang dibuktikan dengan Kartu Tanda Mahasiswa (KTM).</li>
                <li>Perlombaan bersifat tim dengan minimal anggota 2 orang dan maksimal 3 orang dari institusi atau
                    perguruan tinggi yang sama. Selain itu, diperbolehkan untuk lintas program studi bagi mahasiswa/i
                    perguruan tinggi.</li>
                <li>Setiap peserta hanya diperbolehkan mengirimkan satu karya terbaik. </li>
                <li>Peserta hanya diperbolehkan berada dalam satu tim UI/UX.</li>
                <li>Peserta dikenakan biaya pendaftaran sebesar Rp 45.000,00 per tim.</li>
                <li> Peserta bersedia mengikuti seluruh rangkaian kegiatan yang telah dijadwalkan oleh panitia.</li>
                <li>Peserta yang tidak memenuhi persyaratan dinyatakan gugur.</li>
            </ol>
            <br>
            <h5 class="deskripsil"><b>D. Ketentuan Lomba</b></h5>
            <ol class="deskripsil-detail2">
                <li>Setiap peserta hanya diperbolehkan mengambil satu platform (web atau
                    mobile) untuk dijadikan sebagai studi kasus.</li>
                <li>Karya yang diusulkan merupakan karya orisinil peserta dan belum pernah
                    diikutsertakan dalam kompetisi sejenis serta belum pernah dipublikasikan
                    dalam bentuk apapun.</li>
                <li>Karya tidak boleh mengandung unsur pornografi, SARA, sadisme atau hal-hal
                    yang bersifat merendahkan atau melecehkan pihak lain.</li>
                <li>Karya dibatasi untuk pengguna software berbasis mobile application.</li>
                <li>Karya harus sesuai dengan tema yaitu “Creative Design Innovation in the
                    Digital Era to Realize Indonesia Emas 2045”.</li>
                <li>Karya yang diterima adalah karya yang dikirimkan sesuai dengan batas waktu
                    yang telah ditentukan.</li>
                <li>Penilaian dilakukan oleh dewan juri yang telah ditetapkan oleh panitia.</li>
                <li>Dewan Juri adalah pihak yang memiliki wewenang memberikan penilaian
                    sesuai dengan kriteria yang telah ditetapkan. 7. 8.Penilaian dari dewan juri bersifat mutlak dan
                    tidak dapat diganggu gugat.</li>
                <li>Pemenang perlombaan merupakan tim dengan nilai tertinggi dari semua aspek
                    penilaian yang telah ditetapkan oleh panitia. Keputusan juri tidak dapat diganggu gugat.</li>
            </ol>
        </div>
        <!--end page wrapper -->
    </div>
</template>
<script setup>
import { defineProps } from "vue";
import { useForm, usePage } from '@inertiajs/vue3';

// Mendefinisikan properti yang diterima oleh komponen
const props = defineProps({
    name: String,
    username: String,
    lombax: Object,
});

</script>