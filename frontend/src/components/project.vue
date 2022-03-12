
<template>
    <div class="container event py-5" style="margin-left: 10%">
<div class="input-group mb-3" id="search">
  <input type="search" class="form-control" v-model="query" placeholder="Search" aria-label="Search" aria-describedby="basic-addon2">
  <span class="input-group-text" id="basic-addon2">search icon</span>
</div>
 <div v-for="projet in filtered " :key="projet.id" :projet="projet">
     <div class="input-group">
  <input type="text" class="form-control" {{ projet.reference }}>
  <span class="input-group-text">$</span>
  <span class="input-group-text">0.00</span>
</div>
 </div>
      </div>
      
</template>
<script>
export default {
  name: "project",
};
</script>
<style scoped>
#search {
  background: rgba(196, 196, 196, 0.28);
  box-shadow: 0px 7px 4px rgba(58, 103, 218, 0.25);
  border-radius: 37px;
  width: 70%;
  margin-left: 10%;
}
</style>
