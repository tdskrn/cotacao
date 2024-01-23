<template>
    <h1>Ola {{ this.$store.state.user.name }}</h1>
    <button @click="logout()"> Sair</button>
    <QuotationsUserView />
</template>

<script>
import axios from 'axios';
import QuotationsUserView from '../components/Users/Quotations/QuotationsUserView.vue';
export default {
    components: {
        QuotationsUserView
    },
    data() {
        return {
            token: localStorage.getItem('authToken') || null,
        }
    },

    name: 'VendorsUserView',
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