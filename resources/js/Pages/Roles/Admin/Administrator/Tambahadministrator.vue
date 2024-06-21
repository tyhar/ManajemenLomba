<script setup>
import { useForm, Link, router } from "@inertiajs/vue3";
import { reactive, watch } from "vue";
import Swal from 'sweetalert2';

const { name, username, users, settings, logo1, lombas } = defineProps(['name', 'username', 'users', 'settings', 'logo1', 'lombas']);

// Definisikan properti yang diterima oleh komponen
const props = {
    users: {
        type: Array,
    },
    settings: {
        type: Object, // Menggunakan "type" untuk menentukan tipe data props
        default: () => ({}), // Menggunakan "default" jika props tidak diberikan
    },
    logo1: {
        type: String, // Menentukan tipe data logo sebagai String
    },
    lombas: {
        type: Array,
    },
};

const form = useForm({
    name: null,
    username: null,
    email: null,
    password: null,
    role: "Pilih Role",
    selectedLomba: [],
});

function submit() {
    // Menambahkan properti selectedCriteria ke dalam data yang disubmit
    const formData = { ...form, selectedLomba: form.selectedLomba };
    router.post('/administrator', formData)
        .then(() => {
            Swal.fire({
                icon: 'success',
                title: 'Sukses!',
                text: 'Akun administrator berhasil ditambahkan.',
                confirmButtonText: 'Ok'
            });
        })
        .catch(error => {
            console.error('Error:', error);
            // Handle error here
        });
}

// Watch for changes in the selected role to clear selectedLomba if role changes
watch(() => form.role, (newRole) => {
    if (newRole !== 4) {
        form.selectedLomba = [];
    }
});

$(document).ready(function () {
    $("#show_hide_password a").on('click', function (event) {
        event.preventDefault();
        if ($('#show_hide_password input').attr("type") == "text") {
            $('#show_hide_password input').attr('type', 'password');
            $('#show_hide_password i').addClass("bx-hide");
            $('#show_hide_password i').removeClass("bx-show");
        } else if ($('#show_hide_password input').attr("type") == "password") {
            $('#show_hide_password input').attr('type', 'text');
            $('#show_hide_password i').removeClass("bx-hide");
            $('#show_hide_password i').addClass("bx-show");
        }
    });
});
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
                        <h4 class="mb-0">TAMBAH ADMINISTRATOR</h4>
                        <hr />
                        <form @submit.prevent="submit">
                            <div class="row">
                                <div class="col-md-6 margin-top10-crud">
                                    <label class="c-mb5-black"><b>Nama Lengkap</b></label>
                                    <input id="name" type="name" class="form-control" v-model="form.name"
                                        placeholder="Masukan nama lengkap" required>
                                </div>

                                <div class="col-md-6 margin-top10-crud">
                                    <label class="c-mb5-black"><b>Username</b></label>
                                    <input id="username" type="username" class="form-control"
                                        placeholder="Masukan username" v-model="form.username" required>
                                </div>
                                <div class="col-md-12 margin-top10-crud">
                                    <label class="c-mb5-black"><b>Email</b></label>
                                    <input id="email" type="email" class="form-control" v-model="form.email"
                                        placeholder="Masukan email" required>
                                </div>
                                <div>
                                    <label for="inputChoosePassword"
                                        class="form-label warna-hitam"><b>Password</b></label>
                                    <div class="input-group" id="show_hide_password">
                                        <input type="password" v-model="form.password" class="form-control border-end-0"
                                            id="inputChoosePassword" placeholder="Masukan password" required> <a
                                            href="javascript:;" class="input-group-text bg-transparent"><i
                                                class='bx bx-hide'></i></a>
                                    </div>
                                </div>
                                <div>
                                    <label class="role-add "><b class="warna-hitam">Role</b></label>
                                    <select class="form-select" id="role" v-model="form.role">
                                        <option selected disabled>Pilih Role</option>
                                        <option :value="1">Admin</option>
                                        <option :value="4">Juri</option>
                                        <option :value="2">Petugas</option>
                                    </select>
                                </div>
                                <div v-if="form.role == 4">
                                    <label class="role-add"><b class="warna-hitam">Lomba</b></label>
                                    <div>
                                        <div class="form-check" v-for="lomba in lombas.data" :key="lomba.id">
                                            <input class="form-check-input" type="checkbox" :id="'lomba' + lomba.id"
                                                v-model="form.selectedLomba" :value="lomba.id">
                                            <label class="form-check-label" :for="'lomba' + lomba.id">{{
                                                lomba.name_lomba }}</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="btn-posisi">
                                    <a class="btn btn-danger button-left" :href="route('administrator.index')">Batal</a>
                                    <button class="btn btn-primary button-right" type="submit">Tambah</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!--end page wrapper -->
    </div>
</template>
