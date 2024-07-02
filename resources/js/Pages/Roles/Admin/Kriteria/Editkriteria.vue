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
                    <form @submit.prevent="submit">
                        <div class="card-body">
                            <h4 class="mb-0">EDIT KRITERIA PENILAIAN</h4>
                            <hr />
                            <div class="row">
                                <div class=" c-mb10">
                                    <label class="c-mb5-black"><b>Kriteria Penilaian</b></label>
                                    <input type="text" class="form-control" placeholder="Masukan kriteria penilaian"
                                        v-model="form.name_kriteria" id="name_kriteria" required>
                                </div>
                            </div>
                            <div class="btn-posisi">
                                <button class="btn btn-danger button-left" @click="goBack()">Kembali</button>
                                <button type="submit" class="btn btn-primary button-right">Simpan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!--end page wrapper -->
    </div>
</template>

<script setup>
import { router, useForm, usePage } from "@inertiajs/vue3";
import Swal from 'sweetalert2'; // Import SweetAlert


const { name, username, settings, logo1 } = defineProps(['name', 'username', 'settings', 'logo1']);

const props = {
    settings: {
        type: Object, // Menggunakan "type" untuk menentukan tipe data props
        default: () => ({}), // Menggunakan "default" jika props tidak diberikan
    },
    logo1: {
        type: String, // Menentukan tipe data logo sebagai String
    },
};
const kriteria = usePage().props.kriterias;



const form = useForm({
    name_kriteria: kriteria.data.name_kriteria,

});

async function submit() {
    const formData = {
        _method: 'put',
        name_kriteria: form.name_kriteria,
    };

    try {
        await router.post(`/kriteria/${kriteria.data.id}`, formData);
        // Display SweetAlert on success
        Swal.fire({
            icon: 'success',
            title: 'Success',
            text: 'Kriteria berhasil diperbarui!',
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
