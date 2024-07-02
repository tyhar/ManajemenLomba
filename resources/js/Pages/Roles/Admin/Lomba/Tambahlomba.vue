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
            <h4 class="mb-0">TAMBAH LOMBA</h4>
            <hr />
            <form @submit.prevent="submit" enctype="multipart/form-data">
              <div class="row">
                <div class="col-md-6 c-mb10">
                  <label class="c-mb5-black" for="name_lomba"><b>Nama Lomba</b></label>
                  <input type="text" class="form-control" id="name_lomba" placeholder="Masukan nama lomba"
                    v-model="form.name_lomba" required>
                </div>
                <div class="col-md-6">
                  <label class="c-mb5-black" for="pj"><b>Nama PJ</b></label>
                  <input type="text" class="form-control" id="pj" placeholder="Masukan nama PJ" v-model="form.pj"
                    required>
                </div>
                <div class="col-md-6">
                  <label class="c-mb5-black" for="descriptionaddl"><b>Deskripsi</b></label>
                  <div class="col-12">
                    <textarea class="c-mb10" id="descriptionaddl" placeholder="Masukan deskripsi lomba" rows="4"
                      v-model="form.description" required></textarea>
                  </div>
                  <div>
                    <label for="picture" class="form-label judul-form"><b>Gambar</b></label>
                    <input class="form-control" type="file" name="picture" @change="handlePictureUpload">
                    <p class="keterangan-foto f-italic">Max file size: 2MB (500 x 500 px)</p>
                    <p class="keterangan-foto f-italic">Format: .jpg, .png, .jpeg</p>
                    <p v-if="errors.picture" class="text-danger">{{ errors.picture }}</p>
                  </div>
                  <br>
                  <div>
                    <label for="sertifikat" class="form-label judul-form"><b>Sertifikat</b></label>
                    <input class="form-control" type="file" name="sertifikat" @change="handleSertifikatUpload">
                    <p class="keterangan-foto f-italic">Max file size: 2MB</p>
                    <p class="keterangan-foto f-italic">Format: .pdf</p>
                    <p v-if="errors.sertifikat" class="text-danger">{{ errors.sertifikat }}</p>
                  </div>
                </div>
                <div class="col-md-6">
                  <label class="c-mb5-black" for="kontak"><b>Kontak PJ (+62)</b></label>
                  <input type="number" class="form-control label-8" id="kontak" placeholder="Masukan kontak PJ"
                    v-model="form.kontak" required>
                  <div>
                    <label class="c-mb5-black" for="tempat"><b>Tempat</b></label>
                    <input type="text" class="form-control" id="tempat" placeholder="Masukan nama tempat"
                      v-model="form.tempat" required>
                  </div>
                  <div class="c-mt10">
                    <label class="c-mb5-black" for="biaya_pendaftaran"><b>Biaya Pendaftaran</b></label>
                    <input type="number" class="form-control label-8" placeholder="Masukan biaya pendaftaran"
                      id="biaya_pendaftaran" v-model="form.biaya_pendaftaran" required>
                  </div>
                  <div>
                    <label class="role-add"><b class="warna-hitam">Kriteria Penilaian</b></label>
                    <div>
                      <div class="form-check" v-for="kriteria in kriteriaz.data" :key="kriteria.id">
                        <input class="form-check-input" type="checkbox" :id="'kriteria' + kriteria.id"
                          v-model="form.selectedCriteria" :value="kriteria.id">
                        <label class="form-check-label" :for="'kriteria' + kriteria.id">{{ kriteria.name_kriteria }}
                        </label>
                        <!-- Input for bobot value for each kriteria -->
                        <input type="number" class="form-control" placeholder="Masukan bobot nilai"
                          :readonly="!isKriteriaSelected(kriteria.id)" v-model="form.bobot[kriteria.id]">
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="btn-posisi">
                <a class="btn btn-danger button-left" :href="route('lomba.index')">Batal</a>
                <button type="submit" class="btn btn-primary button-right">Tambah</button>
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
import { reactive } from 'vue';
import { router } from '@inertiajs/vue3';
import Swal from 'sweetalert2'; // Import SweetAlert

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
  bobot: {} // Object to store bobot values for each kriteria
});

const { name, username, kriteriaz, settings, logo1 } = defineProps(['name', 'username', 'kriteriaz', 'settings', 'logo1']);

const props = {
  kriteriaz: {
    type: Array,
    default: () => [],
  },
  settings: {
    type: Object, // Menggunakan "type" untuk menentukan tipe data props
    default: () => ({}), // Menggunakan "default" jika props tidak diberikan
  },
  logo1: {
    type: String, // Menentukan tipe data logo sebagai String
  },
};

const errors = reactive({
  sertifikat: '',
  picture: ''
});

const handleSertifikatUpload = (event) => {
  const file = event.target.files[0];
  const fileType = file.type;
  const fileSize = file.size;

  if (fileType !== 'application/pdf') {
    errors.sertifikat = 'File harus pdf!';
    form.sertifikat = null;
  } else if (fileSize > 2 * 1024 * 1024) { // 2MB in bytes
    errors.sertifikat = 'Sertifikat max 2MB!';
    form.sertifikat = null;
  } else {
    errors.sertifikat = '';
    form.sertifikat = file;
  }
};

const handlePictureUpload = (event) => {
  const file = event.target.files[0];
  const fileType = file.type;
  const fileSize = file.size;
  const validImageTypes = ['image/jpeg', 'image/png', 'image/jpg'];

  if (!validImageTypes.includes(fileType)) {
    errors.picture = 'File harus jpg, png, dan jpeg!';
    form.picture = null;
  } else if (fileSize > 2 * 1024 * 1024) { // 2MB in bytes
    errors.picture = 'Max file size: 2MB!';
    form.picture = null;
  } else {
    errors.picture = '';
    form.picture = file;
  }
};

// Computed property to check if a kriteria is selected
const isKriteriaSelected = (kriteriaId) => {
  return form.selectedCriteria.includes(kriteriaId);
};

function submit() {
  // Calculate the total bobot
  const totalBobot = form.selectedCriteria.reduce((acc, id) => {
    return acc + (parseInt(form.bobot[id]) || 0);
  }, 0);

  // Check if the total bobot is 100
  if (totalBobot !== 100) {
    Swal.fire({
      icon: 'error',
      title: 'Oops...',
      text: 'Maaf, bobot yang Anda inputkan belum 100%',
    });
    return;
  }

  const formData = new FormData();
  formData.append('name_lomba', form.name_lomba);
  formData.append('description', form.description);
  formData.append('pj', form.pj);
  formData.append('kontak', form.kontak);
  formData.append('tempat', form.tempat);
  formData.append('biaya_pendaftaran', form.biaya_pendaftaran);
  formData.append('sertifikat', form.sertifikat);
  formData.append('picture', form.picture);

  form.selectedCriteria.forEach(id => {
    formData.append('selectedCriteria[]', id);
    formData.append(`bobot[${id}]`, form.bobot[id]);
  });

  router.post('/lomba', formData, {
    headers: {
      'Content-Type': 'multipart/form-data'
    }
  });
}
</script>
