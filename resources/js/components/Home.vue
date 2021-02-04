<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card-body">
                    <h1 class="text-center" >
                        <router-link :to="{ name: 'todoList' }">Go To Do</router-link>
                    </h1>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import store from "../store";
    import Header from "./Header";

    export default {
        name: "Home",
        store,
        components: {Header},
        mounted() {

        }
    }
</script>

<style scoped>

</style>
