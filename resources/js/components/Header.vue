<template>
    <header class='sm-12 text-center'>
        <div class='row box-aline-center'>
            <div class='font-26 sm-12 soehne-mono'>
                <router-link :to="{ name: 'home' }">My To Do</router-link>
            </div>
        </div>
        <menu v-show="this.$route.name === 'my-todo'">
        </menu>
        <menu v-show="this.$route.name === 'home'">
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
    mounted() {

    }
}
</script>

<style scoped>

</style>
