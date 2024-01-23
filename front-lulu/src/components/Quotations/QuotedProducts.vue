<!-- QuotedProducts.vue -->
<template>
    <div>
        <h2>Produtos Cotados</h2>
        <ul>
            <li v-for="(product, index) in quotedProducts" :key="index">
                {{ product.description }} - Vencedor: {{ getMinPrice(product.id) }}
                <button @click="openProductPricesDialog(product.id)">Ver Preços</button>
            </li>
        </ul>
        <ProductPricesDialogVue :productPrices="selectedProductPrices" />
    </div>
</template>
  
<script>
import axios from 'axios';
import ProductPricesDialogVue from './ProductPricesDialogVue.vue';
import { on, emit } from '../../utils/event-bus';

export default {
    name: 'QuotedProducts',
    components: {
        ProductPricesDialogVue,
    },
    data() {
        return {
            lowestPrices: [],
            token: localStorage.getItem('authToken') || null,
            selectedProductPrices: [],
        };
    },
    props: {
        quotedProducts: Array,
    },

    methods: {
        async getLowestPrices() {
            try {
                const response = await axios.get(`${import.meta.env.VITE_API_BASE_URL}/api/getLowestPrices`, {
                    headers: {
                        Authorization: `Bearer ${this.token}`,
                    },
                });

                if (Array.isArray(response.data)) {
                    this.lowestPrices = response.data;
                } else {
                    console.error('A resposta do servidor não é um array:', response.data);
                }
            } catch (error) {
                console.error('Erro ao obter os preços mais baixos:', error);
            }
        },
        getMinPrice(productId) {
            const productPrices = this.lowestPrices.filter(price => price.product_id === productId);
            if (productPrices.length === 0 || isNaN(parseFloat(productPrices[0].min_price))) {
                return 'N/A';
            }

            const sortedPrices = productPrices.slice().sort((a, b) => parseFloat(a.min_price) - parseFloat(b.min_price));
            const minPrice = parseFloat(sortedPrices[0].min_price);
            const winningVendor = sortedPrices[0].vendor;

            return `R$ ${minPrice.toFixed(2)} - ${winningVendor.name}`;
        },
        openProductPricesDialog(productId) {
            const productPrices = this.lowestPrices.filter(price => price.product_id === productId);
            this.selectedProductPrices = productPrices;
            emit('open-product-prices-dialog', productId);
        },
    },
    async mounted() {
        await this.getLowestPrices();
    },
};
</script>
  
<style></style>
  