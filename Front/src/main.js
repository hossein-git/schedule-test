import { createApp } from 'vue'
import App from './App.vue'
import './index.css'
import './Api/api'
import router from './router'


createApp(App).use(router).mount('#app')
