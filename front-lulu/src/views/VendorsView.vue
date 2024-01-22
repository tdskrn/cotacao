<template>
    <h4>Seja bem vindo sr {{ user.name }}</h4>
    <h1>Vendors View</h1>
    <button @click="logout()">Logout</button>
</template>

<script>
import axios from 'axios';
export default {
    name: "VendorsView",
    data() {
        return {
            token: null,
            user: {
                name: '',
                email: '',
            }
        }
    },
    methods: {
        logout() {
            console.log(this.token);
            axios.post(`${import.meta.env.VITE_API_BASE_URL}/api/logout`, null, {
                headers: {
                    'Authorization': `Bearer ${this.token}`
                }
            }).then((response) => {
                console.log(response.data)
                localStorage.removeItem('authToken');
                this.$router.push('/login');

            }).catch((error) => {
                console.log(error)
                localStorage.removeItem('authToken');
                this.$router.push('/login');
            })
        }
    },
    computed: {
        user() {
            return this.$store.state.user;
        }
    }
}
</script>

<style></style>