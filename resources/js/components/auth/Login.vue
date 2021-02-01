<template>
    <div class='sm-12'>
        <div class='row'>
            <div class='box-aline-center full-vh sm-12 soehne'>
                <div class='login-form lg-offset-3 lg-5 md-offset-2 md-8 sm-offset-1 sm-10'>
                    <div v-if="errors"
                         v-text="errors"
                         class='alert alert-danger sm-12'>

                    </div>
                    <form @submit.prevent="logIn">
                        <div class="sm-12">
                            <input id="email" type="email" name="email"
                                   placeholder="E-Mail"
                                   value="" required autocomplete="email" autofocus v-model="$v.email.$model">
                        </div>
                        <div class="sm-12">
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                                    placeholder="Password"
                                    name="password" required autocomplete="current-password" v-model="password">
                        </div>
                        <div class="sm-12">
                            <button type="submit" class="btn hollow sm-12">Login</button>
                        </div>
                    </form>
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
                    localStorage.setItem('access_token', token);
                    this.$router.push({ name: 'dashboard'});
                })
                .catch(err => {
                    this.errors = err.response.data
                })

            }
        },
        beforeCreate() {
            if(localStorage.access_token !== undefined) {
                this.$router.push({ name: 'dashboard'});
            }
        },
        mounted() {

        }
    }
</script>
