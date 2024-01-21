

<template>
    <div class="search-bar">
        <input v-model="searchTerm" placeholder="Digite para pesquisar" />
        <button @click="search">Pesquisar</button>
    </div>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Description</th>
                <th>Unity</th>
                <th>Is Quoted</th>
                <th> Actions</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="(product, index) in products" :key="index">
                <td>{{ calculateItemNumber(index) }}</td>
                <td>{{ product.description }}</td>
                <td>{{ product.unity }}</td>
                <td> {{ product.isQuoted === 1 ? 'Sim' : 'Não' }}</td>
                <td>
                    <button @click="editProduct(product)">
                        Edit
                    </button>
                    <button @click="confirmDeleteProduct(product)">
                        Delete
                    </button>

                </td>
            </tr>
        </tbody>
    </table>
    <div class="pagination">
        <button @click="prevPage()" :disabled="!pagination.prev_page_url">&laquo; Previous</button>
        <button @click="nextPage()" :disabled="!pagination.next_page_url">Next &raquo;</button>
    </div>
    <EditProductModalVue :product="productData" v-show="editMode" @productSaved="getProducts" />
</template>

<script>
import axios from 'axios';

import EditProductModalVue from './EditProductModal.vue';

export default {

    data() {
        return {
            editMode: false,
            products: {},
            productData: new Form({
                id: '',
                description: '',
                unity: '',
                isQuoted: '',
            }),
            productErrors: {

            },
            pagination: {
                current_page: 1,
                last_page: 1,
                prev_page_url: null,
                next_page_url: null,
                per_page: 1,
            },
            searchTerm: '',
        }
    },
    components: {
        EditProductModalVue
    },
    methods: {

        getProducts(url) {

            axios.get(url || `${import.meta.env.VITE_API_BASE_URL}/api/getProducts`).then((response) => {


                this.products = response.data.data;
                this.pagination = {
                    current_page: response.data.current_page,
                    last_page: response.data.last_page,
                    prev_page_url: response.data.prev_page_url,
                    next_page_url: response.data.next_page_url,
                    per_page: response.data.per_page,
                }

            })
        },
        search() {
            this.getProducts(`${import.meta.env.VITE_API_BASE_URL}/api/searchProducts?term=${this.searchTerm}`);
        },

        editProduct(product) {
            this.editMode = true;
            this.productData.id = product.id;
            this.productData.description = product.description;
            this.productData.unity = product.unity;
            this.productData.isQuoted = product.isQuoted;
            document.getElementById('modal').showModal();
        },
        deleteProduct(product) {
            console.log(product);
            axios.post(`${import.meta.env.VITE_API_BASE_URL}/api/deleteProduct/${product.id}`, {

            })
                .then((response) => {
                    console.log(response.data)
                    this.getProducts()

                })
        },
        confirmDeleteProduct(product) {
            const shouldDelete = window.confirm('Tem certeza de que deseja deletar este produto?');

            if (shouldDelete) {
                this.deleteProduct(product);
            }
        },

        nextPage() {
            if (this.pagination.next_page_url) {
                this.getProducts(this.pagination.next_page_url)
            }
        },
        prevPage() {
            if (this.pagination.prev_page_url) {
                this.getProducts(this.pagination.prev_page_url);
            }
        },

        calculateItemNumber(index) {
            const perPage = this.pagination.per_page || 1;
            return (this.pagination.current_page - 1) * perPage + index + 1;
        }


    },
    mounted() {
        this.getProducts()
    }
}


</script>
