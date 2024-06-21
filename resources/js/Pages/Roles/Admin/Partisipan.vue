<script setup>
import { Link, useForm } from "@inertiajs/vue3";
import { defineProps, ref, onMounted, computed } from 'vue';
import axios from 'axios';

const filterStatus = ref('Semua');

const props = defineProps({
  partisipans: {
    type: Object,
  },
  settings: {
    type: Object, // Menggunakan "type" untuk menentukan tipe data props
    default: () => ({}), // Menggunakan "default" jika props tidak diberikan
  },
  logo1: {
    type: String, // Menentukan tipe data logo sebagai String
  },
  unreadCount: {
    type: Object,
    required: true,
  },

});


const filteredPartisipans = computed(() => {
  if (filterStatus.value === 'Semua') {
    return props.partisipans.data;
  }
  return props.partisipans.data.filter(partisipan => {
    const isVerified = partisipan.email_verification_status.toLowerCase() === 'verified';
    return filterStatus.value === 'Verified' ? isVerified : !isVerified;
  });
});

</script>

<template>
  <!--wrapper-->
  <div class="wrapper">
    <!--sidebar wrapper -->
    <div class="sidebar-wrapper" data-simplebar="true">
      <div class="sidebar-header" v-for="setting in settings" :key="setting.id">
        <div>
          <a href="/">
            <img id="logo-img" :src="setting.logo1 ? `/storage/${setting.logo1}` : '/bootstrap/images/logo1default.jpg'"
              class="lg2">
          </a>
        </div>
        <div id="menu-toggle" class="toggle-icon ms-auto"><i class="fadeIn animated bx bx-menu"></i></div>
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
            <li class="jarak-dropdown"><a href="/lomba">Lomba</a></li>
            <li class="jarak-dropdown"><a href="/administrator">Administrator</a></li>
            <li class="jarak-dropdown"><a href="/sponsor">Sponsor</a></li>
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
            <div class="parent-icon"><i class="fadeIn animated bx bx-user-circle c-font25"></i></div>
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
            <div class="parent-icon"><i class="fadeIn animated bx bx-log-out"></i>
            </div>
            <div class="menu-title">
              <Link class="menu-title" :href="route('logout')" method="post" as="button">
              Keluar
              </Link>
            </div>
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
        <div class="ps-3">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
              <li class="breadcrumb-item"></li>
            </ol>
          </nav>
        </div>
        <div class="card">
          <div class="card-body">
            <h4 class="mb-0 jarak-top-kurang5">TABEL PARTISIPAN</h4>
            <hr class="c-mt10" />
            <a :href="route('export.partisipan')" class="btn btn-primary btn-float-right">Export Excel</a>
            <label class="jarak-filterstatus">Filter by Status</label>
            <select class="form-select2" v-model="filterStatus">
              <option selected>Semua</option>
              <option>Verified</option>
              <option>Unverified</option>
            </select>
            <br><br>
            <div class="table-responsive">
              <table id="example" class="table table-bordered">
                <thead class="table-dark">
                  <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Username</th>
                    <th>Instansi</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th class="crud-width100">Tanggal</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="partisipan in filteredPartisipans" :key="partisipan.id">
                    <td>{{ partisipan.id }}</td>
                    <td>{{ partisipan.name }}</td>
                    <td>{{ partisipan.username }}</td>
                    <td>{{ partisipan.instansi }}</td>
                    <td>{{ partisipan.email }}</td>
                    <td>{{ partisipan.email_verification_status }}</td>
                    <!-- <td>12 Juni 2024 => static</td> -->
                    <td>{{ partisipan.created_at }}</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <!--end row-->
      </div>
    </div>
    <!--end page wrapper -->
  </div>
  <!--end wrapper-->
</template>
