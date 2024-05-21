<template>
  <div class="wrapper">
    <!-- Header -->
    <header>
      <div class="c-topbar">
        <nav class="navbar navbar-expand">
          <!-- Navbar -->
          <div class="navbar-tambah">
            <div class="navbar-left">
              <img src="/bootstrap/images/logo.png" alt="Logo">
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
    <!-- Page wrapper -->
    <div class="page-wrapper-new">
      <div class="page-content">
        <div class="card">
          <div class="card-body">
            <h4 class="mb-0">Tambah Lomba</h4>
            <hr/>
            <form @submit.prevent="submit"  enctype="multipart/form-data">
              <div class="row">
                <div class="col-md-6 c-mb10">
                  <label class="c-mb5-black" for="name_lomba"><b>Nama Lomba</b></label>
                  <input type="text" id="name_lomba" v-model="form.name_lomba">
                </div>
                <div class="col-md-6">
                  <label class="c-mb5-black" for="pj"><b>Nama PJ</b></label>
                  <input type="text" id="pj" v-model="form.pj">
                </div>
                <div class="col-md-6">
                  <label class="c-mb5-black" for="description"><b>Deskripsi</b></label>
                  <div class="col-12">
                    <textarea class="form-control c-mb10" id="description" rows="4" v-model="form.description"></textarea>  
                  </div>
                  <div>
                    <label for="picture" class="form-label judul-form"><b>Gambar</b></label>
                    <input type="file" name="picture" v-on:change="handlePictureUpload">
                    <p class="keterangan-foto">Ukuran 500 x 500</p>
                  </div>
                  <div>
                    <label for="sertifikat" class="form-label judul-form"><b>Sertifikat</b></label>
                    <input type="file" name="sertifikat" v-on:change="handleSertifikatUpload">
                  </div>
                </div>
                <div class="col-md-6">
                  <label class="c-mb5-black" for="kontak"><b>Kontak PJ (+62)</b></label>
                  <input type="number" class="form-control label-8" id="kontak" v-model="form.kontak">     
                  <div>
                    <label class="c-mb5-black" for="tempat"><b>Tempat</b></label>
                    <input type="text" class="form-control" id="tempat" v-model="form.tempat">
                  </div>
                  <div class="c-mt10">
                    <label class="c-mb5-black" for="biaya_pendaftaran"><b>Biaya Pendaftaran</b></label>
                    <input type="number" class="form-control label-8" id="biaya_pendaftaran" v-model="form.biaya_pendaftaran">
                  </div>   
                  <div> 
                  <label class="role-add"><b class="warna-hitam">Kriteria Lomba</b></label>
                  <div>   
            <div class="form-check" v-for="kriteria in kriteriaz.data" :key="kriteria.id">
               <input class="form-check-input" type="checkbox" :id="'kriteria' + kriteria.id" v-model="form.selectedCriteria" :value="kriteria.id">
              <label class="form-check-label" :for="'kriteria' + kriteria.id">{{ kriteria.name_kriteria }}</label>
                 </div>
              </div>
             </div>           
                </div>   
              </div>
              <div class="btn-posisi">
                <button type="submit" class="btn btn-primary button-tabel-right" >Tambah</button>
                <a class="btn btn-danger button-tabel-left" :href="route('lomba.index')">Batal</a>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <!-- End page wrapper -->
  </div>
</template>

<script setup>
import { defineProps } from "vue";
import { reactive } from 'vue'
import { router } from '@inertiajs/vue3'


const form = reactive({
  name_lomba: '',
  description: '',
  sertifikat: null,
  picture: null,
  pj: '',
  kontak: '',
  tempat: '',
  biaya_pendaftaran: '',
  selectedCriteria: [],
});

const { name, username, kriteriaz } = defineProps(['name', 'username', 'kriteriaz']);



// Definisikan properti yang diterima oleh komponen
const props = {
  kriteriaz: {
      type: Array,
      default: () => [],
  },
};
// const form = useForm({
//     kriteria: [{ name_kriteria: '' }],
// });
const handleSertifikatUpload = (event) => {
  form.sertifikat = event.target.files[0];
};

const handlePictureUpload = (event) => {
  form.picture = event.target.files[0];
};

function submit() {
// Menambahkan properti selectedCriteria ke dalam data yang disubmit
const formData = { ...form, selectedCriteria: form.selectedCriteria };
router.post('/lomba', formData);
}


</script>