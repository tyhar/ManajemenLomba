<template>
    <div class="image-container">
      <div class="btn-posisi">
        <button class="btn btn-danger btn-kembali" @click="goBack()">Kembali</button>
      </div>
      <img :src="UserData.payment ? `/storage/${UserData.payment}` : '/bootstrap/images/default2.png'" alt="..." class="img-fluid rounded full-screen">
    </div>
  </template>
  
  <script setup>
  import { defineProps } from 'vue';
  
  const { UserData } = defineProps(['UserData']);
  
  const goBack = () => {
    window.history.back();
  };
  </script>
  
  <style scoped>
  .image-container {
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
    max-width: 100%;
    max-height: 100%;
    object-fit: cover;
  }
  </style>
  