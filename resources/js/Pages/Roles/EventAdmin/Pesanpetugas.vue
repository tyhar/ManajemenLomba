<script setup>
import { Link } from '@inertiajs/vue3';
import { ref, computed } from 'vue';
import { router } from "@inertiajs/vue3";
import { defineProps } from "vue";

const props = defineProps({
    messages: {
        type: Array,
        required: true,
    },
    name: {
        type: String,
        required: true,
    },
    username: {
        type: String,
        required: true,
    },
    settings: {
        type: Object,
        default: () => ({}),
    },
    logo1: {
        type: String,
    },
    unreadCount: {
        type: Object,
        required: true,
    },
});

const selectedStatus = ref('Semua');

const updateMessageStatus = async (id, currentStatus) => {
    try {
        const newStatus = currentStatus === 'belum_dibaca' ? 'sudah_dibaca' : 'belum_dibaca';

        await router.patch(`/messages/${id}/status`, {
            status: newStatus,
        });

        const message = props.messages.find(msg => msg.id === id);
        if (message) {
            message.status = newStatus;

            if (newStatus === 'sudah_dibaca') {
                props.unreadCount.value -= 1;
            } else {
                props.unreadCount.value += 1;
            }
        }
    } catch (error) {
        console.error(error);
    }
};

const filteredMessages = computed(() => {
    if (selectedStatus.value === 'Semua') {
        return props.messages;
    }
    return props.messages.filter(message => message.status === selectedStatus.value.toLowerCase());
});
</script>

<template>
    <!--wrapper-->
    <div class="wrapper">
        <!--sidebar wrapper -->
        <div class="sidebar-wrapper" data-simplebar="true">
            <div class="sidebar-header">
                <div v-for="setting in settings" :key="setting.id">
                    <a href="/">
                        <img id="logo-img"
                            :src="setting.logo1 ? `/storage/${setting.logo1}` : '/bootstrap/images/logo1default.jpg'"
                            class="lg2">
                    </a>
                </div>
                <div id="menu-toggle" class="toggle-icon ms-auto"><i class="fadeIn animated bx bx-menu"></i></div>
            </div>
            <!--navigation-->
            <ul class="metismenu" id="menu">
                <li>
                    <a href="/eventadmin">
                        <div class="parent-icon"><i class='bx bx-home-circle'></i>
                        </div>
                        <div class="menu-title">Dashboard</div>
                    </a>
                </li>
                <li>
                    <a href="/partisipanpetugas">
                        <div class="parent-icon"><i class="fadeIn animated bx bx-user-circle c-font25"></i>
                        </div>
                        <div class="menu-title">Partisipan</div>
                    </a>
                </li>
                <li>
                    <a href="/timpetugas">
                        <div class="parent-icon"><i class="fadeIn animated lni lni-users"></i>
                        </div>
                        <div class="menu-title">Tim</div>
                    </a>
                </li>
                <li>
                    <a href="/pesanpetugas">
                        <div class="parent-icon"><i class="fadeIn animated bx bx-comment-detail"></i>
                        </div>
                        <div class="menu-title">Pesan <span class="alert-count">{{ unreadCount}}</span></div>
                    </a>
                </li>
                <li>
                    <a href="/rangkingpetugas">
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
                        <h4 class="mb-0 jarak-top-kurang5">TABEL PESAN</h4>
                        <hr class="c-mt10" />
                        <label class="jarak-filterstatus">Filter by Status</label>
                        <select class="form-select2" v-model="selectedStatus">
                            <option value="Semua" selected>Semua</option>
                            <option value="sudah_dibaca">Sudah Dibaca</option>
                            <option value="belum_dibaca">Belum Dibaca</option>
                        </select>
                        <br><br>
                        <div class="table-responsive">
                            <table id="example" class="table table-bordered">
                                <thead class="table-dark">
                                    <tr>
                                        <th class="width-id">ID</th>
                                        <th class="crud-width-250">Nama</th>
                                        <th class="crud-width-50">Email</th>
                                        <th class="crud-width-150">No WhatsApp</th>
                                        <th class="crud-width-350">Pesan</th>
                                        <th class="crud-width-80">Status</th>
                                        <th class="width-id"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="message in filteredMessages" :key="message.id">
                                        <td>{{ message.id }}</td>
                                        <td>{{ message.name }}</td>
                                        <td>{{ message.email }}</td>
                                        <td>{{ message.phone }}</td>
                                        <td>{{ message.value }}</td>
                                        <td>{{ message.status }}</td>
                                        <td>
                                            <input type="checkbox" :checked="message.status === 'sudah_dibaca'"
                                                :disabled="message.status === 'sudah_dibaca'"
                                                @change="() => updateMessageStatus(message.id, message.status)" />
                                        </td>
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
</template>
