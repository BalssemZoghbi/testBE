<template>
  <div>
    <navbarHome />
    <div class="projet">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="titlepage">
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
              </form>
            </div>
          </div>
        </div>
        <div
          class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3"
        >
          <div
            class="col"
            v-for="projet in filtered"
            :key="projet.id"
            :projet="projet"
          >
            <div class="projet_box">
              <i><img src="../assets/trans.png" alt="#" /></i>
              <router-link class="nav-link" :to="'/projet/' + projet.id"
                ><h4>{{ projet.reference }}</h4>
              </router-link>
              <br />
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
              <!-- <button class="btn btn-outline-light"  ><router-link :to="'/projet/update/' + projet.id" >edit</router-link></button>
                     <button class="btn btn-outline-light" v-on:click="deleteprojet(projet.id)">delete</button>  -->
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
              <!-- <button class="btn"><i class="fa-solid fa-file-import"></i> </button> -->
            </div>
          </div>
        </div>
      </div>
    </div>

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
    <!-- end projet -->
    <footer>
      <div class="footer">
        <div class="container">
          <!-- <div class="row">
                  <div class="col-md-8 offset-md-2">
                  
                  </div>
               </div> -->
        </div>
        <div class="copyright">
          <div class="container">
            <div class="row">
              <div class="col-md-12">
                <p><a href="https://html.design/"> </a></p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </footer>
  </div>
</template>


<script>
import ProjetService from "@/services/ProjetService.js";
import navbarHome from "@/components/navbarHome";
import {mapState} from 'vuex';

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
      query:"",
      // currentPage: 1,
      // rows: 200,
      // perPage:15,
    };
  }, 
  computed: {
  filtered() {
    return this.projets.filter(projet => projet.reference.includes(this.query));
  },
    ...mapState({
         user:'userInfos'
       })
},
 mounted:function(){
    console.log(this.$store.state.user);
    if(this.$store.state.user.id==-1){
      this.$router.push('/login');
      return;
    }
  },
  created() {
    this.getprojet();
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
      ProjetService.getProjetspaginate().then((resp) => {
        this.projets = resp.data.data;
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
#search {
  background: rgba(196, 196, 196, 0.28);
  box-shadow: 0px 7px 4px rgba(58, 103, 218, 0.25);
  border-radius: 37px;
  width: 70%;
  margin-left: 15%;
}
.form-control:focus {
  border-color: #ffffff !important;
  box-shadow: 0 0 0 0.2rem rgba(255, 255, 255, 0.25);
}

.titlepage {
  text-align: center;
  padding-bottom: 60px;
}

.titlepage h2 {
  font-size: 45px;
  color: #5a2f27;
  line-height: 55px;
  font-weight: bold;
  padding-bottom: 20px;
}
.yellow {
  color: #3e93c3;
  font-weight: bold;
}

.projet {
  background: #fff;
  margin: 90px 0;
}

.projet .titlepage span {
  font-size: 17px;
  line-height: 30px;
  color: #000000;
  font-weight: 501;
  display: block;
  padding: 0px 49px;
}

.projet .projet_box {
  text-align: center;
  background: rgb(35 133 235);
  margin-bottom: 30px;
  margin-top: 116px;
  padding: 0px 30px 30px 30px;
}

.projet .projet_box:hover {
  background: #3156fd !important;
}

.projet_box i img {
  margin-top: -120px;
}

.projet .projet_box h4 {
  font-family: "Noto Serif", serif;
  font-size: 20px;
  line-height: 30px;
  font-weight: 501;
  padding-top: 30px;
  padding-bottom: 0;
  color: #fff;
  padding-bottom: 10px;
}

.projet .projet_box p {
  color: #fff;
  font-size: 17px;
  line-height: 33px;
}
.d_flex {
  display: flex;
  align-items: center;
  flex-wrap: wrap;
}
/* .titlepage h2 {
     padding-bottom: 0;
}
.titlepage span {
     font-size: 17px;
     line-height: 30px;
     color: #b3b1a6;
     font-weight: 501;
     display: block;
} */

.footer {
  background: #fff;
  padding-top: 85px;
  text-align: center;
}

.footer .titlepage {
  text-align: left;
  padding-bottom: 10px;
}

.footer .titlepage h2 {
  color: #e95d49;
}

.cont {
  text-align: center;
}

.cont h3 {
  color: #0e0d0d;
  font-size: 45px;
  line-height: 66px;
  font-weight: 600;
}

.cont p {
  color: #eda911;
  font-size: 20px;
  line-height: 30px;
  padding-top: 10px;
  font-weight: 501;
  padding-bottom: 35px;
}

.sub_btn {
  font-size: 17px;
  transition: ease-in all 0.5s;
  background-color: #000;
  color: #fff;
  width: 100%;
  display: block;
  font-weight: 500;
  border-radius: 35px;
  border: #fff solid 4px;
  padding: 13px 0px;
  max-width: 200px;
  margin: 0 auto;
}

.sub_btn:hover {
  background-color: #eda911;
  transition: ease-in all 0.5s;
  color: #fff;
}

.copyright {
  margin-top: 90px;
  padding: 20px 0px;
  background-color: #3e93c3;
}

.copyright p {
  color: #fff;
  font-size: 18px;
  line-height: 22px;
  text-align: center;
}

.copyright a {
  color: #fff;
}

.copyright a:hover {
  color: #eda911;
}
</style>
