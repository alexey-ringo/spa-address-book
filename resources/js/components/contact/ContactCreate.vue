<template>
  <!-- Horizontal Form -->
  <div class="card card-info">
    <div class="card-header">
      <h3 class="card-title">Новый контакт</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form class="form-horizontal" @submit.prevent="addContact">
      <div class="card-body">
        
        <div class="form-group">
          <label class="col-sm-4 control-label">Фамилия</label>
          <div class="col-sm-10">
            <input type="text" v-model="contact.surname" class="form-control" required placeholder="Фамилия">
          </div>
        </div>
        
        <div class="form-group">
          <label class="col-sm-4 control-label">Имя</label>
          <div class="col-sm-10">
            <input type="text" v-model="contact.name" class="form-control" required placeholder="Имя">
          </div>
        </div>
        
        <div class="form-group">
          <label class="col-sm-4 control-label">Отчество</label>
          <div class="col-sm-10">
            <input type="text" v-model="contact.second_name" class="form-control" placeholder="Отчество">
          </div>
        </div>
        
        <div class="form-group">
          <label class="col-sm-4 control-label">Телефон</label>
          <div class="col-sm-10">
            <input type="text" v-model="contact.phone" class="form-control" placeholder="Телефон">
          </div>
        </div>
        
        <div class="form-group">
          <label class="col-sm-4 control-label">Email</label>
          <div class="col-sm-10">
            <input type="text" v-model="contact.email" class="form-control" placeholder="Email">
          </div>
        </div>
        
      </div>
      <!-- /.card-body -->
  
      <div class="card-footer">
        <button class="btn btn-primary">Создать</button>
        <router-link :to="{name: 'contacts'}" class="btn btn-default float-right">Отмена</router-link>
      </div>
      <!-- /.card-footer -->
    </form>
  </div>
  <!-- /.card -->
</template>

<script>
  export default {
    data(){
      return {
        contact: {},
        message: '',
      }
    },
    mounted() {
      let token = localStorage.getItem('jwt')

      this.axios.defaults.headers.common['Content-Type'] = 'application/json';
      this.axios.defaults.headers.common['Authorization'] = 'Bearer ' + token;
    },
    methods: {
      addContact(){
        let uri = '/api/contacts';
        this.axios.post(uri, this.contact).then((response) => {
          if(response.data.message) {
            this.message = response.data.message;                            
            swal("Сохранение изменений", this.message, "success");
            this.$router.push({name: 'contacts'});  
          }
          else {
            swal("Ошибка", "Нет ответа от сервера при создании нового контакта", "error");
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
                this.$router.push({name: 'contacts'});
              }
            }//Ошибки валидации
            else {
              swal('Ошибка - ' + error.response.status, this.errMessageToStr(error.response.data), "error");
            }
          }
          else if(error.request) {
            //console.log(error.request.data);
          }
          else {
            swal('Ошибка', "Внутренняя ошибка сервера", "error");
            console.log('Внутренняя ошибка: ' + error.message);
            this.$router.push({name: 'contacts'});
          }
        });
      },
      errMessageToStr(errors) {
          let result = '';
          for(let key in errors) {
            errors[key].forEach(function(item){
              result += item + '; ';
            });
          }
          return result;
      },
    }
  }
</script>