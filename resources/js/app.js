import './bootstrap';
import { createApp } from 'vue';
import Template from './layouts/App.vue';
import Router from './router.js';

createApp(Template)
.use(Router)
.mount('#app')