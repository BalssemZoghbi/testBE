!<template>
<div>
    <NavDash />
    <img src="../assets/6384608.jpg" alt="">
    <Footer/> 

</div>
</template>

<script>
import NavDash from "../components/NavDashboard.vue";
import Footer from '@/components/Footer'
export default {
  components: {
    Footer,
    NavDash
  },
}
</script>

<style>
img{
    width: 68%;
    margin-left: 16%;
    margin-top: -12%;
}
</style>