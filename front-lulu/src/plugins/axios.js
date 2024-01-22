import Vue from 'vue'
import axios from 'axios'

axios.default.baseUrl = 'http://127.0.0.1:8000/api/'
axios.defaults.headers.common[
    'Authorization'
] = `bearer ${localStorage.getItem()}`
