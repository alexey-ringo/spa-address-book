<template>
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand bg-white navbar-light border-bottom">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      
      <!--
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
      </li>
      -->
      
      <li class="nav-item d-none d-sm-inline-block">
        <router-link :to="{ name: 'contacts' }" class="nav-link" v-if="isLoggedIn">Список контактов</router-link>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <router-link :to="{ name: 'contact-create' }" class="nav-link" v-if="isLoggedIn">Новый контакт</router-link>
      </li>
    </ul>

    <!-- SEARCH FORM -->
    <form class="form-inline ml-3">
      <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" type="search" v-model="keywordsSurname" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
        <!--  <button class="btn btn-navbar" type="submit"> -->
        <!--  <button type="button" class="btn btn-info btn-flat" @click="refreshResults">Обновить</button> -->
            <i class="fa fa-search"></i>
          </button>
        </div>
      </div>
    </form>
    

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Messages Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="fa fa-comments-o"></i>
          <span class="badge badge-danger navbar-badge">3</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="" alt="User Avatar" class="img-size-50 mr-3 img-circle">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  Brad Diesel
                  <span class="float-right text-sm text-danger"><i class="fa fa-star"></i></span>
                </h3>
                <p class="text-sm">Call me whenever you can...</p>
                <p class="text-sm text-muted"><i class="fa fa-clock-o mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="" alt="User Avatar" class="img-size-50 img-circle mr-3">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  John Pierce
                  <span class="float-right text-sm text-muted"><i class="fa fa-star"></i></span>
                </h3>
                <p class="text-sm">I got your message bro</p>
                <p class="text-sm text-muted"><i class="fa fa-clock-o mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="" alt="User Avatar" class="img-size-50 img-circle mr-3">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  Nora Silvester
                  <span class="float-right text-sm text-warning"><i class="fa fa-star"></i></span>
                </h3>
                <p class="text-sm">The subject goes here</p>
                <p class="text-sm text-muted"><i class="fa fa-clock-o mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
        </div>
      </li>
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="fa fa-bell-o"></i>
          <span class="badge badge-warning navbar-badge">15</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header">15 Notifications</span>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fa fa-envelope mr-2"></i> 4 new messages
            <span class="float-right text-muted text-sm">3 mins</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fa fa-users mr-2"></i> 8 friend requests
            <span class="float-right text-muted text-sm">12 hours</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fa fa-file mr-2"></i> 3 new reports
            <span class="float-right text-muted text-sm">2 days</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#">
          <i class="fa fa-th-large"></i>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Data Tables</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Data Tables</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">
            
            <router-view v-bind:searchResults="resultContacts"></router-view>

        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 3.0.0-alpha
    </div>
    <strong>Copyright &copy; 2014-2018 <a href="http://adminlte.io">AdminLTE.io</a>.</strong> All rights
    reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
    <div class="p-3">
      <router-link :to="{ name: 'logout' }" class="nav-link" v-if="isLoggedIn">Выход</router-link>
    </div>
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
</template>

<script>
    export default {
        data(){
            return {
                isLoggedIn : null,
                name : null,
                loggedUser : {},
                loggedUserName2: '',
                keywordsSurname: '',
                resultContacts: [],
            }
        },
        mounted() {
            this.isLoggedIn = localStorage.getItem('jwt');
            this.name = localStorage.getItem('user');
            this.axios.defaults.headers.common['Content-Type'] = 'application/json'
            this.axios.defaults.headers.common['Authorization'] = 'Bearer ' + this.isLoggedIn
            
            this.getLoggedUser();
        },
        watch: {
          keywordsSurname(after, before) {
            if(this.keywordsSurname.length > 2) {
              this.fetchSurname();
            }
          }
        },
        methods: {
          getLoggedUser() {
            let uri = '/api/logged-user';
            this.axios.get(uri)
            	.then((response) => {
            	  if(response.data.data) {
                	this.loggedUser = response.data.data;
                	this.loggedUserName2 = response.data.data.name;
            	  }
            	  else if (response.data.message) {
                  this.message = response.data.message;
                  swal("Ошибка", this.message, "error");
                }
                else {
                  swal("Ошибка", "Нет ответа от сервера при первоначальном входе в систему", "error");
                }
              })
              .catch(error => {
                if(error.response) {
                  if(error.response.data.message) {
                    if(error.response.status == 401) {
                      if (localStorage.getItem('jwt')) {
                        localStorage.removeItem('jwt');
                        this.$router.push({name: 'login'});
                      }
                    }
                    else {
                      swal('Ошибка - ' + error.response.status, error.response.data.message, "error");
                    }
                  }         
                }
                else if(error.request) {
                }
                else {
                  swal('Ошибка', "Внутренняя ошибка сервера", "error");
                }
              });
          },
          fetchSurname() {
          let uri = '/api/search-customer';
          this.axios.get(uri, { params: { keywords: this.keywordsSurname }})
            .then((response) => {
              if(response.data.data) {
                this.resultContacts = response.data.data;
              }
              else {
                this.resultContacts = [];
              }
            })
            .catch(e => {
          	  //console.log(e);
          	  swal('Ошибка', "Внутренняя ошибка сервера", "error");
            });
          },
        },
        computed: {
          loggedUserName() {
            return this.loggedUser.name;
          }
        },
        beforeRouteEnter (to, from, next) { 
            if (!localStorage.getItem('jwt')) {
                return next({name: 'login'});
            }

            next();
        }
        
    }
</script>