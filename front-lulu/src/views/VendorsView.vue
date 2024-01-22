<template>
    <h1>Vendors View</h1>
    <button @click="logout()">Logout</button>
</template>

<script>
import axios from 'axios';
export default {
    name: "VendorsView",
    data() {
        return {
            token: null
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
    }
}
</script>

<style></style>