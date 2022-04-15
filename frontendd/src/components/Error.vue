<template>
<v-alert dense
        id="valert"
      type="error"
      text
      prominent
      icon="mdi-cloud-alert"  >   
     {{error}}
     </v-alert>
</template>
<script>
export default {
    name:'Error',
    props:['error']
}
</script>
<style scoped>
#valert{
  margin-top: 4%!important;
}
</style>