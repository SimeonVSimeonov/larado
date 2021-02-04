<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                    <form @submit.prevent="logIn">
                        <div class="text-center">
                            <input id="name" type="text" name="name"
                                   placeholder="Name"
                                   value="" required autofocus v-model="user.name">
                        </div>
                        <div class="text-center">
                            <input id="email" type="email" name="email"
                                   placeholder="E-mail"
                                   value="" required autocomplete="email" v-model="user.email">
                        </div>
                        <div class="text-center">
                            <input id="password" type="password"
                                    placeholder="Password"
                                    name="password" required autocomplete="current-password" v-model="user.password">
                        </div>

                        <div class="text-center">
                            <input id="confirmPassword" type="password"
                                    placeholder="Confirm"
                                    name="password_confirmation" required v-model="user.confirm_password">
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn hollow sm-12">Register</button>
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

    export default {
        name: 'RegisterForm',
        data() {
            return {
                user: {
                    name: '',
                    email: '',
                    password: '',
                    confirm_password: ''
                },

            }
        },
        methods: {
            logIn() {
                axios.post('/api/register', {
                    name: this.user.name,
                    email: this.user.email,
                    password: this.user.password,
                    password_confirmation: this.user.confirm_password

                },{
                    headers: {
                        'Content-Type' : 'application/json',
                        'Accept' : 'application/json',
                    }
                })
                .then(response => {
                    const token = response.data.access_token
                    localStorage.setItem('access_token', token);
                })
                .catch(err => {
                    console.error(err)
                })

            }
        },
        mounted() {

        }
    }
</script>
