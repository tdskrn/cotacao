<!-- ProductPricesDialogVue.vue -->
<template>
    <dialog id="productPricesDialog">
        <p>Preços do Produto</p>
        <div id="content-dialog">
            <ul>
                <li v-for="(price, index) in productPrices" :key="index">
                    {{ price.vendor.name }}: R$ {{ formatPrice(price.price) }}
                </li>
            </ul>
            <button @click="closeDialog">Fechar</button>
        </div>
    </dialog>
</template>
  
<script>
import axios from 'axios';
import { on } from '../../utils/event-bus';

export default {
    name: 'ProductPricesDialogVue',
    data() {
        return {
            token: localStorage.getItem('authToken') || null,
            productPrices: [],
        };
    },
    methods: {
        async openDialog(productId) {
            await this.loadProductPrices(productId);
            const dialog = document.getElementById('productPricesDialog');
            dialog.showModal();
        },
        async loadProductPrices(productId) {
            try {
                const response = await axios.get(`${import.meta.env.VITE_API_BASE_URL}/api/getProductPrices/${productId}`, {
                    headers: {
                        Authorization: `Bearer ${this.token}`,
                    },
                });

                if (Array.isArray(response.data)) {
                    this.productPrices = response.data;
                } else {
                    console.error('A resposta do servidor não é um array:', response.data);
                }
            } catch (error) {
                console.error('Erro ao carregar os preços do produto:', error);
            }
        },
        formatPrice(price) {
            const numericPrice = parseFloat(price);
            if (!isNaN(numericPrice)) {
                return numericPrice.toFixed(2);
            } else {
                return 'N/A';
            }
        },
        closeDialog() {
            const dialog = document.getElementById('productPricesDialog');
            dialog.close();
        },
    },
    mounted() {
        on('open-product-prices-dialog', (productId) => {
            this.openDialog(productId);
        });
    },
};
</script>
  
<style scoped>
/* Estilos opcionais para personalizar o diálogo */
</style>
  