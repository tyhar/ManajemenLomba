<script setup>
import { Link, usePage } from '@inertiajs/vue3';
import { defineProps, onMounted } from 'vue';
import ApexCharts from 'apexcharts';

// Define the props that the component expects
const props = defineProps({
  user: {
    type: Object,
    required: true,
  },
  teamcount: {
    type: Object,
    required: true,
  },
  userstatus: {
    type: Object,
    required: true,
  },
  useradminis: {
    type: Object,
    required: true,
  },
  useradmin: {
    type: Object,
    required: true,
  },
  allCount: {
    type: Object,
    required: true,
  },
  unreadCount: {
    type: Object,
    required: true,
  },
  visitData: {
    type: Array,
    required: true,
  },
  allParticipants: {
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

// Function to render the chart
const renderChart = () => {
  new ApexCharts(document.getElementById('bi-weekly-visit'), {
    chart: {
      type: 'bar',
      fontFamily: 'inherit',
      height: 240,
      parentHeightOffset: 0,
      toolbar: {
        show: false,
      },
      animations: {
        enabled: false,
      },
      stacked: true,
    },
    plotOptions: {
      bar: {
        columnWidth: '60%',
      },
    },
    dataLabels: {
      enabled: false,
    },
    fill: {
      opacity: 1,
    },
    series: [
      {
        name: 'Jumlah Kunjungan',
        data: props.visitData.map(v => v.visit_count),
      },
    ],
    tooltip: {
      theme: 'dark',
    },
    grid: {
      padding: {
        top: -20,
        right: 0,
        left: -4,
        bottom: -4,
      },
      strokeDashArray: 4,
    },
    xaxis: {
      labels: {
        padding: 0,
      },
      tooltip: {
        enabled: false,
      },
      axisBorder: {
        show: false,
      },
      categories: props.visitData.map(v => v.visit_month),
    },
    yaxis: {
      labels: {
        padding: 4,
      },
    },
  }).render();
};

// Call the renderChart function when the component is mounted
onMounted(() => {
  renderChart();
});

// Cek apakah halaman sudah di-reload sebelumnya
if (!localStorage.getItem('reloaded')) {
  // Jika belum, set flag dan reload halaman setelah 1 detik
  setTimeout(() => {
    localStorage.setItem('reloaded', 'true');
    location.reload();
  }, 1000);
} else {
  // Jika sudah, hapus flag agar reload hanya terjadi sekali
  localStorage.removeItem('reloaded');
}
</script>

<template>
  <!--wrapper-->
  <div class="wrapper">
    <!--sidebar wrapper -->
    <div class="sidebar-wrapper" data-simplebar="true">
      <div class="sidebar-header">
        <div v-for="setting in settings" :key="setting.id">
          <a href="/">
            <img id="logo-img" :src="setting.logo1 ? `/storage/${setting.logo1}` : '/bootstrap/images/logo1default.jpg'"
              class="lg2">
          </a>
        </div>
        <div class="toggle-icon ms-auto"><i class="fadeIn animated bx bx-menu"></i></div>
      </div>
      <!--navigation-->
      <ul class="metismenu" id="menu">
        <li>
          <a :href="route('admin')">
            <div class="parent-icon"><i class='bx bx-home-circle'></i></div>
            <div class="menu-title">Dashboard</div>
          </a>
        </li>
        <li>
          <a href="javascript:;" class="has-arrow">
            <div class="parent-icon"><i class="fadeIn animated bx bx-plus-circle"></i></div>
            <div class="menu-title">Event</div>
          </a>
          <ul>
            <li class="jarak-dropdown"><a :href="route('lomba.index')">Lomba</a></li>
            <li class="jarak-dropdown"><a href="/administrator">Administrator</a></li>
            <li class="jarak-dropdown"><a :href="route('sponsor.index')">Sponsor</a></li>
            <li class="jarak-dropdown"><a href="/berita">Berita</a></li>
            <li class="jarak-dropdown"><a href="/setting">Setting</a></li>
          </ul>
        </li>
        <li>
          <a href="/tim">
            <div class="parent-icon"><i class="fadeIn animated lni lni-users"></i></div>
            <div class="menu-title">Tim</div>
          </a>
        </li>
        <li>
          <a href="/partisipan">
            <div class="parent-icon"><i class="fadeIn animated bx bx-street-view"></i></div>
            <div class="menu-title">Partisipan</div>
          </a>
        </li>
        <li>
          <a href="/pesan">
            <div class="parent-icon"><i class="fadeIn animated bx bx-comment-detail"></i></div>
            <div class="menu-title">Pesan <span class="alert-count">{{ unreadCount }}</span></div>
          </a>
        </li>
        <li>
          <a href="/rangking">
            <div class="parent-icon"><i class="fadeIn animated bx bx-trophy"></i></div>
            <div class="menu-title">Rangking</div>
          </a>
        </li>
        <li>
          <a>
            <div class="parent-icon"><i class="fadeIn animated bx bx-log-out"></i></div>
            <Link class="menu-title" :href="route('logout')" method="post" as="button">
            Keluar
            </Link>
          </a>
        </li>
      </ul>
      <!--end navigation-->
    </div>
    <!--end sidebar wrapper -->

    <!--start header -->
    <header>
      <div class="topbar d-flex align-items-center">
        <nav class="navbar navbar-expand">
          <div class="mobile-toggle-menu"><i class='bx bx-menu'></i></div>
          <div class="search-bar flex-grow-1"></div>
          <div class="top-menu ms-auto">
            <ul class="navbar-nav align-items-center">
              <div class="user-info ps-3">
                <p class="user-name mb-0">{{ $page.props.userData.name }}</p>
                <p class="user-role">{{ $page.props.userData.username }}</p>
              </div>
              <div class="parent-icon posisi-icon"><i class="bx bx-user-circle c-font48"></i></div>
              <li class="nav-item dropdown dropdown-large">
                <div class="dropdown-menu dropdown-menu-end">
                  <div class="header-notifications-list"></div>
                </div>
              </li>
              <li class="nav-item dropdown dropdown-large">
                <div class="dropdown-menu dropdown-menu-end">
                  <div class="header-message-list"></div>
                </div>
              </li>
            </ul>
          </div>
        </nav>
      </div>
    </header>
    <!--end header -->

    <!--start page wrapper -->
    <div class="page-wrapper">
      <div class="page-content">
        <div class="row row-cols-1 row-cols-md-2 row-cols-xl-4">
          <div class="col">
            <div class="card radius-10 border-start border-0 border-3 border-info">
              <div class="card-body">
                <div class="d-flex align-items-center">
                  <div>
                    <h6 class="mb-0"><b>{{ allParticipants }} Partisipan</b></h6>
                    <br>
                    <p class="mb-0 font-13">{{ userstatus }} Verified</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col">
            <div class="card radius-10 border-start border-0 border-3 border-success">
              <div class="card-body">
                <div class="d-flex align-items-center">
                  <div>
                    <h6 class="mb-0"><b>{{ teamcount }} Tim</b></h6>
                    <br>
                    <p class="mb-0 font-13">Semua Lomba</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col">
            <div class="card radius-10 border-start border-0 border-3 border-danger">
              <div class="card-body">
                <div class="d-flex align-items-center">
                  <div>
                    <h6 class="mb-0"><b>{{ allCount }} Pesan</b></h6>
                    <br>
                    <p class="mb-0 font-13">{{ unreadCount }} Pesan Belum di Buka</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col">
            <div class="card radius-10 border-start border-0 border-3 border-warning">
              <div class="card-body">
                <div class="d-flex align-items-center">
                  <div>
                    <h6 class="mb-0 cfs-15"><b>{{ useradminis }} Akun Administrator</b></h6>
                    <br>
                    <p class="mb-0 font-13">{{ useradmin }} Akun Admin</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="card">
          <div class="card-body">
            <h3 class="card-title btn-crud"><b>Jumlah Pengunjung Setiap Bulan</b></h3>
            <br><br>
            <div id="bi-weekly-visit" class="chart-lg"></div>
          </div>
        </div>
        <!--end row-->
      </div>
    </div>
  </div>
</template>
