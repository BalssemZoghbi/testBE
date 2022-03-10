<template>
  <nav aria-label="Page navigation example" :data="projetData">
    <ul class="pagination">
      <li class="page-item">
        <a class="page-link" href="#" aria-label="Previous">
          <span aria-hidden="true">&laquo;</span>
          <span class="sr-only">Previous</span>
        </a>
      </li>
      <li class="page-item"><a class="page-link" href="#">1</a></li>
      <li class="page-item"><a class="page-link" href="#">2</a></li>
      <li class="page-item"><a class="page-link" href="#">3</a></li>
      <li class="page-item">
        <a class="page-link" href="#" aria-label="Next">
          <span aria-hidden="true">&raquo;</span>
          <span class="sr-only">Next</span>
        </a>
      </li>
    </ul>
  </nav>
  <!-- <pagination :data="projetData">
    <template #prev-nav>
        <span>&lt; Previous</span>
    </template>
    <template #next-nav>
        <span>Next &gt;</span>
    </template>
</pagination> -->
</template>

<script>
import LaravelVuePagination from "laravel-vue-pagination";
import ProjetService from "@/services/ProjetService.js";

export default {
  components: {
    Pagination: LaravelVuePagination,
  },
  data() {
    return {
      // Our data object that holds the Laravel paginator data
      projetData: {},
    };
  },
  mounted() {
    // Fetch initial results
    this.getResults();
  },

  methods: {
    // Our method to GET results from a Laravel endpoint
    getResults(page = 1) {
      ProjetService.getProjets().then((resp) => {
        this.projetData = resp.data.data;
      });
    },
  },
};
</script>
<style scoped></style>
