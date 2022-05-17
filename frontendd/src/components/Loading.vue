<template>
  <!-- <transition name="fade"> -->
    <div class="preloader">
      <!-- <div class="logo"></div>
    
  </transition> -->
<v-progress-circular  
      :size="50"
      class="logo"
      color="primary"
      indeterminate
    ></v-progress-circular></div>
</template>

<style scoped>
.preloader {
  position: fixed;
  z-index: 9999999;
  align-items: center;
  background: #fff;
  justify-content: center;
  width: 100%;
  height: 100%;
}
.logo {
  width: 100%;
  height: 100%;
  margin: 16%;
  margin-left: 39%;
  /* background-image: url(../assets/loading.gif); */
}
p {
  font: 600 1.5rem;
  margin-top: 1rem;
}
.fade-enter-active,
.fade-leave-active {
  transition: opacity 0.5s;
}
p {
  animation-name: scaleOut;
  animation-duration: 1s;
}
.fade-enter-active,
.fade-leave-active {
  transition: opacity 0.5s;
}

@keyframes scaleOut {
  0% {
    transform: scale(1);
  }
  100% {
    transform: scale(0);
  }
}
</style>
