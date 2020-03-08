<template>
    <div class="container mt-3">
        <form @submit.prevent="login()">
            <div class="form-group">
                <label for="exampleInputEmail1">Email address</label>
                <input v-model="data.email" type="email" class="form-control" id="exampleInputEmail1"
                    aria-describedby="emailHelp" placeholder="Enter email">
    
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input v-model="data.password" type="password" class="form-control" id="exampleInputPassword1"
                    placeholder="Password">
            </div>
            <button :disabled="status === true || loading === true" type="submit" class="btn btn-primary">Submit</button>
            <small class="text-danger" v-if="status === false">Wrong credentials</small>
        </form>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                data: {},
                status: '',
                loading: '',
            }
        },

        methods: {
            login() {
                    this.loading = true;
                // get the redirect object
                var redirect = this.$auth.redirect()
                var app = this
                this.$auth.login({
                    params: {
                        email: this.data.email,
                        password: this.data.password
                    },
                    success: function () {
                        this.loading = false;
                        this.status = true;
                        // handle redirection
                        const redirectTo = redirect ? redirect.from.name : this.$auth.user().role === 1 ?
                            'roles' : 'Expense'
                        this.$router.push({
                            name: redirectTo
                        })
                    },
                    error: function () {
                        this.status = false
                        this.loading = false;
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
