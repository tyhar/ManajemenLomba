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
        <div class="page-wrapper-new">
            <div class="page-content">
                <div class="card">
                    <div class="card-body">
                        <h4 class="mb-0">EDIT NILAI</h4>
                        <hr />
                        <form @submit.prevent="submit">
                            <div class="row" v-for="kriteria in kriterias" :key="kriteria.id">
                                <div class="col-md-6 c-mb10">
                                    <label class="c-mb5-black"><b>{{ kriteria.name_kriteria }}</b></label>
                                </div>
                                <div class="col-md-6">
                                    <label class="c-mb5-black">Nilai</label>
                                    <input type="text" class="form-control c-mb20" :id="'value_count_' + kriteria.id"
                                        v-model="form.value_count[kriteria.id]">
                                    <!-- Add hidden input to store kriteria_id -->
                                    <input type="hidden" :name="'kriteria_id_' + kriteria.id" :value="kriteria.id">
                                </div>
                            </div>
                            <div class="btn-posisi">
                                <button type="submit" class="btn btn-primary button-tabel-right">Simpan</button>
                                <button class="btn btn-danger button-tabel-left" @click="goBack()">Batal</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!--end page wrapper -->
    </div>
</template>

<script setup>
import { defineProps, ref, onMounted } from 'vue'
import { router } from '@inertiajs/vue3'

const props = defineProps(['kriterias', 'userValues']);

const form = ref({
    value_count: {}
});

onMounted(() => {
    // Initialize form values with userValues
    props.kriterias.forEach(kriteria => {
        form.value_count[kriteria.id] = props.userValues[kriteria.id] || '';
    });
});

const submit = () => {
    router.put('/update-value-count', form.value_count, {
        onSuccess: () => {
            router.visit('/lombajuri');
        }
    });
};

const goBack = () => {
    window.history.back();
};
</script>