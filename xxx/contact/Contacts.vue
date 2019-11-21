<template>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Список контактов</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body table-responsive p-0">
            <table class="table table-hover table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Фамилия</th>
                        <th>Имя</th>
                        <th>Отчество</th>
                        <th>Телефон</th>
                        <th>Email</th>
                        <th>Редактировать</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="contact in contacts" :key="contact.id">
                        <td>{{ contact.surname  }}</td>
                        <td>{{ contact.name  }}</td>
                        <td>{{ contact.second_name }}</td>
                        <td>{{ contact.second_name }}</td>
                        <td>{{ contact.second_name }}</td>
                        <td>
                            <router-link :to="{name: 'contact-update', params: {id: contact.id}}" class="btn btn-xs btn-default">
                                Edit
                            </router-link>
                            <button class="btn btn-danger" @click.prevent = "deleteContact(contact.id)">Удалить</button>
                        </td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <th>Фамилия</th>
                        <th>Имя</th>
                        <th>Отчество</th>
                        <th>Телефон</th>
                        <th>Email</th>
                        <th>Редактировать</th>
                    </tr>
                </tfoot>
            </table>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
            
            <div class="row justify-content-center">
                <nav aria-label="...">
                    <ul class="pagination">
                        <!--<li class="page-item disabled">-->
                            <li class="page-item">
                            <!--<a class="page-link" href="#" tabindex="-1" @click="getPrevPage">Previous</a>-->
                            <button class="page-link" href="#" @click="getPrevPage">Previous</button>
                            <!--<span @click="getPrevPage">Предидущая</span>-->
                        </li>
                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                        <li class="page-item active">
                            <a class="page-link" href="#">2 <span class="sr-only">(current)</span></a>
                        </li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item">
                            <button class="page-link" href="#" @click="getNextPage">Next</button>
                            <!--<span @click="getNextPage">Следующая</span>-->
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
    <!-- /.card -->
</template>

<script>
    export default {
        data: function () {
            return {
                contacts: [],
                message: '',
                links: {
                    first: null,
                    last: null,
                    next: null,
                    prev: null
                },
                meta: {
                    current_page: null,
                    from: null,
                    last_page: null,
                    path: null,
                    per_page: null,
                    to: null,
                    total: null
                }
            }
        },
        mounted() {
            let token = localStorage.getItem('jwt')

            this.axios.defaults.headers.common['Content-Type'] = 'application/json'
            this.axios.defaults.headers.common['Authorization'] = 'Bearer ' + token
            
            this.getContacts();
        },
        methods: {
            getContacts() {
                let uri = '/api/contacts';
                this.axios.get(uri)
            	    .then((response) => {
            	        if(response.data.links) {
            	            this.links = response.data.links;
            	        }
            	        if(response.data.meta) {
            	            this.meta = response.data.meta;
            	        }
            	        if(response.data.data) {
                	        this.contacts = response.data.data;
            	        }
            	        else if (response.data.message) {
                            this.message = response.data.message;
                            swal("Ошибка", this.message, "error");
                            this.$router.push({name: 'contacts'});
                        }
                        else {
                            swal("Ошибка", "Нет ответа от сервера при первоначальном доступе к списку маршрутов процессов задач", "error");
                            this.$router.push({name: 'contacts'});
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
                            }         
                        }
                        else if(error.request) {
                        }
                        else {
                            swal('Ошибка', "Внутренняя ошибка сервера", "error");
                            this.$router.push({name: 'contacts'});
                        }
                    });
            },
            getNextPage() {
                let uri = this.links.next;
                console.log(uri);
                this.axios.get(uri)
            	    .then((response) => {
            	        if(response.data.links) {
            	            this.links = response.data.links;
            	        }
            	        if(response.data.meta) {
            	            this.meta = response.data.meta;
            	        }
            	        if(response.data.data) {
                	        this.contacts = response.data.data;
            	        }
            	        else if (response.data.message) {
                            this.message = response.data.message;
                            swal("Ошибка", this.message, "error");
                            this.$router.push({name: 'contacts'});
                        }
                        else {
                            swal("Ошибка", "Нет ответа от сервера при первоначальном доступе к списку маршрутов процессов задач", "error");
                            this.$router.push({name: 'contacts'});
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
                            }         
                        }
                        else if(error.request) {
                        }
                        else {
                            swal('Ошибка', "Внутренняя ошибка сервера", "error");
                            this.$router.push({name: 'contacts'});
                        }
                    });
            },
            getPrevPage() {
                let uri = this.links.prev;
                this.axios.get(uri)
            	    .then((response) => {
            	        if(response.data.links) {
            	            this.links = response.data.links;
            	        }
            	        if(response.data.meta) {
            	            this.meta = response.data.meta;
            	        }
            	        if(response.data.data) {
                	        this.contacts = response.data.data;
            	        }
            	        else if (response.data.message) {
                            this.message = response.data.message;
                            swal("Ошибка", this.message, "error");
                            this.$router.push({name: 'contacts'});
                        }
                        else {
                            swal("Ошибка", "Нет ответа от сервера при первоначальном доступе к списку маршрутов процессов задач", "error");
                            this.$router.push({name: 'contacts'});
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
                            }         
                        }
                        else if(error.request) {
                        }
                        else {
                            swal('Ошибка', "Внутренняя ошибка сервера", "error");
                            this.$router.push({name: 'contacts'});
                        }
                    });
                
            },
            deleteContact(id) {
                let uri = `/api/contacts/${id}`;
                if (confirm("Do you really want to delete it?")) {
                    this.axios.delete(uri)
                        .then((response) => {
                            if(response.data.data) {
                                this.contacts.splice(this.contacts.indexOf(id), 1);
                            }
                            else if (response.data.message) {
                                this.message = response.data.message;
                                swal("Ошибка", this.message, "error");
                            }
                            else {
                                swal("Ошибка", "Нет ответа от сервера при попытке удаления выбранного маршрута", "error");
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
                }
            }
        },
        computed: {
            paginateDisabledNext() {
                if(this.meta.current_page == this.meta.last_page) {
                    return true;
                }
            },
            paginateDisabledPrev() {
                if(this.meta.current_page == this.meta.from) {
                    return true;
                }
            }
        },
        beforeRouteEnter (to, from, next) { 
            if ( ! localStorage.getItem('jwt')) {
                return next('login')
            }

            next()
        }
    }
    
</script>