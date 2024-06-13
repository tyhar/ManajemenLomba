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
                <img src="bootstrap/images/logo.png" alt="Logo">
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
          <div class="card-body">
            <h4 class="mb-0">BERI NILAI </h4>
            <hr />
            <form @submit.prevent="confirmSubmit">
              <div class="row" v-for="(kriteria, index) in kriterias" :key="kriteria.id">
                <div class="col-md-6 c-mb10">
                  <label class="c-mb5-black">
                    <b>{{ index + 1 }}. {{ kriteria?.kriteria_bobot?.kriteria?.name_kriteria }}</b>
                  </label>
                </div>
                <div class="col-md-6">
                  <label class="c-mb5-black">Nilai {{ kriteria?.kriteria_bobot?.bobot?.nilai_bobot }}%</label>
                  <input type="number" class="form-control c-mb20" :id="'value_count_' + kriteria.id"
                    v-model="form.value_count[kriteria.id]" />
                  <!-- Add hidden input to store kriteria_id -->
                  <input type="hidden" :name="'kriteria_lomba_bobot_id' + kriteria.id" :value="kriteria.id" />
                </div>
              </div>
              <div class="btn-posisi">
                <button type="submit" class="btn btn-primary button-tabel-right">Simpan</button>
                <button class="btn btn-danger button-tabel-left" @click="goBack">Batal</button>
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
import { ref, onMounted } from 'vue';
import { router } from '@inertiajs/vue3';
import { useForm } from '@inertiajs/vue3';
import Swal from 'sweetalert2';

const props = defineProps({
  userData: {
    type: Object,
    required: true,
  },
  kriterias: {
    type: Array,
    required: true,
  },
});

const form = useForm({
  value_count: {},
  user_id: props.userData.id
});

onMounted(() => {
  props.kriterias.forEach(kriteria => {
    form.value_count[kriteria.id] = '';
  });
});

const confirmSubmit = async () => {
  const result = await Swal.fire({
    title: 'Apakah anda akan menyimpan nilai?',
    showCancelButton: true,
    confirmButtonText: 'Ya, simpan',
    cancelButtonText: 'Batal',
  });

  if (result.isConfirmed) {
    submit();
  }
};

const submit = async () => {
  try {
    const formData = props.kriterias.map(kriteria => ({
      kriteria_lomba_bobot_id: kriteria.id,
      value_count: (form.value_count[kriteria.id] * kriteria.kriteria_bobot.bobot.nilai_bobot) / 100,
      reg_lomba_id: kriteria.kriteria_bobot.reg_lomba_id // Assuming 'reg_lomba_id' is available in 'kriteria_bobot'
    }));

    await router.post('/value', {
      data: formData,
      user_id: form.user_id,
    });

    Swal.fire({
      icon: 'success',
      title: 'Success!',
      text: 'Anda telah berhasil melakukan penilaian terhadap peserta lomba',
    }).then(() => {
      router.get('/lombajuri');
    });
  } catch (error) {
    Swal.fire({
      icon: 'error',
      title: 'Oops...',
      text: 'Terjadi kesalahan. Silakan coba lagi!',
    });
    console.error('An error occurred:', error);
  }
};

const goBack = () => {
  window.history.back();
};
</script>
