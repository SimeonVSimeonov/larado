<template>
    <a @click.prevent="logout()">Logout</a>
</template>

<script>
    import axios from "axios";

    export default {
        name: "Logout",
        methods: {
            logout() {
                axios.defaults.baseURL = process.env.MIX_BASE_URL;
                axios.post('api/logout', {}, {
                    headers: {
                        'Content-Type' : 'application/json',
                        'Accept': 'application/json',
                        'Authorization' : 'Bearer ' + localStorage.getItem('access_token')
                    }
                }).then(response => {
                    localStorage.clear();
                    this.$router.push({ name: 'login'});
                }).catch(err => {
                    console.error(err.response);
                })
            }
        }
    }
</script>

<style scoped>

</style>
