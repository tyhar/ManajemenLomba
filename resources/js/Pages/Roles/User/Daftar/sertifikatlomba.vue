<template>
    <div class="file-container">
      <!-- <div class="btn-posisi">
        <button class="btn btn-danger btn-kembali" @click="goBack()">Kembali</button>
      </div> -->
      <div v-if="isPdfFile" class="pdf-container">
        <iframe :src="getFileSrc()" class="full-screen"></iframe>
      </div>
      <div v-else class="image-container">
        <img :src="getFileSrc()" alt="..." class="img-fluid rounded full-screen">
      </div>
    </div>
  </template>
  
  <script setup>
  import { defineProps, computed } from 'vue';
  
  const props = defineProps(['UserData']);
  
  const goBack = () => {
    window.history.back();
  };
  
  const getFileSrc = () => {
    // Check if UserData.surat is defined
    if (props.UserData.sertifikat) {
      return `/storage/${props.UserData.sertifikat}`;
    } else {
      return '/bootstrap/images/default2.png';
    }
  };
  
  const isPdfFile = computed(() => {
    return props.UserData.sertifikat ? props.UserData.sertifikat.toLowerCase().endsWith('.pdf') : false;
  });
  </script>
  
  <style scoped>
  .file-container {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    overflow: hidden;
    position: relative;
  }
  
  .btn-posisi {
    position: absolute;
    bottom: 20px; /* Adjust as needed */
    right: 20px; /* Adjust as needed */
  }
  
  .full-screen {
    width: 100%;
    height: 100%;
  }
  
  .pdf-container {
    width: 100%;
    height: 100%;
    overflow: hidden;
  }
  
  .image-container {
    display: flex;
    justify-content: center;
    align-items: center;
    width: 100%;
    height: 100%;
  }
  </style>
  