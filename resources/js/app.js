import { createApp, h } from "vue";
import { createInertiaApp, Link } from "@inertiajs/vue3";
import PrimeVue from "primevue/config";
import "primevue/resources/themes/saga-green/theme.css";
import "primevue/resources/primevue.min.css";
import "primeicons/primeicons.css";
import ToastService from "primevue/toastservice";
import MainLayout from "@/Layouts/MainLayout.vue";

createInertiaApp({
    resolve: (name) => {
        let page = require(`./Pages/${name}`);
        page.default.layout = page.default.layout || MainLayout;
        return page;
    },
    setup({ el, App, props, plugin }) {
        createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(PrimeVue)
            .use(ToastService)
            .component("Link", Link)
            .mount(el);
    },
    progress: {
        // The delay after which the progress bar will appear, in milliseconds...
        delay: 250,

        // The color of the progress bar...
        color: "#4CAF50",

        // Whether to include the default NProgress styles...
        includeCSS: true,

        // Whether the NProgress spinner will be shown...
        showSpinner: true,
    },
});
