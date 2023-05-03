import { createApp, h } from 'vue'
import { createInertiaApp, Link } from '@inertiajs/vue3'
import PrimeVue from 'primevue/config';
import "primevue/resources/themes/saga-green/theme.css";
import "primevue/resources/primevue.min.css";

createInertiaApp({
  resolve: name => require(`./Pages/${name}`),
  setup({ el, App, props, plugin }) {
    createApp({ render: () => h(App, props) })
      .use(plugin)
      .use(PrimeVue)
      .component('Link', Link)
      .mount(el)
  },
  progress: {
    // The delay after which the progress bar will appear, in milliseconds...
    delay: 250,

    // The color of the progress bar...
    color: '#4CAF50',

    // Whether to include the default NProgress styles...
    includeCSS: true,

    // Whether the NProgress spinner will be shown...
    showSpinner: true,
  },
})