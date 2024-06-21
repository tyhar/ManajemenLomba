<script setup>

import { Link } from '@inertiajs/vue3';
import { useForm } from "@inertiajs/vue3";
import { Head } from "@inertiajs/vue3";
import { usePage } from "@inertiajs/vue3";
import { router } from "@inertiajs/vue3";
// import { inertia } from "@inertiajs/inertia";
const { name, username, logo, settings, logo1 } = defineProps(['name', 'username', 'logo', 'settings', 'logo1']);



const props = {
    sponsors: {
        type: Object, // Menggunakan "type" untuk menentukan tipe data props
        default: () => ({}), // Menggunakan "default" jika props tidak diberikan
    },
    logo: {
        type: String, // Menentukan tipe data logo sebagai String
    },
    settings: {
        type: Object, // Menggunakan "type" untuk menentukan tipe data props
        default: () => ({}), // Menggunakan "default" jika props tidak diberikan
    },
    logo1: {
        type: String, // Menentukan tipe data logo sebagai String
    },
};



const sponsor = usePage().props.sponsors;

const form = useForm({
    name: sponsor.data.name,
    logo: sponsor.data.logo,
    link_file: sponsor.data.link_file,
});
async function submit() {
    const formData = {
        _method: 'put',
        name: form.name,
        logo: form.logo,
        link_file: form.link_file,
    };

    try {
        await router.post(`/sponsor/${sponsor.data.id}`, formData);
        // Display SweetAlert on success
        Swal.fire({
            icon: 'success',
            title: 'Success',
            text: 'Sponsor berhasil diperbarui!',
        });
    } catch (error) {
        console.error('Error:', error);
        // Handle error if needed
    }
}
const goBack = () => {
    window.history.back();
};


</script>
<template>
    <div class="wrapper">
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
                    <div class="card-body">
                        <h4 class="mb-0">EDIT SPONSOR</h4>
                        <hr />
                        <form @submit.prevent="submit">
                            <div class="c-mb10">
                                <label for="name" class="c-mb5-black"><b>Nama Sponsor</b></label>
                                <input type="text" class="form-control" placeholder="Masukan nama sponsor"
                                    v-model="form.name" id="name">
                            </div>
                            <div>
                                <label for="link_file" class="c-mb5-black"><b>Link</b></label>
                                <div class="col-12">
                                    <textarea class="c-mb10" rows="2" v-model="form.link_file" id="descriptionaddl"
                                        placeholder="Masukan link sponsor"></textarea>
                                </div>
                            </div>
                            <div>
                                <label for="logo" class="form-label warna-hitam"> <b>Logo</b></label>
                                <div class="m-2 p-2">
                                    <!-- <img :src="logo" class="w-32 h-32" style="width: 500px;" /> -->
                                    <img :src="logo" alt="Product Image" class="img-fluid c-maxw400" />
                                </div>
                                <input class="form-control" type="file" @input="form.logo = $event.target.files[0]"
                                    id="logo">
                                <p class="keterangan-foto f-italic">Max file size: 2MB (200 x 200 px)</p>
                                <p class="keterangan-foto f-italic">Format: .jpg, .png, .jpeg</p>
                            </div>
                            <div class="btn-posisi">
                                <!-- <button class="btn btn-primary button-tabel-right" onclick="window.location.href='/sponsor'">Tambah</button>
                                <button class="btn btn-danger button-tabel-left" onclick="window.location.href='/sponsor'">Batal</button> -->
                                <a class="btn btn-danger button-left" :href="route('sponsor.index')">Batal</a>
                                <button type="submit" class="btn btn-primary button-right">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!--end page wrapper -->
    </div>
</template>