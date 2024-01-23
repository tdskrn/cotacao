<template>
    <h4>Seja bem vindo sr {{ user.name }}</h4>
    <ProductIndex />
</template>

<script>

import ProductIndex from '../../components/Products/ProductIndex.vue';
export default {
    name: 'ProductsView',
    components: {
        ProductIndex
    },

    data() {
        return {

        }
    },

    methods: {},

    computed: {
        user() {
            return this.$store.state.user;
        }
    }

}
</script>

<style></style>