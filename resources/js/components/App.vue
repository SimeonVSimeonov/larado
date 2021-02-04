<template>
    <div>
        <Header></Header>
        <router-view></router-view>
    </div>
</template>

<script>
import Error from "./Error";
import Header from "./Header";
import store from '../store'

export default {
    name: "App",
    store,
    components: {Header, Error}
}
</script>

<style scoped>

</style>
