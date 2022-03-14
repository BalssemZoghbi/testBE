<template>
 <header>
         <!-- header inner -->
         <div class="header">
            <div class="container">
               <div class="row">
                  <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col logo_section">
                     <div class="full">
                        <div class="center-desk">
                           <div class="logo">
                              <a href="sacemindustries.com"><img src="../assets/sacem.png" width="100px" alt="sacemindustries" /></a>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-xl-9 col-lg-9 col-md-9 col-sm-9">
                     <nav class="navigation navbar navbar-expand-md navbar-dark ">
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample04" aria-controls="navbarsExample04" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarsExample04">
                           <ul class="navbar-nav mr-auto">
                              <li class="nav-item">
                                  <router-link class="nav-link " aria-current="page" to="/"
          >Projet</router-link
        >
                              </li>
                              <li class="nav-item">
                                 <router-link class="nav-link" to="/projet/create">Crée</router-link>
                              </li>
                              <li class="nav-item">
                                       <router-link class="nav-link" to="/about">Importer</router-link>

                              </li>
                           </ul>
                           <div class="Call"><a href="#"> <span class="yellow">logout</span></a></div>
                        </div>
                     </nav>
                  </div>
               </div>
            </div>
         </div>
      </header>
</template>
<script>
export default {
  name: "navbarHome",
};
</script>
<style scoped>
/* *::after,
*::before {
     -webkit-box-sizing: border-box;
     -moz-box-sizing: border-box;
     box-sizing: border-box;
}
.header {
     width: 100%;
     background: #eae9e4;
     padding: 20px 30px;
}

.logo a {
     font-size: 40px;
     font-weight: bold;
     text-transform: uppercase;
     color: #fff;
     line-height: 40px;
}
img {
     max-width: 100%;
     height: auto;
}
.navigation.navbar {
     padding: 0px;
}

.navigation.navbar-dark .navbar-nav .nav-link {
     padding:0 50px;
     color: #3e93c3;
     font-size: 16px;
     line-height: 20px;
     font-weight: 500;
     text-transform: uppercase;
}

.navbar-dark .navbar-nav .nav-link:focus,
.navbar-dark .navbar-nav .nav-link:hover {
     color: #5a2f27 !important;
}

.navbar-expand-md .navbar-nav {
     padding-right: 10px;
}

.Call a {
     display: inline-block;
     padding: 7px 0;
     color: #5a2f27;
     font-size: 20px;
}

.yellow {
     color: #3e93c3;
     font-weight: bold;
     margin-left: 90%;
          text-align: left;

}
a {
     color: #1f1f1f;
     text-decoration: none !important;
     outline: none !important;
     -webkit-transition: all .3s ease-in-out;
     -moz-transition: all .3s ease-in-out;
     -ms-transition: all .3s ease-in-out;
     -o-transition: all .3s ease-in-out;
     transition: all .3s ease-in-out;
}

a {
     color: #222222;
     text-decoration: none;
     outline: none !important;
}

a,
.btn {
     text-decoration: none !important;
     outline: none !important;
     -webkit-transition: all .3s ease-in-out;
     -moz-transition: all .3s ease-in-out;
     -ms-transition: all .3s ease-in-out;
     -o-transition: all .3s ease-in-out;
     transition: all .3s ease-in-out;
}
@media (min-width: 768px) and (max-width: 991px) {
    .navigation.navbar-dark .navbar-nav .nav-link {
        padding: 0px 10px;
    }
    .Call a {
        font-size: 18px;
    }}
    @media (min-width: 576px) and (max-width: 767px) {
    .header {
        padding: 15px 30px 10px 30px;
    }
       .navigation.navbar {
        float: right;
        display: inherit !important;
        padding: 0;
        width: 100%;
    }
    .navigation .navbar-collapse {
        background: #3e93c3;
        padding: 20px;
        margin-top: 52px;
        position: absolute;
        width: 100%;
        margin-right: 20px;
        z-index: 999;
    }
    .navigation.navbar-dark .navbar-nav .nav-link {
        padding: 10px 0;
        color: #fff;
    }
    .navbar-dark .navbar-nav .nav-link:focus,
    .navbar-dark .navbar-nav .nav-link:hover {
        color: #eda911 !important;
    }
    .navigation.navbar-dark .navbar-toggler {
        border: inherit;
        float: right;
        padding-top: 6px;
    }

    .carousel-control-next-icon,
    .carousel-control-prev-icon {
        display: none;
    }
    .Call {
        display: none;
    }
    }
    @media (max-width: 575px) {
    .header {
        padding: 30px 0px 15px 0px;
    }
    .logo {
        text-align: center !important;
        padding-bottom: 6px;
        float: left;
    }
   
    .Call {
        display: none;
    }

    .navigation.navbar {
        float: right;
        display: inherit !important;
        padding: 0;
        width: 100%;
        margin-top: -45px;
    }
    .navigation .navbar-collapse {
        background: #3e93c3;
        padding: 20px;
        margin-top: 62px;
        position: absolute;
        width: 100%;
        margin-right: 20px;
        z-index: 999;
    }
    .navigation.navbar-dark .navbar-nav .nav-link {
        padding: 10px 0;
        color: #fff;
    }
    .navigation.navbar-dark .navbar-toggler {
        float: right;
        margin-right: 2px;
        border: inherit;
    }
    .navbar-dark .navbar-nav .nav-link:focus,
    .navbar-dark .navbar-nav .nav-link:hover {
        color: #eda911 !important;
    }
   

} */

</style>
