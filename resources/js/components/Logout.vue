<template>
    
    <div class="container mt-3">

        <h1> Are you sure you want to log out?</h1>
        <button @click.prevent="logout()"> Yes </button>
    </div>
</template>

<script>
export default {

    

    methods: {
        logout() {
            localStorage.removeItem('laravel-arb-nikko');

            this.$router.push('/login')
        }
    }

}
</script>

<style>

</style>