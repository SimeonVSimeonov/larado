<template>
    <header class='sm-12 text-center'>
        <div class='row justify-content-center'>
            <router-link :to="{ name: 'home' }">My To Do</router-link>
        </div>
        <menu>
            <logout class="float-right"></logout>
        </menu>
        <menu >
            <router-link :to="{ name: 'login' }">Login</router-link> |
            <router-link :to="{ name: 'register' }">Register</router-link>
        </menu>
    </header>
</template>

<script>

import Logout from "./auth/Logout";

export default {
    name: "Header",
    components: {Logout},
    data() {
        return {

        }
    },
    mounted() {
        this.isLogged();
    },
    methods: {
        isLogged(){
            return localStorage.getItem('access_token') === null;
        }
    }
}
</script>

<style scoped>

</style>
