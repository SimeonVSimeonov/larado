<template>
    <div>
        <Header></Header>
        <router-view></router-view>
    </div>
</template>

<script>
import Header from "./Header";
import store from '../store'

export default {
    name: "App",
    store,
    components: {Header}
}
</script>

<style scoped>

</style>
