<template>
    <DashboardNavbar></DashboardNavbar>
    <h1>Dashboard</h1>
</template>

<script>
import DashboardNavbar from '../../components/Dashboard/DashboardNavbar.vue';
export default {
    name: 'DashboardView',
    components: {
        DashboardNavbar
    },

    data() {
        return {
            token: localStorage.getItem('authToken') || nul
        }
    },

}
</script>

<style></style>