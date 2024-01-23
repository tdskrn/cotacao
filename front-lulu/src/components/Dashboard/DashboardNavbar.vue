<template>
    <nav>
        <router-link to="/products"> Produtos</router-link>
        <router-link to="/vendors-admin"> Vendedores</router-link>
        <router-link to="/quotations"> Cotações</router-link>

        <button @click="logout()">
            Logout
        </button>

    </nav>
</template>

<script>
import axios from 'axios';
export default {
    name: 'DashboardNavBar',
    data() {
        return {
            token: localStorage.getItem('authToken') || nul
        }
    },
    methods: {
        checkAuthentication() {
            const authToken = localStorage.getItem('authToken');
            console.log('Token', authToken);
            if (!authToken) {
                this.$router.push('/login');
            }
        },

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

    mounted() {
        this.checkAuthentication();
    }

}
</script>

<style></style>