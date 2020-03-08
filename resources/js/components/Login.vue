<template>
    <div class="container mt-3">
        <form @submit.prevent="login()">
            <div class="form-group">
                <label for="exampleInputEmail1">Email address</label>
                <input v-model="data.email" type="email" class="form-control" id="exampleInputEmail1"
                    aria-describedby="emailHelp" placeholder="Enter email">
                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone
                    else.</small>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input v-model="data.password" type="password" class="form-control" id="exampleInputPassword1"
                    placeholder="Password">
            </div>
            <div class="form-check">
                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                <label class="form-check-label" for="exampleCheck1">Check me out</label>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                data: {},
                hasError: false
            }
        },

        methods: {
            login() {
                // get the redirect object
                var redirect = this.$auth.redirect()
                var app = this
                this.$auth.login({
                    params: {
                        email: this.data.email,
                        password: this.data.password
                    },
                    success: function () {
                        // handle redirection
                        const redirectTo = redirect ? redirect.from.name : this.$auth.user().role === 1 ?
                            'roles' : 'roles'
                        this.$router.push({
                            name: redirectTo
                        })
                    },
                    error: function () {
                        app.has_error = true
                    },
                    rememberMe: true,
                    fetchUser: true
                })
            }
        }
    }


</script>

<style>

</style>
