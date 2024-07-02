<script setup>
import { router, useForm, usePage } from "@inertiajs/vue3";
import Swal from 'sweetalert2'; // Import SweetAlert
import { reactive, onMounted, ref } from 'vue';

const { name, username, settings, logo1, kriterias, lombaCriteria } = defineProps(['name', 'username', 'kriterias', 'settings', 'logo1', 'lombaCriteria']);

const lomba = usePage().props.lombas;

const form = reactive({
    name_lomba: lomba.data.name_lomba || '',
    pj: lomba.data.pj || '',
    description: lomba.data.description || '',
    kontak: lomba.data.kontak || '',
    tempat: lomba.data.tempat || '',
    biaya_pendaftaran: lomba.data.biaya_pendaftaran || '',
    picture: null,
    sertifikat: null,
    selectedCriteria: [],
    bobot: {},
});

const sertifikatError = ref('');

// Initialize selectedCriteria and bobot with existing data
onMounted(() => {
    lombaCriteria.forEach(criteria => {
        form.selectedCriteria.push(criteria.id);
        form.bobot[criteria.id] = criteria.weight;
    });
});

const isKriteriaSelected = (kriteriaId) => {
    return form.selectedCriteria.includes(kriteriaId);
};

const handlePictureUpload = (event) => {
    form.picture = event.target.files[0];
};

const handleSertifikatUpload = (event) => {
    const file = event.target.files[0];
    if (file && file.type !== 'application/pdf') {
        sertifikatError.value = 'Format file harus .pdf';
        form.sertifikat = null;
    } else {
        sertifikatError.value = '';
        form.sertifikat = file;
    }
};

const submit = async () => {
    const totalBobot = form.selectedCriteria.reduce((acc, id) => {
        return acc + (parseInt(form.bobot[id]) || 0);
    }, 0);

    if (totalBobot !== 100) {
        Swal.fire({
            icon: 'error',
            title: 'Gagal',
            text: 'Total bobot kriteria harus 100%',
        });
        return;
    }

    const formData = new FormData();
    formData.append('_method', 'put');
    formData.append('name_lomba', form.name_lomba);
    formData.append('pj', form.pj);
    formData.append('description', form.description);
    formData.append('tempat', form.tempat);
    formData.append('kontak', form.kontak);
    formData.append('biaya_pendaftaran', form.biaya_pendaftaran);

    form.selectedCriteria.forEach(id => {
        formData.append('selectedCriteria[]', id);
        formData.append(`bobot[${id}]`, form.bobot[id]);
    });
    if (form.picture) {
        formData.append('picture', form.picture);
    }
    if (form.sertifikat) {
        formData.append('sertifikat', form.sertifikat);
    }

    try {
        await router.post(`/lomba/${lomba.data.id}`, formData);
        Swal.fire({
            icon: 'success',
            title: 'Success',
            text: 'Lomba berhasil diperbarui!',
        });
    } catch (error) {
        console.error('Error:', error);
    }
};

const goBack = () => {
    window.history.back();
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
                                    alt="Logo" style="width: 100px; margin-left: -15px;">
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
                    <form @submit.prevent="submit" enctype="multipart/form-data">
                        <div class="card-body">
                            <h4 class="mb-0">EDIT LOMBA</h4>
                            <hr />
                            <div class="row">
                                <div class="col-md-6 c-mb10">
                                    <label class="c-mb5-black"><b>Nama Lomba</b></label>
                                    <input type="text" class="form-control" v-model="form.name_lomba" id="name"
                                        placeholder="Masukan nama lomba">
                                </div>
                                <div class="col-md-6 c-mb10">
                                    <label class="c-mb5-black"><b>Nama PJ</b></label>
                                    <input type="text" class="form-control" v-model="form.pj" id="pj"
                                        placeholder="Masukan nama PJ">
                                </div>
                                <div class="col-md-6">
                                    <label class="c-mb5-black"><b>Deskripsi</b></label>
                                    <div class="col-12">
                                        <textarea class="form-control c-mb10" placeholder="Masukan deskripsi lomba"
                                            id="deskripsi" rows="4" v-model="form.description"></textarea>
                                    </div>
                                    <div>
                                        <label for="picture" class="form-label judul-form"><b>Gambar</b></label>
                                        <input type="file" id="picture" accept="image/*" class="form-control"
                                            @change="handlePictureUpload">
                                        <p class="keterangan-foto f-italic">Max file size: 2MB (500 x 500 px)</p>
                                        <p class="keterangan-foto f-italic">Format: .jpg, .png, .jpeg</p>
                                    </div>
                                    <br>
                                    <div>
                                        <label for="sertifikat" class="form-label judul-form"><b>Sertifikat</b></label>
                                        <input type="file" id="sertifikat" class="form-control"
                                            @change="handleSertifikatUpload">
                                        <p class="keterangan-foto f-italic">Max file size: 2MB</p>
                                        <p class="keterangan-foto f-italic">Format: .pdf</p>
                                        <span v-if="sertifikatError" class="text-danger">{{ sertifikatError }}</span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="c-mb5-black"><b>Kontak PJ (+62)</b></label>
                                    <input type="number" class="form-control" v-model="form.kontak" id="kontak"
                                        placeholder="Masukan kontak PJ">
                                    <div>
                                        <label class="c-mb5-black"><b>Tempat</b></label>
                                        <input type="text" class="form-control" v-model="form.tempat" id="tempat"
                                            placeholder="Masukan nama tempat">
                                    </div>
                                    <div class="c-mt10">
                                        <label class="c-mb5-black"><b>Biaya Pendaftaran</b></label>
                                        <input type="text" class="form-control" v-model="form.biaya_pendaftaran"
                                            placeholder="Masukan biaya pendaftaran" id="biaya_pendaftaran">
                                    </div>
                                    <div>
                                        <label class="role-add"><b class="warna-hitam">Kriteria Penilaian</b></label>
                                        <div v-for="kriteria in kriterias.data" :key="kriteria.id" class="form-check">
                                            <input class="form-check-input" type="checkbox"
                                                :id="'kriteria' + kriteria.id" v-model="form.selectedCriteria"
                                                :value="kriteria.id">
                                            <label class="form-check-label" :for="'kriteria' + kriteria.id">{{ kriteria.name_kriteria }} </label>
                                            <input type="number" class="form-control" placeholder="Masukan bobot nilai"
                                                :readonly="!isKriteriaSelected(kriteria.id)"
                                                v-model="form.bobot[kriteria.id]">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="btn-posisi">
                                <button class="btn btn-danger button-left" @click="goBack">Kembali</button>
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
