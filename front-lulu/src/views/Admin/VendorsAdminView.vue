<template>
    <VendorIndex></VendorIndex>
</template>

<script>
import axios from 'axios';
import VendorIndex from '../../components/Vendors/VendorIndex.vue';
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
    components: {
        VendorIndex
    },
    methods: {
        logout() {
            console.log(this.token);
            axios.post(`${import.meta.env.VITE_API_BASE_URL}/api/logout`, {
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