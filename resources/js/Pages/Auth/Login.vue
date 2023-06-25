<template>
    <div class="container background d-flex justify-content-center ">
        <form class="form-container" @submit.prevent="form.post(route('login.store'))">
            <p class="login semi-big-text text-center">Login</p>
            <div class="form-group">
                                <label for="name" class="label text-normal">Email:</label>
                <input id="email" v-model="form.email" type="text" class="form-control" placeholder="Email" />
                <div v-if="form.errors.email" class="invalid-feedback">{{ form.errors.email }}</div>
            </div>
            <div class="form-group">
                                <label for="name" class="label text-normal">Password</label>
                <input id="password" v-model="form.password" type="password" class="form-control" placeholder="Password" />
                <div v-if="form.errors.password" class="invalid-feedback">{{ form.errors.password }}</div>
            </div>
            <div class="d-flex justify-content-center ">
                <button class="inverse mt-4" type="submit">Login</button>
            </div>
            <div class="text-center">
              <a :href="route('user-account.create')">  <p class="mt-4 text-sm">Need an account? Click here</p></a>
            </div>
        </form>
    </div>
</template>

<style scoped>
p{
    margin-bottom: 0px;
}
.label{
    padding-bottom: 5px;
}

.form-group{
    padding-top: 10px;
}
.container {
    display: flex;

    height: 100vh;
}

.form-container {
    width: 100%;
    max-width: 350px;
}

.login {
    margin-top: 6rem;
}
</style>

<script setup>
import { useForm, Link } from '@inertiajs/vue3'

const form = useForm({
    email: null,
    password: null
})

const configForm = useForm({
    configuration: null
})

</script>