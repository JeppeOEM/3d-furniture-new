<template>
    <div class="container d-flex justify-content-center align-items-center">
        <form @submit.prevent="register" class="form-container">
            <div class="form-group">
                <p class="register semi-big-text text-center">Register</p>
                <label for="name" class="label">Your Name</label>
                <input id="name" v-model="form.name" type="text" class="form-control" />
                <div v-if="form.errors.name" class="invalid-feedback">{{ form.errors.name }}</div>
            </div>
            <div class="form-group">
                <label for="email" class="label">E-mail</label>
                <input id="email" v-model="form.email" type="text" class="form-control" />
                <div v-if="form.errors.email" class="invalid-feedback">{{ form.errors.email }}</div>
            </div>
            <div class="form-group">
                <label for="password" class="label">Password</label>
                <input id="password" v-model="form.password" type="password" class="form-control" />
                <div v-if="form.errors.password" class="invalid-feedback">{{ form.errors.password }}</div>
            </div>
            <div class="form-group">
                <label for="password_confirmation" class="label">Confirm Password</label>
                <input id="password_confirmation" v-model="form.password_confirmation" type="password"
                    class="form-control" />
            </div>
            <div class="d-flex justify-content-center">
                <button class="inverse mt-4" type="submit">Create Account</button>
            </div>
            <div class="text-center">
             <a :href="route('login')"><p class="mt-4 text-sm">Already have an account? Click here</p></a>
            </div>
        </form>
    </div>
</template>

<style scoped>
p{
    margin-bottom: 0px;
}

.label{
    margin-bottom: 5px;
}
.form-group{
    padding-top: 10px;
}
.register {
    padding-top: 6rem;
}

.form-container {
    width: 100%;
    max-width: 350px;
}
</style>

<script setup>
import { useForm } from '@inertiajs/vue3'

const form = useForm({
    name: null,
    email: null,
    password: null,
    password_confirmation: null
})

const register = () => form.post(route('user-account.store'))
</script>