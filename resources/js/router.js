import VueRouter from 'vue-router';

import Login from './components/auth/Login';
import Logout from './components/auth/Logout';

import Contacts from './components/contact/Contacts';
import ContactUpdate from './components/contact/ContactUpdate';
import ContactCreate from './components/contact/ContactCreate';


//import Users from './components/user/Users';
//import UserUpdate from './components/user/UserUpdate';
//import UserCreate from './components/user/UserCreate';


//Экспорт объекта VueRouter (который импортировали выше)
//В него передаем Литерал-Объект
export default new VueRouter({
    //В массиве routes в виде объектов будут перечислены маршруты (пути и связанные с ними конпоненты)
    routes : [
        
        {
            path: '/login',
            name: 'login',
            component: Login,
        },
        {
            path: '/logout',
            name: 'logout',
            component: Logout,
        },
        
        
        { path: '/',  name: 'contacts', component: Contacts },
        { path: '/new',  name: 'contact-create', component: ContactCreate },
        { path: '/:id',  name: 'contact-update', component: ContactUpdate },
        
    ],
    //Запись всех перемещений пользователя по переходам
    mode: 'history'
    
});