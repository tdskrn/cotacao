<template>
    <DashboardNavbarVue></DashboardNavbarVue>
    <button @click="newQuotation()">Create Quotation</button>
    <div>Lista cotacoes</div>
    <table>
        <thead>
            <th>#</th>
            <th>Data Inicio</th>
            <th>Data fim</th>
            <th>Status</th>
            <th>Actions</th>
        </thead>
        <tbody>
            <tr v-for="(quote, index) in quotes" :key="index">

                <td>{{ index }}</td>
                <td>{{ formatDate(quote.start_date) }}</td>
                <td>{{ formatDate(quote.end_date) }}</td>
                <td>{{ quote.status }}</td>
                <td>
                    <button @click="getQuotedProducts(quote)">
                        Open
                    </button>
                </td>
            </tr>
        </tbody>
    </table>
    <NewQuotationModalVue v-show="editMode"></NewQuotationModalVue>
    <QuotedProductsVue v-if="selectedQuotation" :quotedProducts="quotationProducts" />
</template>

<script>
import axios from 'axios'
import { format } from 'date-fns';
import DashboardNavbarVue from '../Dashboard/DashboardNavbar.vue'
import NewQuotationModalVue from './NewQuotationModal.vue'
import QuotedProductsVue from './QuotedProducts.vue';


export default {
    name: 'QuotationIndex',
    data() {
        return {
            editMode: false,
            quotes: {},
            quotationProducts: {},
            token: localStorage.getItem('authToken') || null,
            selectedQuotation: null,
        }
    },
    components: {
        DashboardNavbarVue,
        NewQuotationModalVue,
        QuotedProductsVue,
    },
    methods: {

        getQuotes(url) {
            axios.get(url || `${import.meta.env.VITE_API_BASE_URL}/api/getQuotes`, {
                headers: {
                    'Authorization': `Bearer ${this.token}`
                }
            }).then((response) => {
                this.quotes = response.data.data;
            });
        },

        newQuotation() {
            this.editMode = true;
            document.getElementById('modal').showModal();
        },

        async getQuotedProducts(quote) {
            this.selectedQuotation = quote;

            axios.get(`${import.meta.env.VITE_API_BASE_URL}/api/getQuotedProducts`, {
                headers: {
                    'Authorization': `Bearer ${this.token}`
                }
            }).then((response) => {
                console.log(response.data);
                this.quotationProducts = response.data;
            })
        },

        formatDate(date) {
            return format(new Date(date), 'dd/MM/yyyy');
        },


    },

    mounted() {
        this.getQuotes();
    }
}
</script>

<style></style>