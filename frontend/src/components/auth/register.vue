<template>
  <form v-on:submit.prevent="register">
    <h1>register</h1>
    <br />
    <div class="mb-3">
      <label for="name" class="form-label">name</label>
      <input
        class="form-control"
        type="text"
        placeholder="Appareil"
        id="name"
        v-model="name"
      />
    </div>
    <div class="mb-3">
      <label for="email" class="form-label">email</label>
      <input
        class="form-control"
        placeholder="email"
        type="email"
        id="email"
        v-model="email"
      />
    </div>
    <div class="mb-3">
      <label for="password" class="form-label">password</label>
      <input
        class="form-control"
        type="password"
        placeholder="password"
        id="password"
        v-model="password"
      />
    </div>
   
    <button type="submit" class="btn btn-primary mb-3">login</button>
  </form>
</template>

<script>
import AuthService from "@/services/AuthService.js";
export default {
  data() {
    return {
      name: "",
      email: "",
      password: ""
    };
  },
  methods: {
    register() {
      const user = {
        id: undefined,
        name: this.name,
        password: this.password
      };
      AuthService.register(user).then(
        (response) => (this.id = response.data.id)
      );
    //   this.$router.push({ name: "Home" });
    },
  },
};
</script>

<style scoped>
form {
  width: 50%;
  height: 50%;
  margin-left: 20%;
}
</style>
