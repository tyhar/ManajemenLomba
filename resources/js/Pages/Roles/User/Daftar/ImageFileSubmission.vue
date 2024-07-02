<template>
  <div class="image-container">
   
    <div class="btn-posisi">
      <a :href="getDownloadLink()" class="btn btn-success" download>Download zip</a>
    </div>
    <div class="btn-back">
      <a  @click="goBack()" class="btn btn-primary">Kembali</a>
    </div>
  </div>
</template>

<script setup>
import { defineProps } from 'vue';

const props = defineProps(['UserData']);

const getDownloadLink = () => {
  // Check if UserData.file is defined
  if (props.UserData.file) {
    return `/storage/${props.UserData.file}`;
  } else {
    return '/bootstrap/images/default2.png';
  }
};
const goBack = () => {
    window.history.back();
};
</script>

<style scoped>
.image-container {
  position: relative;
  height: 100vh;
  overflow: hidden;
}

.full-screen {
  width: 100%;
  height: 100%;
  object-fit: cover;
}

.btn-posisi {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
}

.btn-back {
  position: absolute;
  bottom: 20px;
  right: 20px;
}
</style>
