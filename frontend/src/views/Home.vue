<template>
  <div>
    <navbarHome />
    <div class="home">
      <div class="container event py-5" style="margin-left: 10%">
        <form class="d-flex" style="maring-left: -6%">
          <input
            class="form-control me-2"
            type="search"
            placeholder="Search"
            aria-label="Search"
            id="search"
            v-model="query"
            aria-describedby="basic-addon2"
          />
          <!-- <input type="submit" class="btn btn-primary" value="search" > -->
          <!-- <span class="input-group-text" id="basic-addon2"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
            <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
          </svg></span> -->
        </form>
        <div v-for="projet in filtered" :key="projet.id" :projet="projet">
          <div class="projet-card card">
            <div class="card-body">
              <router-link class="nav-link" :to="'/projet/' + projet.id">
                {{ projet.reference }}
              </router-link>

              <div class="button" style="margin-top: -7%">
                <button class="btn" v-on:click="deleteprojet(projet.id)">
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="35"
                    height="35"
                    fill="currentColor"
                    class="bi bi-trash-fill"
                    viewBox="0 0 16 16"
                  >
                    <path
                      d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"
                    />
                  </svg>
                </button>
                <button class="btn">
                  <router-link
                    class="nav-link"
                    :to="'/projet/update/' + projet.id"
                  >
                    <svg
                      xmlns="http://www.w3.org/2000/svg"
                      width="35"
                      height="35"
                      fill="currentColor"
                      class="bi bi-pencil-square"
                      viewBox="0 0 16 16"
                    >
                      <path
                        d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"
                      />
                      <path
                        fill-rule="evenodd"
                        d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"
                      />
                    </svg>
                  </router-link>
                </button>
              </div>
            </div>
          </div>
        </div>
        <br />

        <nav aria-label="Page navigation example">
          <ul class="pagination">
            <li class="page-item">
              <a class="page-link" href="#" aria-label="Previous">
                <span aria-hidden="true">&laquo;</span>
                <span class="sr-only">Previous</span>
              </a>
            </li>
            <!-- <jw-pagination :pageSize=20 :items="exampleItems" @changePage="onChangePage"> -->
            <li class="page-item">
              <a class="page-link" href="#" @page-change="onPageChange(1)">1</a>
            </li>
            <li class="page-item">
              <a class="page-link" href="#" @page-change="onPageChange(2)">2</a>
            </li>
            <li class="page-item">
              <a class="page-link" href="#" @page-change="onPageChange(3)">3</a>
            </li>
            <!-- </jw-pagination> -->
            <li class="page-item">
              <a class="page-link" href="#" aria-label="Next">
                <span aria-hidden="true">&raquo;</span>
                <span class="sr-only">Next</span>
              </a>
            </li>
          </ul>
        </nav>
      </div>
    </div>
  </div>
</template>

<script>
import ProjetService from "@/services/ProjetService.js";
import navbarHome from "@/components/navbarHome";
// const exampleItems = [...Array(150).keys()].map(i => ({ id: (i+1), name: 'Item ' + (i+1) }));
export default {
  name: "Home",
  components: {
    navbarHome,
  },
  data() {
    return {
      projets: {},
      // exampleItems,
      // pageOfItems: [],
      query: "",
      // currentPage: 1,
      // rows: 200,
      // perPage:15,
    };
  },
  created() {
    this.getprojet();
  },
  computed: {
    filtered() {
      return this.projets.filter((projet) =>
        projet.reference.includes(this.query)
      );
    },
  },

  methods: {
    deleteprojet(id) {
      ProjetService.deleteProjet(id).then(() => {
        this.getprojet();
      });
    },
    // getprojet() {
    //   ProjetService.getProjets().then((resp) => {
    //     this.projets = resp.data.data;
    //   });
    // },
    getprojet() {
      ProjetService.getProjets().then((resp) => {
        this.projets = resp.data.data;
        console.log(resp);
      });
    },
    // onChangePage(pageOfItems) {
    //         console.log(pageOfItems)
    //         // update page of items
    //         this.pageOfItems = pageOfItems;
    // },
  },
};
</script>
<style scoped>
.event {
  display: flex;
  flex-direction: column;
  align-items: left;
}
.projet-card {
  margin-top: 20px;
  margin-left: 70px;
  cursor: pointer;
  border: 1px solid #c6deed;
  background: #ffffff;
  /* background: #c6deed; */

  box-shadow: 0px 1px 19px rgba(198, 222, 237, 0.25);
  border-radius: 12px;
  width: 80%;
  /* left: 175px; */
  /* top: 12%; */
  height: 50px;
}
.projet-card:hover {
  transform: scale(1.01);
  box-shadow: 0 3px 12px 0 rgba(0, 0, 1, 0);
}

.button {
  /* display:inline-block; */
  /* text-align: justify; */
  margin-top: -8%;
  margin-left: 80%;
  border-radius: 20px;
  /* display: inline; */
}
#search {
  background: rgba(196, 196, 196, 0.28);
  box-shadow: 0px 7px 4px rgba(58, 103, 218, 0.25);
  border-radius: 37px;
  width: 70%;
  margin-left: 10%;
}
button {
  color: #a2cfeb !important;
}
</style>
