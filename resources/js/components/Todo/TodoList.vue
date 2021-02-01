<template>
    <div class='sm-12'>
        <div class='row'>
            <div class="sm-12 col">
                <div class="admin-wrap sm-12">
                    <table class='sm-12 font-20 soehne'>
                        <thead>
                        <tr>
                            <td>ID</td>
                            <td>Todo</td>
                            <td>Completed</td>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="todo in todos" :key="todo.id">
                            <td>{{todo.id}}</td>
                            <td>{{todo.name}}</td>
                            <td>{{todo.completed}}</td>
                        </tr>
                        </tbody>
                    </table>
                    <div class='sm-12 text-center'>
                        <a href="#" class='font-20 soehne add-btn'>Add new</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "TodoList",
    data() {
        return {
            todos: [
                {id:1, name:"name", completed:"completed"},
                {id:2, name:"name2", completed:"completed2"}
            ],
        }
    }
}
</script>

<style scoped>

</style>
