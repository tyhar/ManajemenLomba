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
                <img src="/bootstrap/images/lg.png" alt="Logo" style="width: 100px; margin-left: -15px;">
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
          <div class="card-body" v-if="tim">
            <h4 class="mb-0">PENGUMPULAN KARYA {{ tim?.lomba?.name_lomba }}</h4>
            <hr />
            <form @submit.prevent="submit" enctype="multipart/form-data">
              <div class="row">
                <div>
                  <label class="jarak-input"><b>Judul</b></label>
                  <input v-model="form.title" type="text" class="form-control" placeholder="Masukan judul karya"
                    required>
                </div>
                <div>
                  <label class="jarak-input"><b>Deskripsi</b></label>
                  <div class="col-12">
                    <textarea class="c-mb10" id="descriptionaddl" rows="4" v-model="form.description"
                      placeholder="Masukan deskripsi karya" required></textarea>
                  </div>
                </div>
                <div>
                  <label class="jarak-input"><b>Link</b></label>
                  <input v-model="form.link" type="text" class="form-control" placeholder="Masukan link karya" required>
                </div>
                <div>
                  <label for="formFile" class="form-label jarak-teks12"><b>File</b></label>
                  <input class="form-control" type="file" name="file" @change="e => form.file = e.target.files[0]">
                </div>
                <p class="keterangan-foto f-italic">Max file size: 20MB</p>
                <p class="keterangan-foto f-italic">Format: .pdf</p>
                <div>
                  <label for="formFile" class="form-label jarak-teks12"><b>Surat</b></label>
                  <input class="form-control" type="file" name="file" @change="e => form.surat = e.target.files[0]">
                </div>
                <p class="keterangan-foto f-italic">Max file size: 10MB</p>
                <p class="keterangan-foto f-italic">Format: .pdf</p>
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
import { defineProps } from "vue";
import { reactive, onMounted } from 'vue';
import { router } from '@inertiajs/vue3';
import Swal from 'sweetalert2';

// Reactive form object
const form = reactive({
  title: '',
  description: '',
  link: '',
  file: null,
  surat: null,
});

// Destructure props
const { name, username, tim, submissions } = defineProps(['name', 'username', 'tim', 'submissions']);

// Populate form with existing submission data if available
onMounted(() => {
  if (submissions) {
    form.title = submissions.title;
    form.description = submissions.description;
    form.link = submissions.link;
  }
});

function submit() {
  // Periksa apakah `form` dan `tim` tidak null/undefined
  if (!form || !tim) {
    console.error('Form atau tim tidak tersedia.');
    Swal.fire({
      icon: 'error',
      title: 'Oops...',
      text: 'Form atau tim tidak tersedia. Silakan coba lagi!',
    });
    return;
  }

  // Menampilkan konfirmasi sebelum menyimpan data
  Swal.fire({
    title: 'Apakah Anda yakin?',
    text: 'Apakah Anda yakin akan mengumpulkan hasil karya lomba? Silakan cek terlebih dahulu! Data yang disimpan tidak dapat diubah!',
    icon: 'warning',
    showCancelButton: true,
    confirmButtonText: 'Ya, Simpan!',
    cancelButtonText: 'Batal',
  }).then((result) => {
    if (result.isConfirmed) {
      // Create FormData object to handle file uploads
      const formData = new FormData();
      formData.append('title', form.title || '');
      formData.append('description', form.description || '');
      formData.append('link', form.link || '');

      if (form.file) {
        formData.append('file', form.file);
      }
      if (form.surat) {
        formData.append('surat', form.surat);
      }

      const url = submissions ? `/submissions/${tim.id}/update` : `/submissions/${tim.id}`;

      // Send form data using axios post method
      axios.post(url, formData, {
        headers: {
          'Content-Type': 'multipart/form-data',
        },
      }).then((response) => {
        // Show success alert if submission is successful
        Swal.fire({
          icon: 'success',
          title: 'Selamat!',
          text: 'Anda telah berhasil menyimpan hasil karya!',
        }).then(() => {
          // Redirect to dashboard
          window.location.href = `/daftarlomba/${tim?.lomba?.id}`;
        });
      })
        .catch((error) => {
          // Handle error and show error alert
          console.error('Error submitting form:', error);
          Swal.fire({
            icon: 'warning',
            title: 'Terjadi kesalahan',
            text: 'Terjadi kesalahan saat menyimpan hasil karya!',
          });
        });
    }
  });
}

// Go back to the previous page
const goBack = () => {
  window.history.back();
};
</script>
