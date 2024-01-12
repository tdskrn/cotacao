

<template>
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
                <td>{{ index + 1 }}</td>
                <td>{{ product.description }}</td>
                <td>{{ product.unity }}</td>
                <td> {{ product.isQuoted === 1 ? 'Sim' : 'Não' }}</td>
                <td>
                    <button @click="editProduct(product)">
                        Edit
                    </button>
                    <button @click="deleteProduct(product)">
                        Delete
                    </button>
                </td>
            </tr>

        </tbody>
    </table>
    <EditProductModal v-if="editMode" @close-modal="editMode = false" @product-updated="handleProductUpdated">
    </EditProductModal>
</template>

<script>
import axios from 'axios';
import EditProductModal from './EditProductModal.vue';

export default {
    components: {
        EditProductModal
    },
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

            }
        }
    },
    methods: {
        getProducts() {

            axios.get(`${import.meta.env.VITE_API_BASE_URL}/api/getProducts`).then((response) => {

                this.products = response.data;

            })
        },

        editProduct(product) {
            this.productData.id = product.id;
            this.productData.description = product.description;
            this.productData.unity = product.unity;
            this.productData.isQuoted = product.isQuoted;
            this.editMode = true;


        },



    },
    mounted() {
        this.getProducts()
    }
}


</script>