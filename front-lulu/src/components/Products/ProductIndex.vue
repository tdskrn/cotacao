

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
                    <button @click="confirmDeleteProduct(product)">
                        Delete
                    </button>

                </td>
            </tr>
        </tbody>
    </table>
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

            }
        }
    },
    components: {
        EditProductModalVue
    },
    methods: {

        getProducts() {

            axios.get(`${import.meta.env.VITE_API_BASE_URL}/api/getProducts`).then((response) => {
                console.log(response)

                this.products = response.data;

            })
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


    },
    mounted() {
        this.getProducts()
    }
}


</script>
Route::post('deleteProduct/{id}', [ProductController::class, 'deleteProduct']);
Product::where('id', $id)->delete();
        return response()->json('Success');