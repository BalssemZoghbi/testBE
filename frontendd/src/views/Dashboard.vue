<template>
  <div>
      <NavDash/>  
  </div>
  
</template>

<script>
  import NavDash from '@/components/NavDashboard';

  export default {
    name: 'Dashboard',

    components: {
      NavDash
    },
  data: () => ({
    //
  }),
    mounted(){
  let user=localStorage.getItem('user');
  if(!user){
  this.$router.push('/Connexion');
    }
  },
  }
</script>
