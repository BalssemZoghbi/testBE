import axios from "axios";
const apiClient = axios.create({
  baseURL: "http://127.0.0.1:8000/api",
  withCredentials: false,
  headers: {
    Accept: "application/json",
    "Content-Type": "application/json",
  },
});

export default {
  login(data) {
    return apiClient.post("/login",data);
  },
  register(data) {
    return apiClient.post("/register",data);
  },
  logout(data) {
    return apiClient.post("/logout",data);
  },
  
};
