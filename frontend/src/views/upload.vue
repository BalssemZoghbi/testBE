<template>
<div>
    <div class="activity">
    <form action="">
        <div class="form-group">
            <label for="exampleFormControlFile1">Example file input</label>
            <input type="file" class="form-control-file" id="exampleFormControlFile1">
        </div>
    </form>
    <div class="form-group">
        <input type="submit" value="go" v-on:click="getfile()">
    </div>
    </div>
</div>
</template>

<script>
import HelloWorld from "../components/HelloWorld";

export default {
  name: "Home",

methods:{
    getfile(){
        // let self=this;
        // self.
    }
}
}
</script>
