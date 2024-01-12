import { createApp } from 'vue'
import App from './App.vue'
import './style.css'

import Form from 'vform'

window.Form = Form

const app = createApp(App)

app.mount('#app')
