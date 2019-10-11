// import Home from './components/Home.vue';
import Hobby from './components/Hobby.vue';
import Home from './components/Home.vue';
import Register from './components/Register.vue';
import Login from './components/Login.vue';
import Add_Hobby from './components/Add_Hobby.vue';
import Edit_Hobby from './components/Edit_Hobby.vue';

const routes = [
    { path: '/', component: Home,name:'Home' },
    { path: '/register', component: Register },
    { path: '/login', component: Login,name:'Login' },
    { path: '/hobby', component: Hobby,name:'Hobby'},
    { path: '/add-hobby', component: Add_Hobby,name:'Add_Hobby'},
    { path: '/edit-hobby', component: Edit_Hobby,name:'Edit_Hobby'},
];

export default routes