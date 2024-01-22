<template>
    <dialog id="modal" v-if="product">
        <div id="content-modal">
            <div class="row-modal">
                <label for="description">Descrição </label>
                <input name="description" type="text" v-model="product.description">
            </div>
            <div class="row-modal">
                <label for="unity">Unidade </label>
                <input name="unity" type="text" v-model="product.unity">
            </div>
            <div class="row-modal">
                <label>Em cotação? </label>
                <input type="radio" name="isQuoted" value="1" v-model="product.isQuoted">
                <label for="isQuoted">Sim</label>
                <input type="radio" name="isQuoted" value="0" v-model="product.isQuoted">
                <label for="isQuoted">Não</label>
            </div>
            <div class="row-label">
                <button @click="saveProduct()"> Salvar</button>
                <button @click="closeModal()"> Cancelar</button>
            </div>


        </div>
    </dialog>
</template>



<script>
import axios from 'axios';
export default {
    name: 'EditProductModal',

    data() {
        return {
            token: localStorage.getItem('authToken') || null,
        }
    },
    props: {
        product: Object
    },
    methods: {
        closeModal() {
            const modal = document.getElementById('modal');
            modal.close();
        },

        saveProduct() {
            console.log(this.product);
            axios.post(`${import.meta.env.VITE_API_BASE_URL}/api/updateProduct/${this.product.id}`, {
                description: this.product.description,
                unity: this.product.unity,
                isQuoted: this.product.isQuoted,
            }, {
                headers: {
                    'Authorization': `Bearer ${this.token}`
                }
            }).then((response) => {
                console.log(response.data)
                this.$emit('productSaved');
                this.closeModal();

            })
        }
    }
}
</script>


<style>
.row-modal {
    display: flex;
    padding: 5px;
    margin: 5px;

}

.row-modal label {
    margin-right: 10px;
}
</style>


