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
                  alt="Logo" style="width: 100px; margin-left: -15px;">
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
                  <p v-if="linkError" class="text-danger">Link Invalid!</p>
                </div>
                <div>
                  <label for="formFile" class="form-label jarak-teks12"><b>File</b></label>
                  <input class="form-control" type="file" name="file" @change="handleFileChange">
                  <p v-if="fileError" class="text-danger">File melebihi batas max!</p>
                </div>
                <p class="keterangan-foto f-italic">Max file size: 20MB</p>
                <p class="keterangan-foto f-italic">Format: zip</p>
                <div>
                  <label for="formFile" class="form-label jarak-teks12"><b>Surat</b></label>
                  <input class="form-control" type="file" name="file" @change="handleSuratChange">
                  <p v-if="suratError" class="text-danger">Surat melebihi batas max!</p>
                </div>
                <p class="keterangan-foto f-italic">Max file size: 10MB</p>
                <p class="keterangan-foto f-italic">Format: .pdf</p>
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
    <!--end page wrapper -->
  </div>
</template>
<script setup>
import { defineProps } from "vue";
import { reactive, onMounted, ref } from 'vue';
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

const linkError = ref(false);
const fileError = ref(false);
const suratError = ref(false);

// Destructure props
const { name, username, tim, submissions, settings, logo1 } = defineProps(['name', 'username', 'tim', 'submissions', 'settings', 'logo1']);

const props = {
  settings: {
    type: Object, // Menggunakan "type" untuk menentukan tipe data props
    default: () => ({}), // Menggunakan "default" jika props tidak diberikan
  },
  logo1: {
    type: String, // Menentukan tipe data logo sebagai String
  },
};

// Populate form with existing submission data if available
onMounted(() => {
  if (submissions) {
    form.title = submissions.title;
    form.description = submissions.description;
    form.link = submissions.link;
  }
});

function isValidLink(link) {
  // Basic regex for URL validation
  const pattern = new RegExp('^(https?:\\/\\/)?'+ // protocol
    '((([a-z\\d]([a-z\\d-]*[a-z\\d])*)\\.?)+[a-z]{2,}|'+ // domain name
    '((\\d{1,3}\\.){3}\\d{1,3}))'+ // OR ip (v4) address
    '(\\:\\d+)?(\\/[-a-z\\d%_.~+]*)*'+ // port and path
    '(\\?[;&a-z\\d%_.~+=-]*)?'+ // query string
    '(\\#[-a-z\\d_]*)?$','i'); // fragment locator
  return !!pattern.test(link);
}

function handleFileChange(e) {
  const file = e.target.files[0];
  if (file && file.size > 20 * 1024 * 1024) {
    fileError.value = true;
    form.file = null;
  } else {
    fileError.value = false;
    form.file = file;
  }
}

function handleSuratChange(e) {
  const file = e.target.files[0];
  if (file && file.size > 10 * 1024 * 1024) {
    suratError.value = true;
    form.surat = null;
  } else {
    suratError.value = false;
    form.surat = file;
  }
}

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

  // Validate the link
  if (!isValidLink(form.link)) {
    linkError.value = true;
    return;
  } else {
    linkError.value = false;
  }

  // Validate file sizes
  if (form.file && form.file.size > 20 * 1024 * 1024) {
    fileError.value = true;
    return;
  } else {
    fileError.value = false;
  }

  if (form.surat && form.surat.size > 10 * 1024 * 1024) {
    suratError.value = true;
    return;
  } else {
    suratError.value = false;
  }

  // Menampilkan konfirmasi sebelum menyimpan data
  Swal.fire({
    title: 'Apakah Anda yakin?',
    text: 'Silakan cek terlebih dahulu!',
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
