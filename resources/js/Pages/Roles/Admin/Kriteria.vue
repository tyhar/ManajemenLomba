<template>
    <!--wrapper-->
    <div class="wrapper">
          <!--sidebar wrapper -->
          <div class="sidebar-wrapper" data-simplebar="true">
              <div class="sidebar-header">
                  <div>
                      <a href="/">
                          <img src="/bootstrap/images/logocb.png" class="logo-icon" alt="logo icon" >
                      </a>
                  </div>
                  <div class="toggle-icon ms-auto"><i class="fadeIn animated bx bx-menu"></i>
                  </div>
              </div>
              <!--navigation-->
              <ul class="metismenu" id="menu">
                  <li>
                      <a :href="route('admin')">
                          <div class="parent-icon"><i class='bx bx-home-circle'></i>
                          </div>
                          <div class="menu-title">Dashboard</div>
                      </a>
                      </li>
                      <li>
                      <a href="javascript:;" class="has-arrow">
                          <div class="parent-icon"><i class="fadeIn animated bx bx-plus-circle"></i>
                          </div>
                          <div class="menu-title">Event</div>
                      </a>
                      <ul>
                          <li class="jarak-dropdown"> <a :href="route('lomba.index')">Lomba</a>
                          </li>
                          <li class="jarak-dropdown"> <a href="/administrator">Administrator</a>
                          </li>
                          <li class="jarak-dropdown"> <a href="/tim">Tim</a>
                          </li>
                          <li class="jarak-dropdown"> <a href="/sponsor">Sponsor</a>
                          </li>
                          <li class="jarak-dropdown"> <a href="/berita">Berita</a>
                          </li>
                          <li class="jarak-dropdown"> <a  :href="route('setting.index')">Setting</a>
                          </li>
                      </ul>
                  </li>
                  <li>
                  <a href="/partisipan">
                      <div class="parent-icon"><i class="fadeIn animated bx bx-street-view"></i>
                      </div>
                      <div class="menu-title">Partisipan</div>
                  </a>
                  </li>
                  <li>
                    <a href="/pesan">
            <div class="parent-icon"><i class="fadeIn animated bx bx-comment-detail"></i></div>
            <!-- Menampilkan jumlah pesan yang belum dibaca -->
            <div class="menu-title">Pesan <span class="alert-count">{{ unreadCount }}</span></div>
          </a>
                  </li>
                  <li>
                      <a href="/rangking">
                          <div class="parent-icon"><i class="fadeIn animated bx bx-trophy"></i>
                          </div>
                          <div class="menu-title">Rangking</div>
                      </a>
                  </li>
                  <li>
                      <a>
                          <div class="parent-icon"><i class="fadeIn animated bx bx-log-out"></i>
                          </div>
                          <div class="menu-title">
                              <Link class="menu-title"
                                  :href="route('logout')"
                                  method="post"
                                  as="button"
                              >
                                  Logout
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
                    <div class="mobile-toggle-menu"><i class='bx bx-menu'></i>
                    </div>
                    <div class="search-bar flex-grow-1">
                    </div>
                    <div class="top-menu ms-auto">
                        <ul class="navbar-nav align-items-center">
                            <div class="user-info ps-3">
                                <p class="user-name mb-0">{{ $page.props.userData.name }}</p>
                                <p class="user-role">{{ $page.props.userData.username }}</p>
                            </div>
                            <div class="parent-icon posisi-icon"><i class="bx bx-user-circle c-font48"></i>
                            </div>
                            <li class="nav-item dropdown dropdown-large">
                                <div class="dropdown-menu dropdown-menu-end">
                                    <div class="header-notifications-list">
                                    </div>
                                </div>
                            </li>
                            <li class="nav-item dropdown dropdown-large">
                                <div class="dropdown-menu dropdown-menu-end">
                                    <div class="header-message-list">
                                    </div>
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
                            <li class="breadcrumb-item">
                            </li>
                        </ol>
                    </nav>
                </div>
                <div class="card">
                    <div class="card-body">
                        <h4 class="mb-0 jarak-top-kurang5">Tabel Kriteria Penilaian</h4>
                        <hr class="c-mt10" />
                        <a class="btn btn-success jarak-top-kurang7" :href="route('lomba.index')">Lomba</a>
                        <a class="btn btn-info jarak-top-kurang7" :href="route('kriteria.create')">Tambah Kriteria</a>
                        <hr class="c-mt10" />
                        <div class="table-responsive">
                            <table id="example" class="table mt-3  table-bordered">
                                <thead class="table-dark">
                                    <tr>
                                        <th class="width-id2">ID</th>
                                        <th class="crud-width-400">Kriteria</th>
                                        <th class="crud-width100">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="kriteria in kriterias.data":key="kriteria.id">
                                        <td>{{ kriteria.id }}</td>
                                        <td>{{ kriteria.name_kriteria }}</td>
                                        <td class="btn-crud">
                                             <a class="btn btn-secondary" :href="route('kriteria.show', kriteria.id)"><i class="bi bi-eye"></i></a>
                                            <button class="btn btn-danger" ><i class="bi bi-trash" @click="deleteKriteria(kriteria.id)" ></i></button>                              
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--end page wrapper -->
        <!--start overlay-->
        <div class="overlay toggle-icon"></div>
        <!--end overlay-->
        <!--Start Back To Top Button--> <a href="javaScript:;" class="back-to-top"><i
                class='bx bxs-up-arrow-alt'></i></a>
        <!--End Back To Top Button-->
    </div>
    <!--end wrapper-->
    <!--start switcher-->

    <!--end switcher-->
</template>


<script setup>
import { defineProps } from "vue";
import { Link, useForm } from "@inertiajs/vue3";
import Swal from 'sweetalert2';
import { onMounted, ref, computed } from 'vue';

const { name, username, kriterias } = defineProps(['name', 'username', 'kriterias']);

const unreadCount = ref(0);

onMounted(async () => {
  try {
    const response = await axios.get('/api/unread-messages');
    unreadCount.value = response.data.unreadCount;
  } catch (error) {
    console.error(error);
  }
});

const deleteForm = useForm({});

const deleteKriteria = (id) => {
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            deleteForm.delete(route("kriteria.destroy", id), {
                preserveScroll: true,
                onSuccess: () => {
                    Swal.fire(
                        'Deleted!',
                        'The criterion has been deleted.',
                        'success'
                    );
                }
            });
        }
    });
};

$(document).ready(function () {
    $('#example').DataTable();
});
</script>

<style>
/* Add any necessary styles */
</style>