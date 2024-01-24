<template>
    <DashboardNavbar />
    <WinnerIndex />
</template>

<script>
import DashboardNavbar from '../../components/Dashboard/DashboardNavbar.vue';
import WinnerIndex from '../../components/Winners/WinnerIndex.vue';
export default {
    name: "WinnersView",
    components: {
        DashboardNavbar,
        WinnerIndex
    }
}
</script>

<style></style>