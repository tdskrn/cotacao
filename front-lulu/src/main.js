import { createApp } from 'vue'
import App from './App.vue'
import './style.css'

import Form from 'vform'
import store from './store'
import router from './router'

window.Form = Form

const app = createApp(App).use(router).use(store)

app.mount('#app')
