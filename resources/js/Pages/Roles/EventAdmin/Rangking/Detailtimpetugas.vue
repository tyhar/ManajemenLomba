<script setup>
import { ref, onMounted } from 'vue';
import { useForm } from '@inertiajs/vue3';

const { userData, members, team, submissions, reg_lombas, lomba, kriterias, value, settings, logo1 } = defineProps(['userData', 'members', 'team', 'submissions', 'reg_lombas', 'lomba', 'kriterias', 'value', 'settings', 'logo1']);



const props = {
  settings: {
    type: Object, // Menggunakan "type" untuk menentukan tipe data props
    default: () => ({}), // Menggunakan "default" jika props tidak diberikan
  },
  logo1: {
    type: String, // Menentukan tipe data logo sebagai String
  },
};

const form = useForm({
  value_count: {},
});

const errors = ref([]);

onMounted(() => {
  kriterias.forEach(kriteria => {
    form.value_count[kriteria.id] = value.find(v => v.kriteria_lomba_id === kriteria.id)?.value_count || '';
  });
});
</script>

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
                  alt="Logo" style="width: 135px; margin-left: -15px;">
              </a>
            </div>
          </div>
          <!-- Search bar -->
          <div class="search-bar flex-grow-1"></div>
          <!-- Top menu -->
          <div class="top-menu ms-auto">
            <ul class="navbar-nav align-items-center">
              <div class="user-info ps-3">
                <p class="user-name mb-0">{{ userData.name }}</p>
                <p class="user-role">{{ userData.username }}</p>
              </div>
              <div class="parent-icon posisi-icon"><i class="bx bx-user-circle c-font48"></i></div>
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
          <div class="card-body" v-if="team">
            <h4 class="mb-0">DETAIL TIM {{ team.name_team }} </h4>
            <hr />
            <div class="row">
              <div class="col-md-3 c-mb10" v-if="team">
                <label class="c-mb5-black"><b>INSTANSI</b></label>
                <div class="c-mb20">{{ team.instansi }}</div>
              </div>
              <div class="col-md-3" v-if="team">
                <label class="c-mb5-black"><b>KETUA</b></label>
                <div class="c-mb20">{{ team?.user?.name }}</div>
              </div>
              <div class="col-md-3" v-if="team">
                <label class="c-mb5-black"><b>EMAIL</b></label>
                <div class="c-mb20">{{ team.email }}</div>
              </div>
              <div class="col-md-3" v-if="team">
                <label class="c-mb5-black"><b>NO WHATSAPP</b></label>
                <div class="c-mb20">{{ team.phone }}</div>
              </div>
              <div class="col-md-2">
                <label class="c-mb5-black"><b>PEMBAYARAN</b></label>
                <div class="c-mb20"><a :href="`/datatimshow/${team.id}`">Lihat Bukti</a></div>
              </div>
            </div>
            <br><br><br>
            <div class="row row-cards justify-content-center">
              <div class="col-md-6 col-lg-3 crud-max-width260" v-for="member in members" :key="member.id">
                <div class="card">
                  <div class="card-header btn-crud">
                    <h6><b>{{ member.role }}</b></h6>
                  </div>
                  <div class="card-body p-4 text-center posisi-mb23">
                    <div class="btn-crud">
                      <img :src="member.photo ? `/storage/${member.photo}` : '/bootstrap/images/default2.png'"
                        height="120" alt="..." class="img-fluidc rounded">
                    </div>
                    <br>
                    <h6><b>{{ member.name }}</b></h6>
                    <br>
                    <div class="posisi-mb7">{{ member.nik }}</div>
                    <div class="text-muted">{{ member.instansi }}</div>
                  </div>
                </div>
              </div>
            </div>
            <div class="card card-height400">
              <div class="card-body p-4 text-center">
                <h6 class="sub-judul-tim"><b>KARYA TIM</b></h6>
                <hr />
                <div class="row">
                  <div class="col-md-4 label-left" v-if="submissions">
                    <label class="jarak-teks05"><b>JUDUL</b></label>
                    <div class="c-mb20">{{ submissions.title }}</div>
                  </div>
                  <div class="col-md-3 label-left" v-if="submissions">
                    <label class="jarak-teks05"><b>SURAT</b></label>
                    <div class="data-tim"><a :href="`/submissionsurat/${submissions.id}`">Dokumen.pdf</a></div>
                  </div>
                  <div class="col-md-3 label-left" v-if="submissions">
                    <label class="jarak-teks05"><b>FILE</b></label>
                    <div class="data-tim"><a :href="`/submissionshow/${submissions.id}`">Lihat File</a></div>
                  </div>
                  <div class="col-md-2 label-left" v-if="submissions">
                    <label class="jarak-teks05"><b>LINK KARYA</b></label>
                    <div class="data-tim c-mb-70"><a :href="submissions.link" target="_blank">Buka Link</a></div>
                  </div>
                  <div class="label-left">
                    <label class="jarak-teks05"><b>DESKRIPSI</b></label>
                    <div class="c-mb20 rata-tengah">{{ submissions.description }}</div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!--end page wrapper -->

    <h5 class="c-ml-160 jarak-top-kurang18 jarak-bottom-kurang13">HASIL PENILAIAN </h5>
    <div class="page-wrapper-report" v-if="reg_lombas">
      <div class="page-content">
        <div class="card">
          <div class="card-body">
            <h6 class="warna-abu">{{ reg_lombas?.lomba?.name_lomba }}</h6>
            <h6 class="c-mb20">{{ reg_lombas?.submission?.title }}</h6>
            <div class="card">
              <h5 class="p-3">Penilaian</h5>
              <div class="card-body p-4 text-center">
                <div class="row">
                  <table class="table table-bordered jarak-top-kurang25">
                    <thead class="table-dark">
                      <tr>
                        <th class="width-id">NO.</th>
                        <th class="crud-width-400 posisi-text">KRITERIA</th>
                        <th class="crud-width-40">BOBOT</th>
                        <th class="crud-width-40">NILAI</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="(kriteria, index) in kriterias" :key="kriteria.id">
                        <th>{{ index + 1 }}</th>
                        <td class="text-left">{{ kriteria?.kriteria?.name_kriteria }}</td>
                        <td class="text-center">{{ kriteria.bobot }} %</td>
                        <td class="text-center">{{ kriteria.value_count }}</td>
                      </tr>
                      <tr>
                        <th colspan="3" class="text-left">Total</th>
                        <td class="crud-width-40">{{ reg_lombas.value_total }}</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<style scoped>
/* DAFTAR LOMBA EDIT */
.crud-max-width260 {
  /* flex: 1 1 calc(25% - 1rem); */
  display: flex;
  flex-direction: column;
}

.card {
  display: flex;
  flex-direction: column;
  flex-grow: 1;
}
</style>
