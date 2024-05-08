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
                                <img src="/bootstrap/images/logo.png" alt="Logo">
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
                                <p class="user-name mb-0">Habib Shohiburrotib</p>
                                <p class="user-role">habib</p>
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
                    <form @submit.prevent="submit" >
                    <div class="card-body">
                        <h4 class="mb-0">Edit Kriteria Lomba</h4>
                        <hr />
                        <div class="row">
                            <div class=" c-mb10">
                                <label class="c-mb5-black"><b>Nama Kriteria</b></label>
                                <input type="text" id="name_kriteria" class="form-control" v-model="form.name_kriteria">
                            </div>
                        </div>
                        <div class="btn-posisi">
                            <button class="btn btn-primary button-tabel-right"
                               type="submit">Simpan</button>
                               <a 
                                    class="btn btn-danger button-tabel-left"
                                    :href="route('kriteria.index')"
                                >
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

<script setup>

import { useForm } from "@inertiajs/vue3";
import { usePage } from "@inertiajs/vue3";
import { router } from "@inertiajs/vue3";

const kriteria = usePage().props.kriterias;
// const props = defineProps({
//     errors: Object,
//     sponsor: Object,
// });
const form = useForm({
   name_kriteria: kriteria.data.name_kriteria,

});


function submit() {
   router.post(`/superadmin/kriteria/${kriteria.data.id }`, {
       _method: 'put',
       name_kriteria: form.name_kriteria,


    })
 }
</script>