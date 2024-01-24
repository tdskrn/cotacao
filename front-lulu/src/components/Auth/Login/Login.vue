<template>
    <h1>Login Sistema Cotação</h1>
    <div>
        <form action="" method="POST" @submit.prevent="login()">
            <div>
                <label for="email">Email</label>
                <input v-model="email" type="text">
            </div>
            <div>
                <label for="password">Password</label>
                <input v-model="password" type="password">
            </div>
            <div>
                <button>
                    Login
                </button>
            </div>
        </form>
        <router-link to="/register">Não é cadastrado?</router-link>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    name: 'Login',
    data() {
        return {
            email: '',
            password: '',
            device_name: '',
            token: null
        }
    },

    methods: {
        async login() {

            try {

                const response = await axios.post(
                    `${import.meta.env.VITE_API_BASE_URL}/api/login`,
                    {
                        email: this.email,
                        password: this.password,
                        device_name: 'web', // Defina o nome do dispositivo conforme necessário
                    }
                );


                // Extraia o token da resposta e armazene no localStorage
                const token = response.data.token;
                localStorage.setItem('authToken', token);

                const user = response.data.user;
                this.$store.commit('setUser', user);

                // Redirecione para a página de produtos ou outra página 
                const isAdmin = response.data.user.isAdmin;
                localStorage.setItem('isAdmin', isAdmin);

                if (isAdmin === 1) {
                    this.$router.push('/dashboard');
                } else {
                    this.$router.push('/vendors');
                }

            } catch (error) {
                console.error('Erro ao fazer login:', error);

                // Limpe o token local em caso de erro
                localStorage.removeItem('authToken');

                // Adicione lógica adicional para tratar diferentes cenários de erro, se necessário
                if (error.response && error.response.status === 401) {
                    // Tratamento específico para status 401 (não autorizado)
                    alert('Credenciais inválidas. Verifique seu e-mail e senha.');
                } else {
                    // Tratamento para outros erros
                    alert('Erro ao fazer login. Tente novamente mais tarde.');
                }
            }
        },
        async getDeviceId() {
            return new Promise((resolve) => {
                const timestamp = new Date().getTime();
                resolve(`device_${timestamp}`);
            });
        }
    }
}
</script>

<style></style>