import { createApp } from 'vue'

// Application Entrypoint
import App from './App.vue'

// Router
import router from './router'

// Vuetify
import 'vuetify/styles'
import '@mdi/font/css/materialdesignicons.css'
import { createVuetify } from 'vuetify'
import * as components from 'vuetify/components'
import * as directives from 'vuetify/directives'

const vuetify = createVuetify({
  components,
  directives,
  icons: {
    defaultSet: 'mdi',
  },
})

// Toastify
import Vue3Toastify, { toast } from 'vue3-toastify'
import 'vue3-toastify/dist/index.css'

const vueToast = {
  transition: toast.TRANSITIONS.ZOOM,
  position: toast.POSITION.TOP_CENTER,
  autoClose: 3000
}

const app = createApp(App)
app.use(router)
app.use(vuetify)
app.use(Vue3Toastify, vueToast)
app.mount('#app')