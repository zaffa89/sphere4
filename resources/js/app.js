import './bootstrap';
import '../css/app.css';
import 'devextreme/dist/css/dx.light.css';

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3'
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy/dist/vue.m';
import { createPinia } from 'pinia';

import AlertErrors from './Pages/Sphere/Components/AlertErrors.vue';
import AlertDoppiaAnagrafica from './Pages/Sphere/Components/AlertDoppiaAnagrafica.vue';

const appName = window.document.getElementsByTagName('title')[0]?.innerText || 'Laravel';
const pinia = createPinia();

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({ el, App, props, plugin }) {
        return createApp({ render: () => h(App, props) })
            .use(plugin)            
            .use(ZiggyVue, Ziggy)
            .use(pinia)
            .component('AlertErrors' , AlertErrors)
            .component('AlertDoppiaAnagrafica' , AlertDoppiaAnagrafica)
            .mount(el);
    },
});


