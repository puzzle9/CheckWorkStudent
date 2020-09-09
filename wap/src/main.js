import { createApp } from 'vue'
import App from './App.vue'

const app = createApp(App)

// vant
import Vant from 'vant'
import '/@modules/vant/lib/index.css'
app.use(Vant)

app.mount('#app')
