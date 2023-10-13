import './bootstrap';

import Alpine from 'alpinejs';
import { createApp } from 'vue';
import App from './layouts/App.vue';

createApp(App).mount("#app");
window.Alpine = Alpine;

Alpine.start();
