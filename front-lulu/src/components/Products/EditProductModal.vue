<template>
    <div class="modal">
        <div class="modal-content">
            <h2> Edit Product</h2>
            <form @submit.prevent="submitForm">
                <label>Description:</label>
                <input v-model="productData.description" />

                <label>Unity:</label>
                <input v-model="productData.unity" />

                <label>Is Quoted:</label>
                <input v-model="productData.isQuoted" />

                <button type="submit">Save</button>
            </form>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        productData: Object,
    },
    data() {
        return {
            form: new Form({
                id: '',
                description: '',
                unity: '',
                isQuoted: '',
            }),
        }
    },
    methods: {
        submitForm() {
            axios.post(`${import.meta.env.VITE_API_BASE_URL}/api/updateProduct/${this.productData.id}`, this.productData.data())
                .then((response) => { })
        }
    }
}
</script>

<style>
.modal {
    /* Estilos para um modal centralizado, ajuste conforme necessário */
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background-color: white;
    padding: 20px;
    border: 1px solid #ccc;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.modal-content {
    /* Estilos para o conteúdo do modal, ajuste conforme necessário */
    text-align: center;
}
</style>