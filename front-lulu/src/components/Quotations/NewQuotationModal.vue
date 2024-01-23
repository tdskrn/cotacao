<template>
    <dialog id="modal">
        <p>Nova Cotação</p>
        <div id="content-modal">

            <div class="row-modal">
                <label for="start_date">Início </label>
                <input v-model="quoteData.start_date" name="start_date" type="date">
            </div>
            <div class="row-modal">
                <label for="end_date">Fim </label>
                <input v-model="quoteData.end_date" name="end_date" type="date">
            </div>
            <div>
                <button @click="saveQuote()" @submit.prevent>Salvar</button>
                <button @click="closeModal()">Cancelar</button>
            </div>


        </div>
    </dialog>
</template>

<script>
import axios from 'axios';
export default {
    name: 'NewQuotationModal',
    data() {
        return {
            token: localStorage.getItem('authToken') || null,
            quoteData: {
                status: '',
                start_date: '',
                end_date: '',
            }

        }
    },
    methods: {


        saveQuote() {
            console.log(this.quoteData);
            axios.post(`${import.meta.env.VITE_API_BASE_URL}/api/storeQuote/`, {
                status: 'Aberta',
                start_date: this.quoteData.start_date,
                end_date: this.quoteData.end_date,

            }, {
                headers: {
                    'Authorization': `Bearer ${this.token}`
                }
            }).then((response) => {
                console.log(response);
                this.closeModal();
            })
        },

        closeModal() {
            const modal = document.getElementById('modal');
            modal.close();
        },
    }
}
</script>

<style></style>