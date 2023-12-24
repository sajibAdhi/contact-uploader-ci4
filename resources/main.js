import {createApp} from 'vue';
import router from "@/router/index";

import App from './App.vue'

    // tailwindcss
import './assets/css/tailwind.css'

const app = createApp(App)
app.use(router)
app.mount('#app') 
