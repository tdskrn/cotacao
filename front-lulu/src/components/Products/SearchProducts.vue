<template>
    <div class="search-bar">
        <input v-model="searchTerm" @input="handleSearchInput" placeholder="Digite para pesquisar" />
        <button @click="search">Pesquisar</button>
    </div>
</template>

<script>
export default {
    name: "SearchProducts",

}
</script>

<style></style>