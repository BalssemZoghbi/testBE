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
  getProjets() {
    return apiClient.get("/projets");
  },
  getProjetById(id) {
    return apiClient.get("/projets/"+id);
  },
  deleteProjet(id) {
    return apiClient.delete("/projets/delete/"+id);
  },
  createProjet(data) {
    return apiClient.post("/projets/create",data);
  },
  updateProjet(id,data) {
    return apiClient.put("/projets/edit/"+id,data);
  },
};
