<template>
    <div class="uploader"
    @dragenter="onDragEnter"
    @dragleave="onDragLeave"
    @dragover.prevent
    @drop="onDrop"
    :class="{ dragging: isDragging}"
    >
        <v-icon dark style="font-size: 70px;" v-if="icon">
          mdi-cloud-upload
        </v-icon>
        <v-icon color="primary" style="font-size: 70px;" v-else>
          mdi-cloud-upload
        </v-icon>
        <p>Glissez-déposez les fichiers que vous souhaitez importer</p>
        <span>ou</span>
        <div class="file-input">
            <label for="file">choisir un fichier</label>
            <input type="file" id="file" @change="ImporterFichier" multiple>
        </div>
    </div>
</template>
<script>
import axios from "axios";
export default{
    data:()=>({
        isDragging: false,
        dragCount: 0,
        files: [],
    }),
methods:{
      ImporterFichier(event) {
       
      let name =event.target.files[0].name;
     console.log(name)
let id=name.replace('.json','');
       let token = localStorage.getItem("token");
        
      axios
        .get(
          "/importjson/"+id,
          {
            headers: {
              Authorization: token,
            },
          }
        )
      .then(response => (this.info = response.data))
      
    },

    onDragEnter(e){
      e.preventDefault();
      
      this.dragCount++;
      this.isDragging=true;
      this.icon=false;
    },
    onDragLeave(e){
      e.preventDefault();
      this.dragCount--;
      if(this.dragCount<0){
        this.isDragging=false;
      }
    },
    onDrop(e){
        e.preventDefault();
        e.stopPropagation();
        this.isDragging=false;
        const files=e.dataTransfer.files;
        Array.from(files).forEach(file=> this.import(file));
    },
     import(file){
          let name =file.name;
        let id=name.replace('.json','');
       let token = localStorage.getItem("token");
      axios
        .get(
          "/importjson/"+id,
          {
            headers: {
              Authorization: token,
            },
          }
        )
      .then(response => (console.log(response.data)))
        }
},
}
</script>
<style scoped lang="scss">
.uploader{
    width: 100%;
    height: 70%;
    background-color: rgb(5, 48, 96);
    color: #fff;
    text-align: center;
    padding: 40px 15px;
    border-radius: 10px;
    font-size: 20px;
    position: relative;
    // border: 3px solid #fff;
    &.dragging{
        border: 3px dashed rgb(5, 48, 96);
        background-color: #fff;
         color: rgb(5, 48, 96);
        .file-input label{
           background-color: rgb(5, 48, 96);
            color: #fff;
        }
    }
}
v-icon{
    font-size: 73px;
}
.file-input{
    position: relative;
   margin: auto;
    width: 200px;
    height: 80px;
    
}
label,input{
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        background-color: #fff;
        color: rgb(5, 48, 96);
        padding: 10px;
        border-radius: 4px;
        margin-top:7px;
        cursor: pointer;
    }
    input{
        opacity: 0;
        z-index:-2;
    }
</style>
