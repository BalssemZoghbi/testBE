<template>
    <div class="uploader"
    @dragenter="onDragEnter"
    @dragleave="onDragLeave"
    @dragover.prevent
    @drop="onDrop"
    :class="{ dragging: isDragging}"
    >
    
        <div v-show="!projets.length">
          <v-alert
       shaped
      dense
      dark
      prominent
      type="success"
      v-show="success"
    >
    <!-- ,alert("les fichiers sont importé avec succés") -->
     Le fichier est importé avec succés
    </v-alert >
    
          <!-- <v-icon dark style="font-size: 70px;" >
          mdi-cloud-upload
        </v-icon> -->
        <v-icon color="primary" style="font-size: 70px;" >
          mdi-cloud-upload
        </v-icon>
        <p>Glissez-déposez les fichiers que vous souhaitez importer</p>
        <span>ou</span>
        <div class="file-input" >
            <label for="file" class="lab">choisir un fichier</label>
            <input type="file" id="file" @change="onInputChange" multiple>
        </div>
        
        </div>
        <div v-show="projets.length" >
          
          <div  class="upload-content">
        <button  @click="cancel" ><v-icon dark left class="icon">
          mdi-minus-circle
        </v-icon></button>
           <button @click="upload"><v-icon dark class="icon">mdi-cloud-upload</v-icon></button>
    </div>
     <v-alert style="margin-top:4%"
        v-show="warning"
      shaped
      dense
      dark
      prominent
      type="error"
    >
      Une erreur s'est produite, veuillez réessayer
    </v-alert>
    <div class="image-preview">
          <div class="image-wrapper" v-for="(image, index) in projets" :key="index">
            <!-- <img src="../assets/file.png" alt=""> -->
            <div>
            <v-icon dark style="font-size:80px">folder_open</v-icon>
            <div class="detail">
              <span class="name" v-text="files[index].name"></span>
              <span class="size"  v-text="files[index].size"></span>
            </div>
            </div>
          </div>
          </div>
         
        </div>
    </div>
</template>
<script>
import axios from "axios";
export default{
    data:()=>({
        isDragging: false,
        success: false,
        warning: false,
        dragCount: 0,
        files: [],
        projets: [],
    }),
methods:{
      ImporterFichier(event) {
       
      let name =event.target.files[0].name;
    //  console.log(name)
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
      this.success=false;
      this.warning=false;
    },
    onDragLeave(e){
      e.preventDefault();
      this.dragCount--;
      if(this.dragCount<=0){
        this.isDragging=false;
      }
      this.success=false;
      this.warning=false;
    },
    onInputChange(e){
        const files=e.target.files;
        Array.from(files).forEach(file=> this.import(file));
        this.success=false;
      this.warning=false;
    },
    onDrop(e){
        e.preventDefault();
        e.stopPropagation();
        this.isDragging=false;
        const files=e.dataTransfer.files;
        Array.from(files).forEach(file=> this.import(file));
    },
    cancel(){
      this.projets=[];
      this.files=[];
      console.log(this.files,this.projets);
    },
    upload(){
      // const formData= new FormData();
      // this.files.forEach(file =>{
      //   formData.append('projets[]', file, file.name)
      // });
   
          let name =this.files[0].name;
        let id=name.replace('.json','');
           console.log(id);
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
      .then(response => (console.log(response.data),this.success=true,this.files=[],this.projets=[]))
      .catch(error => (console.log(error),this.warning=true))  
    },
     import(file){
      //  if(!file.type.match('json.*')){
      //    console.log(`${file.name} is not json file`);
      //    return ;
      //  }
       this.files.push(file);
      let  reader=new FileReader();
        reader.onload=(e)=>this.projets.push(e.target.result);
        reader.readAsDataURL(file);
          
          // console.log( file.name);
        
        //  console.log(reader)
      //     let name =file.name;
      //     console.log(name);
      //   let id=name.replace('.json','');
      //  let token = localStorage.getItem("token");
      // axios
      //   .get(
      //     "/importjson/"+id,
      //     {
      //       headers: {
      //         Authorization: token,
      //       },
      //     }
      //   )
      // .then(response => (console.log(response.data)))
        }
},
}
</script>
<style scoped lang="scss">
.image-preview{
  display: flex;
  flex-wrap: wrap;
  margin-top: 20px;

  .image-wrapper{
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    margin: 10px;
    width: 160px;
    margin-left: 40%;
    border: 1px solid #fff;
    box-shadow: 5px 5px 5px 20px rgb(5, 48, 96);
    .detail{
      font-size: 12px;
      display: flex;
      flex-direction: column;
      align-items: self-start;
      padding: 3px 6px;
      color: rgba(0,0,0,0.5);
      background: #fff;
      .name{
        overflow: hidden;
        height: 20px;
      }
      .size{
        // font-size: 10px;
      }
    }
  }
}
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
        border: 3px solid #fff;
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
.lab{
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
    .upload-content{
      position: absolute;
      width: 100%;
      background: rgb(5, 48, 96) ;
      top: 0;
      left: 0;
      border-top-left-radius: 7px;
      border-top-right-radius: 7px;
      padding: 10px;
      padding-bottom:4px ;
      // margin-top: 5%;
      text-align: right;
      // position: absolute;
      // width: 100%;
      // background: #fff;
      // top: 0;
      // left: 0;
      // border-top-left-radius: 7px;
      // border-top-right-radius: 7px;
      // padding: 10px;
      // padding-bottom:4px ;
      // text-align: right;
      button,label{
        background:rgb(5, 48, 96) ;
        font-size: 30px;
        color: #fff;
        border: 2px solid rgb(5, 48, 96)  ;
        border-radius: 3px;
        cursor: pointer;
      }
      label{
        padding: 2px 5px;
        margin-right: 10px;
      }
    }
    .icon{
          font-size: 35px;
    // margin-top: 35%;
    }
</style>
