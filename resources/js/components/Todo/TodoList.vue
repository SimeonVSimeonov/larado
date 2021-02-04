<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-auto">
                <table class="table table-responsive">
                    <thead>
                    <tr>
                        <td style="text-align: center">Todo</td>
                        <td style="text-align: center">Completed</td>
                        <td style="text-align: center">Created</td>
                        <td style="text-align: center">Edit Todo</td>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="todo in todos" :key="todo.id">
                        <td>{{ todo.name }}</td>
                        <td v-if="todo.is_completed">Done</td>
                        <td v-else>In Progress</td>
                        <td>{{ todo.created_at | formatDate }}</td>
                        <td>
                            <router-link :to="{name: 'todo', params: {id:todo.id}}">Open</router-link>
                        </td>
                    </tr>
                    </tbody>
                </table>
                <div class='sm-12 text-center'>
                    <a href="#" class='font-20 soehne add-btn'>Add new</a>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
import axios from "axios";

export default {
    name: "TodoList",
    data() {
        return {
            todos: [],
        }
    },
    methods: {
        async getTodos() {
            axios.defaults.baseURL = process.env.MIX_BASE_URL;
            await axios.get('/api/todos/', {
                headers: {
                    'Content-Type' : 'application/json',
                    'Accept': 'application/json',
                    'Authorization' : 'Bearer ' + localStorage.getItem('access_token')
                }
            })
                .then(response => {
                    console.log(response.data);
                    this.todos = response.data
                })
                .catch(err => {
                    console.error(err)
                })
        },
    },
    mounted() {
        this.getTodos();
    }
}
</script>

<style scoped>

</style>
