<template>
    <dialog id="modal" v-if="vendor">
        <div id="content-modal">
            <div class="row-modal">
                <label for="name">Name </label>
                <input name="name" type="text" v-model="vendor.name">
            </div>
            <div class="row-modal">
                <label for="email">Email </label>
                <input name="email" type="text" v-model="vendor.email">
            </div>
            <div class="row-modal">
                <label for="telephone">Telephone </label>
                <input name="telephone" type="text" v-model="vendor.telephone">
            </div>

            <div class="row-label">
                <button @click="saveVendor()"> Salvar</button>
                <button @click="closeModal()"> Cancelar</button>
            </div>
            <div class="row-modal">
                <label>É administrador? </label>
                <input type="radio" value="1" v-model="vendor.isAdmin">
                <label for="isQuoted">Sim</label>
                <input type="radio" value="0" v-model="vendor.isAdmin">
                <label for="isQuoted">Não</label>
            </div>

        </div>
    </dialog>
</template>



<script>
import axios from 'axios';
export default {
    name: 'EditVendorModal',

    data() {
        return {
            token: localStorage.getItem('authToken') || null,
        }
    },
    props: {
        vendor: Object
    },
    methods: {
        closeModal() {
            const modal = document.getElementById('modal');
            modal.close();
        },

        saveVendor() {
            console.log(this.vendor);
            axios.post(`${import.meta.env.VITE_API_BASE_URL}/api/updateVendor/${this.vendor.id}`, {
                name: this.vendor.name,
                email: this.vendor.email,
                telephone: this.vendor.telephone,
                isAdmin: this.vendor.isAdmin,
            }, {
                headers: {
                    'Authorization': `Bearer ${this.token}`
                }
            }).then((response) => {
                console.log(response.data)
                this.$emit('vendorSaved');
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


