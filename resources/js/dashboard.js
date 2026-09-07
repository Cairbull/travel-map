import { createApp } from 'vue'
import App from './components/App.vue'
import router from './router'
// import Dashboard from './components/Dashboard.vue'
import './assets/dashboard.css'
import './assets/bootstrap.min.css'
import './assets/markers.css'
import './assets/map.css'
import './assets/toolbar.css'
const app = createApp(App);

app.use(router);
app.mount('#dashboard-app')