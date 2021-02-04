<template>
    <div class='container'>
        <div class="row justify-content-center">
            <div class="card-body">
                <error :errors="validationErrors" v-if="validationErrors">
                </error>
                    <div class="sm-12 t-row">
                        <label>Todo Name:</label>
                        <input class="text-center" type="text" name="name" placeholder="Name" value="todo.name"
                               v-model="todo.name">
                    </div>
                    <div class="sm-12 t-row">
                        <label>Created On:</label>
                        <strong class="text-center">{{ todo.created_at | formatDate }}</strong>
                    </div>
                    <div class="sm-12 t-row">
                        <label>Todo Status:</label>
                        <input type="text" v-model="todo.is_completed" hidden>
                        <strong class="text-center" v-if="todo.is_completed">Done</strong>
                        <strong class="text-center" v-else>In Progress</strong>
                    </div>
                    <div class='text-center'>
                    <span class='font-20 soehne'>
                        Todo Tasks List
                    </span>
                    </div>
                    <ul class="list-group">
                        <li class="list-group-item" v-for="task in todo.tasks" v-if="!task.is_disabled"
                            :key="task.id">
                            <div class="row">
                                <label>task name:</label>
                                <input class="col-8" type="text" v-model="task.name">
                                <label>task progress:</label>
                                <input class="col-2" type="checkbox" :id="task.id" v-model="task.is_completed">
                                <label :for="task.id">{{ task.is_completed ? 'Done' : 'In Progress' }}</label>
                                <strong class="col-2">{{ task.deadline | formatDate }}</strong>
                            </div>
                        </li>
<!--                        <li class="list-group-item" v-for="task in todo.tasks" v-if="task.is_disabled"-->
<!--                            :key="task.id">-->
<!--                            <div class="row">-->
<!--                                <strong class="col-8">{{ task.name }}</strong>-->
<!--                                <strong class="col-2">{{ task.is_completed ? 'Done' : 'Overdue' }}</strong>-->
<!--                                <strong class="col-2">{{ task.created_at | formatDate }}</strong>-->
<!--                            </div>-->
<!--                        </li>-->
                    </ul>
                    <div class="row">
                        <button type="button" class="col text-success font-weight-bold"
                                style="text-align: center" @click="saveTodo">Save</button>
                        <button type="button" class="col text-primary font-weight-bold"
                                style="text-align: center" @click="goTodos()">Back</button>
                        <button type="button" class="col text-danger font-weight-bold"
                                style="text-align: center" @click="deleteTodo">Delete</button>
                    </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from "axios";
import Error from "../Error";

export default {
    name: "Todo",
    components: {Error},
    data() {
        return {
            validationErrors: '',
            todo: {
                id: '',
                name: '',
                is_completed: '',
                created_at: '',
                tasks: '',
                tasks_delete: ''
            },
            tasks_delete: [100],
            checkedTodos: []
        }
    },
    methods: {
        async getTodo() {
            axios.defaults.baseURL = process.env.MIX_BASE_URL;
            await axios.get(`/api/todos/${this.$route.params.id}`, {
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'Authorization': 'Bearer ' + localStorage.getItem('access_token')
                }
            })
                .then(response => {
                    //console.log(response.data);
                    this.todo = response.data
                    //console.log(this.todo.tasks)
                })
                .catch(err => {
                    console.error(err)
                })
        },
        async saveTodo() {
            this.todo.tasks_delete = this.tasks_delete
            let parsedTodo = JSON.parse(JSON.stringify(this.todo))
            // let parsedTasks = JSON.parse(JSON.stringify(this.todo.tasks))
            // parsedTodo['tasks'].push(parsedTasks);
            //console.log(parsedTasks);
            console.log(JSON.stringify(parsedTodo));
            axios.defaults.baseURL = process.env.MIX_BASE_URL;
            await axios.put(`/api/todos/${this.todo.id}`, {
                    parsedTodo,
                    }, {
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'Authorization': 'Bearer ' + localStorage.getItem('access_token')
                        }
                })
                .then(response => {
                    console.log(response.data);
                })
                .catch(err => {
                    if (err.response.status === 422){
                        this.validationErrors = err.response.data.errors;
                    }
                    console.log(err)
                    console.error(err)
                })
        },
        deleteTodo() {
        },
        goTodos(){
            this.$router.push({ name: 'todoList'});
        },
    },
    mounted() {
        this.getTodo();
    }
}
</script>

<style scoped>

</style>
