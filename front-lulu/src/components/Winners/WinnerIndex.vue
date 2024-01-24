<template>
    <h5>Vencedores</h5>

    <table>
        <thead>
            <th>#</th>
            <th>Produto</th>
            <th>Menor Preço</th>
            <th>Vencedor</th>
        </thead>
        <tbody>
            <tr v-for="(product, index) in quotedProducts" :key="index">
                <td>{{ index }}</td>
                <td>{{ product.description }}</td>
                <td> {{ getMinPrice(product.id) }}</td>
                <td>{{ getVendorName(product.id) }}</td>
            </tr>
        </tbody>
    </table>
    <!-- <ul>
        <li v-for="(product, index) in quotedProducts" :key="index">
            {{ product.description }} - Vencedor: {{ getMinPrice(product.id) }}
        </li>
    </ul> -->
</template>

<script>
import axios from 'axios';
export default {
    name: "WinnerIndex",
    data() {
        return {
            token: localStorage.getItem('authToken') || null,
            quotedProducts: [],
            winnerProducts: [],
        }
    },
    methods: {
        async getWinnerProducts() {
            try {
                const response = await axios.get(`${import.meta.env.VITE_API_BASE_URL}/api/getLowestPrices`, {
                    headers: {
                        Authorization: `Bearer ${this.token}`,
                    },
                });

                if (Array.isArray(response.data)) {
                    this.winnerProducts = response.data;
                    console.log(response.data);
                } else {
                    console.error('A resposta do servidor não é um array:', response.data)
                }
            } catch (error) {
                console.error('Erro ao obter os preços mais baixos:', error);
            }
        },
        getMinPrice(productId) {
            const productPrices = this.winnerProducts.filter(price => price.product_id === productId);
            if (productPrices.length === 0 || isNaN(parseFloat(productPrices[0].min_price))) {
                return 'N/A';
            }

            const sortedPrices = productPrices.slice().sort((a, b) => parseFloat(a.min_price) - parseFloat(b.min_price));
            const minPrice = parseFloat(sortedPrices[0].min_price);
            const winningVendor = sortedPrices[0].vendor;

            // return `R$ ${minPrice.toFixed(2)} - ${winningVendor.name}`;
            return `R$ ${minPrice.toFixed(2)}`;
        },
        getVendorName(productId) {
            const productPrices = this.winnerProducts.filter(price => price.product_id === productId);
            if (productPrices.length === 0 || isNaN(parseFloat(productPrices[0].min_price))) {
                return 'N/A';
            }

            const sortedPrices = productPrices.slice().sort((a, b) => parseFloat(a.min_price) - parseFloat(b.min_price));
            const minPrice = parseFloat(sortedPrices[0].min_price);
            const winningVendor = sortedPrices[0].vendor;

            return winningVendor.name;

        },
        async getQuotedProducts() {


            axios.get(`${import.meta.env.VITE_API_BASE_URL}/api/getQuotedProducts`, {
                headers: {
                    'Authorization': `Bearer ${this.token}`
                }
            }).then((response) => {
                console.log(response.data);
                this.quotedProducts = response.data;
            })
        },
    },
    mounted() {
        this.getWinnerProducts();
        this.getQuotedProducts();
    }
}
</script>

<style></style>