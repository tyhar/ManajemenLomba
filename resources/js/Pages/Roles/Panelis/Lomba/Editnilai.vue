<template>
  <div class="wrapper">
    <header>
      <div class="c-topbar">
        <nav class="navbar navbar-expand">
          <div class="navbar-tambah">
            <div class="navbar-left" v-for="setting in settings" :key="setting.id">
              <a href="/">
                <img :src="setting.logo1 ? `/storage/${setting.logo1}` : '/bootstrap/images/logo1default.jpg'"
                  alt="Logo" style="width: 100px; margin-left: -15px;">
              </a>
            </div>
          </div>
          <div class="search-bar flex-grow-1"></div>
          <div class="top-menu ms-auto">
            <ul class="navbar-nav align-items-center">
              <div class="user-info ps-3">
                <p class="user-name mb-0">{{ $page.props.userData.name }}</p>
                <p class="user-role">{{ $page.props.userData.username }}</p>
              </div>
              <div class="parent-icon posisi-icon">
                <i class="bx bx-user-circle c-font48"></i>
              </div>
            </ul>
          </div>
        </nav>
      </div>
    </header>

    <div class="page-wrapper-new">
      <div class="page-content">
        <div class="card">
          <div class="card-body" v-if="reg_lombas">
            <h4 class="mb-0">Edit Nilai Tim {{ reg_lombas.team.name_team }}</h4>
            <hr />
            <form @submit.prevent="confirmSubmit">
              <div class="row" v-for="(kriteria, index) in kriterias" :key="kriteria.id">
                <div class="col-md-6 c-mb10">
                  <label class="c-mb5-black">
                    <b>{{ index + 1 }}. {{ kriteria?.kriteria?.name_kriteria }}</b>
                  </label>
                </div>
                <div class="col-md-6">
                  <label class="c-mb5-black">Nilai {{ kriteria.bobot }} %</label>
                  <input type="number" class="form-control c-mb20" :id="'value_count_' + kriteria.id"
                    v-model="form.value_count[kriteria.id]" />
                  <input type="hidden" :name="'kriteria_lomba_id_' + kriteria.id" :value="kriteria.id" />
                  <!-- Error message for bobot -->
                  <div v-if="bobotErrors[kriteria.id]" class="text-danger">{{ bobotErrors[kriteria.id] }}</div>
                </div>
              </div>
              <div v-if="errors.length" class="alert alert-danger">
                <ul>
                  <li v-for="(error, index) in errors" :key="index">{{ error }}</li>
                </ul>
              </div>
              <div class="btn-posisi">
                <button type="button" class="btn btn-danger button-left" @click="goBack">Batal</button>
                <button type="submit" class="btn btn-primary button-right">Update</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
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
  value: {
    type: Object,
    required: true,
  },
  kriterias: {
    type: Array,
    required: true,
  },
  reg_lombas: {
    type: Object,
    required: true,
  },
  settings: {
    type: Object,
    default: () => ({}),
  },
  logo1: {
    type: String,
  },
});

const form = useForm({
  value_count: {},
});

const errors = ref([]);
const bobotErrors = ref({});

onMounted(() => {
  props.kriterias.forEach(kriteria => {
    const initialValue = props.value.find(v => v.kriteria_lomba_id === kriteria.id)?.value_count;
    if (initialValue !== undefined) {
      form.value_count[kriteria.id] = (initialValue * 100) / kriteria.bobot;
    }
  });
});

const confirmSubmit = async () => {
  let valid = true;
  bobotErrors.value = {};

  // Validate bobot values
  props.kriterias.forEach(kriteria => {
    if (form.value_count[kriteria.id] > 100) {
      bobotErrors.value[kriteria.id] = 'Maksimal 100!';
      valid = false;
    }
  });

  if (!valid) {
    return;
  }

  const result = await Swal.fire({
    title: 'Apakah anda akan menyimpan perubahan?',
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
      kriteria_lomba_id: kriteria.id,
      value_count: (form.value_count[kriteria.id] * kriteria.bobot) / 100,
      reg_lomba_id: props.reg_lombas.id,
    }));

    await router.put(`/value/${props.value.id}`, {
      data: formData,
    });

    Swal.fire({
      icon: 'success',
      title: 'Success!',
      text: 'Anda telah berhasil mengupdate nilai peserta lomba',
    }).then(() => {
      router.get('/lombajuri');
    });
  } catch (error) {
    if (error.response && error.response.data.errors) {
      errors.value = Object.values(error.response.data.errors).flat();
    } else {
      Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: 'Terjadi kesalahan. Silakan coba lagi!',
      });
      console.error('An error occurred:', error);
    }
  }
};

const goBack = () => {
  window.history.back();
};
</script>
