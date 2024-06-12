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
                                <img :src="setting.logo1" :alt="setting.name"
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
                        <h4 class="mb-0">TAMBAH KRITERIA PENILAIAN</h4>
                        <hr />
                        <form @submit.prevent="submit" enctype="multipart/form-data">
                            <div class="row" v-for="(criteria, index) in form.kriteria" :key="index">
                                <div class="col-md-6">
                                    <label class="c-mb5-black c-mt10"><b>Kriteria Penilaian</b></label>
                                    <input type="text" class="form-control label-8"
                                        placeholder="Masukan kriteria penilaian" v-model="criteria.name_kriteria">
                                </div>
                                <div class="col-md-6">
                                    <label class="c-mb5-black c-mt10"><b>Bobot (%)</b></label>
                                    <input type="number" class="form-control label-8"
                                        placeholder="Masukan bobot kriteria">
                                </div>
                                <div class="col-md-2 c-mt10 d-flex align-items-end">
                                    <button class="btn btn-secondary" @click="removeKriteria(index)"
                                        v-if="form.kriteria.length > 1"><i class="fas fa-minus"></i></button>
                                </div>
                            </div>
                            <button class="btn btn-secondary" @click="addKriteria"><i class="fas fa-plus"></i> Tambah
                                Kriteria</button>
                            <div class="btn-posisi">
                                <button type="submit" class="btn btn-primary button-tabel-right">Tambah</button>
                                <button class="btn btn-danger button-tabel-left" @click="goBack()">Batal</button>
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
import { reactive } from 'vue'
import { useForm } from "@inertiajs/vue3";

const { name, username, settings } = defineProps(['name', 'username', 'settings']);

const props = {
    settings: {
        type: Array,
    },
};

console.log(name); // Contoh penggunaan di dalam script setup
console.log(username);

const form = useForm({
    kriteria: [{ name_kriteria: '' }],
});

const addKriteria = () => {
    // Get the ID from the first criteria
    const id = form.kriteria.length > 0 ? form.kriteria[0].id : null;
    // Add new criteria with the same ID
    form.kriteria.push({ id, name_kriteria: '' });
};

const removeKriteria = (index) => {
    form.kriteria.splice(index, 1);
};

const submit = () => {
    form.post(route("kriteria.store"), {
        preserveScroll: true,
    });
};

const goBack = () => {
    window.history.back();
};
</script>