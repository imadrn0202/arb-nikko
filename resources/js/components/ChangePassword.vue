<template>
    <div class="container mt-3">
        <form @submit.prevent="changepassword()">

            <div class="form-group">
                <label for="exampleInputPassword1">New Password</label>
                <input v-model="data.password" type="password" class="form-control" id="exampleInputPassword1"
                    placeholder="Password">
            </div>
            <button :disabled="loading === true" type="submit" class="btn btn-primary">Change Password</button>
            <small class="text-danger" v-if="status === false">Wrong credentials</small>
            <small class="text-success" v-if="status === true">Successfully Changed Password</small>
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
            async changepassword() {
              this.loading = true;
              this.data['id'] = this.$auth.user().id;
                await axios.put('/auth/changepassword', this.data).then(response => {
                    this.message = response;
                    this.status = true;
                    this.loading = false

                }).catch(error => {
                    this.status = false;
                    this.loading = false
                });
            }
        }
    }


</script>

<style>

</style>
