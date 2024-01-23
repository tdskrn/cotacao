<template>
    <DashboardNavbar></DashboardNavbar>
    <h2>Vendors Index</h2>
    <table>
        <thead>
            <tr>
                <th> #</th>
                <th> Name</th>
                <th> email</th>
                <th> Telephone</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="(vendor, index) in vendors" :key="index">
                <td>{{ calculateItemNumber(index) }}</td>
                <td>{{ vendor.name }}</td>
                <td>{{ vendor.email }}</td>
                <td>{{ vendor.telephone }}</td>
                <td>
                    <button @click="editVendor(vendor)">
                        Edit
                    </button>
                    <button @click="confirmDeleteVendor(vendor)">
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
    <EditVendorModal :vendor="vendorData" v-show="editMode" @vendorSaved="getVendors" />
</template>

<script>
import axios from 'axios';
import DashboardNavbar from '../Dashboard/DashboardNavbar.vue';
import EditVendorModal from './EditVendorModal.vue';
export default {
    name: 'VendorIndex',
    components: {
        DashboardNavbar,
        EditVendorModal,
    },
    data() {
        return {
            editMode: false,
            vendors: {},
            token: localStorage.getItem('authToken') || null,
            vendorData: new Form({
                id: '',
                name: '',
                email: '',
                telephone: '',
                isAdmin: '',
            }),
            pagination: {
                current_page: 1,
                last_page: 1,
                prev_page_url: null,
                next_page_url: null,
                per_page: 1,
            }
        }
    },
    methods: {
        getVendors(url) {
            axios.get(url || `${import.meta.env.VITE_API_BASE_URL}/api/getVendors`, {
                headers: {
                    'Authorization': `Bearer ${this.token}`
                }
            }).then((response) => {
                this.vendors = response.data.data;
                this.pagination = {
                    current_page: response.data.current_page,
                    last_page: response.data.last_page,
                    prev_page_url: response.data.prev_page_url,
                    next_page_url: response.data.next_page_url,
                    per_page: response.data.per_page,
                }

            });
        },

        editVendor(vendor) {
            this.editMode = true;
            this.vendorData.id = vendor.id;
            this.vendorData.name = vendor.name;
            this.vendorData.email = vendor.email;
            this.vendorData.telephone = vendor.telephone;
            this.vendorData.isAdmin = vendor.isAdmin;
            document.getElementById('modal').showModal();
        },

        deleteVendor(vendor) {
            console.log(vendor);
            axios.post(`${import.meta.env.VITE_API_BASE_URL}/api/deleteVendor/${vendor.id}`, null, {
                headers: {
                    'Authorization': `Bearer ${this.token}`
                }
            })
                .then((response) => {
                    console.log(response.data)
                    this.getVendors()

                })
        },
        confirmDeleteVendor(vendor) {
            const shouldDelete = window.confirm('Tem certeza de que deseja deletar este Vendedor?');

            if (shouldDelete) {
                this.deleteVendor(vendor);
            }
        },
        nextPage() {
            if (this.pagination.next_page_url) {
                this.getVendors(this.pagination.next_page_url)
            }
        },
        prevPage() {
            if (this.pagination.prev_page_url) {
                this.getVendors(this.pagination.prev_page_url);
            }
        },

        calculateItemNumber(index) {
            const perPage = this.pagination.per_page || 1;
            return (this.pagination.current_page - 1) * perPage + index + 1;
        },
        checkAuthentication() {
            const authToken = localStorage.getItem('authToken');
            console.log('Token', authToken);
            if (!authToken) {
                this.$router.push('/login');
            }
        },
    },
    mounted() {
        this.checkAuthentication();
        this.getVendors();
    }
}
</script>

<style></style>