import Vue from 'vue';
import VueRouter from 'vue-router';
import Home from "./components/Home";
import login from "./components/auth/Login";
import Register from "./components/auth/Register";
import TodoList from "./components/Todo/TodoList";

Vue.use(VueRouter);

export default new VueRouter({
    routes: [
        {path: '/', name: 'home', component: Home},
        {path: '/login', name: 'login', component: login},
        {path: '/register', name: 'register', component: Register},
        {path: '/my-todos', name: 'todoList', component: TodoList}
    ],
    mode: 'history'
});
