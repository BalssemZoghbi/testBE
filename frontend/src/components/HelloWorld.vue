<template>
<div class="projet-card card">
  <div class="card-body">
       <p>{{projet.titre}}</p>
    <div class="button">
    <button class="btn btn-primary">add</button>
    <button class="btn btn-danger">delete</button>
    <button class="btn btn-warning">edit</button>
  </div>
   </div>
</div>
</template>

<script>
export default {
  name: "HelloWorld",
  props: {
   projet:Object,
  },
};
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
.projet-card{
  margin-top: 20px;
 padding: 20px;
cursor: pointer;
border: 1px solid black;
background: #FFFFFF;
box-shadow: 0px 1px 19px rgba(198, 222, 237, 0.25);
border-radius: 40px;
width: 100%;
/* left: 175px; */
/* top: 12%; */
height: 75px;

}
.projet-card:hover{
  transform: scale(1.01);
  box-shadow: 0 3px 12px 0 rgba(0, 0, 1, 0);
}
p{
    margin-top: -2%;
  /* margin-right: 80%; */
}
.button{
/* display:inline-block; */
/* text-align: justify; */
  margin-top: -3%;
  margin-left: 83%;
border-radius: 20px;
}
</style>
