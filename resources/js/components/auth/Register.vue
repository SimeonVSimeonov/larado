<template>
    <div class='sm-12'>
        <div class='row'>
            <div class='box-aline-center full-vh sm-12 soehne'>
                <div class='login-form lg-offset-3 lg-5 md-offset-2 md-8 sm-offset-1 sm-10'>
                    <form @submit.prevent="logIn">
                        <div class="sm-12">
                            <input id="name" type="text" name="name"
                                   placeholder="Name"
                                   value="" required autofocus v-model="user.name">
                        </div>
                        <div class="sm-12">
                            <input id="email" type="email" name="email"
                                   placeholder="E-mail"
                                   value="" required autocomplete="email" v-model="user.email">
                        </div>
                        <div class="sm-12">
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                                    placeholder="Password"
                                    name="password" required autocomplete="current-password" v-model="user.password">
                        </div>

                        <div class="sm-12">
                            <input id="confirmPassword" type="password" class="form-control @error('confirm_password') is-invalid @enderror"
                                    placeholder="Confirm"
                                    name="confirm_password" required v-model="user.confirm_password">
                        </div>

                        <div class="sm-12">
                            <button type="submit" class="btn hollow sm-12">Register</button>
                        </div>
                    </form>
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
                axios.post('/api/login', {
                    headers: {
                        'Accept': 'application/json'
                    },
                    params: {
                        "email": this.user.email,
                        "password": this.user.password
                    }
                })
                .then(response => {
                    console.error(response)
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
