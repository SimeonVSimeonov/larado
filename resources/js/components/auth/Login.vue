<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <div v-if="errors"
                             v-text="errors"
                             class='alert alert-danger sm-12'>

                        </div>
                        <form @submit.prevent="logIn">
                            <div class="text-center">
                                <input id="email" type="email" name="email"
                                       placeholder="E-Mail"
                                       value="" required autocomplete="email" autofocus v-model="$v.email.$model">
                            </div>
                            <div class="text-center">
                                <input id="password" type="password"
                                       placeholder="Password"
                                       name="password" required autocomplete="current-password" v-model="password">
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn hollow sm-12">Login</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

    import axios from 'axios';

    import { required,email,minLength } from 'vuelidate/lib/validators'
    import Vuelidate from 'vuelidate'

    export default {
        name: 'LoginForm',
        data() {
            return {
                email: '',
                password: '',
                errors: ''
            }
        },
        validations: {
            email: {
                required,
                email
            },
            password: {
                required,
                minLength: minLength(3)
            }
        },
        methods: {
            logIn() {
                axios.post('/api/login', {
                    email: this.email,
                    password: this.password,
                    headers: {
                        'Content-Type' : 'application/json',
                        'Accept': 'application/json',
                    }
                })
                .then(response => {
                    const token = response.data.access_token
                    this.$store.commit('addToken', token);
                    localStorage.setItem('access_token', token);
                    this.$router.push({ name: 'todoList'});
                })
                .catch(err => {
                    this.errors = err.response.data
                })

            }
        },
        beforeCreate() {
            if(localStorage.access_token !== undefined) {
                this.$router.push({ name: 'my-todo'});
            }
        },
        mounted() {

        }
    }
</script>
