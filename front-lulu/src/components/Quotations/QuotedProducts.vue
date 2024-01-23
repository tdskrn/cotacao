<template>
    <div>
        <h2>Produtos Cotados</h2>
        <ul>
            <li v-for="(product, index) in quotedProducts" :key="index">
                {{ product.description }}
            </li>
        </ul>
    </div>
</template>

<script>
export default {
    name: 'QuotedProducts',
    data() {
        return {}
    },
    props: {
        quotedProducts: Object,
    },

}
</script>

<style></style>