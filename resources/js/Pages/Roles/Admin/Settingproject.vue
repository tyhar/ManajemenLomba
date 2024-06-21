<template>
    <div class="wrapper">
        <!-- Header -->
        <header>
            <div class="c-topbar">
                <nav class="navbar navbar-expand">
                    <!-- Navbar -->
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
                            <div class="parent-icon posisi-icon"><i class="bx bx-user-circle c-font48"></i></div>
                        </ul>
                    </div>
                </nav>
            </div>
        </header>
        <!-- End Header -->
        <!-- Start Page Wrapper -->
        <div class="page-wrapper-new">
            <div class="page-content">
                <div class="card">
                    <div class="card-body">
                        <h4 class="mb-0">SETTING EMAIL PROJECT</h4>
                        <hr />
                        <form @submit.prevent="submit" enctype="multipart/form-data">
                            <div>
                                <label class="c-mb5-black">Name</label>
                                <input type="text" v-model="form.appName" class="form-control c-mb20"
                                    placeholder="Masukkan nama" />
                                <span v-if="form.errors.appName">{{ form.errors.appName }}</span>
                            </div>
                            <div>
                                <label class="c-mb5-black">Email</label>
                                <input type="text" v-model="form.emailName" class="form-control c-mb20"
                                    placeholder="Masukkan email" />
                                <span v-if="form.errors.emailName">{{ form.errors.emailName }}</span>
                            </div>
                            <div class="btn-posisi">
                                <button class="btn btn-danger button-left" @click="goBack()">Batal</button>
                                <button type="submit" class="btn btn-primary button-right">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Page Wrapper -->
    </div>
</template>

<script setup>
import { defineProps } from 'vue';
import { useForm } from '@inertiajs/vue3';
import Swal from 'sweetalert2';

// Form state
const form = useForm({
    appName: '',
    emailName: ''
});

// Define props
defineProps({
    name: String,
    username: String,
    settings: Array,
    logo1: String,
    appName: String
});

// Submit form
const submit = async () => {
    // Check for spaces in the input fields
    if (/\s/.test(form.appName) || /\s/.test(form.emailName)) {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Anda tidak menyertakan spasi untuk update nama email project!'
        });
        return;
    }

    try {
        await form.post(route('settings.store'), {
            preserveScroll: true,
            onSuccess: () => {
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: 'Settings updated successfully!'
                });
            }
        });
    } catch (error) {
        console.error('Error:', error);
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'An error occurred while updating settings.'
        });
    }
};

// Go back function
const goBack = () => {
    window.history.back();
};
</script>
