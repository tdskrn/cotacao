<template>
    <div>
        <h2>Registre-se</h2>
        <form action="">

            <div>
                <label for="name">Name</label>
                <input v-model="name" type="text">
            </div>
            <div>
                <label for="email">Email</label>
                <input v-model="email" type="text">
            </div>
            <div>
                <label for="telephone">Telephone</label>
                <input v-model="telephone" type="text">
            </div>
            <div>
                <label for="password">Password</label>
                <input v-model="password" type="text">
            </div>
            <div>
                <button @submit.prevent @click="register()">
                    Register
                </button>
            </div>
        </form>
    </div>
</template>

<script>
import axios from 'axios';
export default {
    name: 'Register',

    data() {
        return {
            name: '',
            email: '',
            password: '',
            telephone: '',
            device_name: '',
            token: null
        }
    },
    methods: {
        async register() {
            const userAgent = navigator.userAgent;

            try {
                const response = await axios.post(`${import.meta.env.VITE_API_BASE_URL}/api/register`, {
                    name: this.name,
                    email: this.email,
                    telephone: this.telephone,
                    password: this.password,
                    device_name: userAgent
                });

                if (response.data.token !== null) {
                    this.token = response.data.token;

                    // Após o registro bem-sucedido, chame o método de login
                    await this.login();

                    // O usuário foi autenticado, redirecione para a página de produtos
                    this.$router.push('/products');
                }
            } catch (error) {
                // Lógica de tratamento de erro
                console.error('Erro ao registrar:', error);
            }
        },

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

                // Redirecione para a página de produtos ou outra página desejada
                this.$router.push('/products');
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
    }
}
</script>

<style></style>