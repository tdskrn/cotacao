<template>
    <div>
        <table>
            <thead>
                <th>#</th>
                <th>Description</th>
                <th>Unity</th>
                <th>Price</th>
                <th>Actions</th>
            </thead>
        </table>
        <tbody>
            <tr v-for="(product, index) in quotedProducts" :key="index">
                <td> {{ index }}</td>
                <td> {{ product.description }}</td>
                <td> {{ product.unity }}</td>
                <td> <input v-model="quoteProducts[index].price" type="number" step="0.01"> {{ vendorPrices[product.id] ?
                    '- Enviado : ' + vendorPrices[product.id] : '' }}</td>
                <td>
                    <button @click="sendPrice(product, index)" @submit.prevent> {{ vendorPrices[product.id] ?
                        'Atualizar Preço' : 'Enviar Preço' }}
                    </button>
                </td>
            </tr>
        </tbody>
    </div>
</template>

<script>
import axios from 'axios';
export default {

    name: "QuotationsUserView",
    data() {
        return {
            quotedProducts: [],
            quoteProducts: [],
            vendorPrices: {},
            token: localStorage.getItem('authToken') || null,
            quoteId: null,
        }
    },
    methods: {
        async getQuotedProducts(url) {
            axios.get(url || `${import.meta.env.VITE_API_BASE_URL}/api/user/getQuotedProducts`, {
                headers: {
                    'Authorization': `Bearer ${this.token}`
                }
            }).then((response) => {
                console.log(response);
                this.quotedProducts = response.data;

                this.quoteProducts = this.quotedProducts.map(product => ({ price: '' }));
                this.getVendorPricesForQuote();







            });
        },

        async getVendorPricesForQuote() {
            axios.get(`${import.meta.env.VITE_API_BASE_URL}/api/user/getVendorPrices/`, {
                headers: {
                    'Authorization': `Bearer ${this.token}`
                }
            }).then((response) => {
                console.log(response);
                this.vendorPrices = response.data;
            });
        },
        sendPrice(product, index) {
            axios.post(`${import.meta.env.VITE_API_BASE_URL}/api/user/saveQuotePrice`, {
                vendor_id: this.$store.state.user.id,
                product_id: product.id,
                price: this.quoteProducts[index].price,

            }, {
                headers: {
                    'Authorization': `Bearer ${this.token}`
                }
            }).then((response) => {
                this.getVendorPricesForQuote();
            });
        }
    },
    async mounted() {
        await this.getQuotedProducts();
        if (this.quoteId) {
            await this.getVendorPricesForQuote();
        }

    }
}
</script>

<style></style>