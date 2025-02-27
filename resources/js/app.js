import "./bootstrap";
import { createApp, h } from "vue";
import { createInertiaApp } from "@inertiajs/vue3";
import "../css/app.css"; // Import Tailwind CSS

// Vuetify
import "@mdi/font/css/materialdesignicons.css";
import "vuetify/styles";
import { createVuetify } from "vuetify";
import * as components from "vuetify/components";
import * as directives from "vuetify/directives";

// Inertia modal
import { renderApp } from "@inertiaui/modal-vue";
import { ModalLink } from "@inertiaui/modal-vue";
import { Modal } from "@inertiaui/modal-vue";
import { putConfig } from "@inertiaui/modal-vue";

// Ziggy
import { ZiggyVue } from "ziggy-js";

// Import Components
import DataTableServer from "./components/DataTableServer.vue";

// Bootstrap
import "bootstrap/dist/css/bootstrap.min.css"; // Bootstrap CSS
import "bootstrap/dist/js/bootstrap.bundle.min.js"; // Bootstrap JS
import AdminLayout from "./Layouts/AdminLayout.vue";
import Mainlayout from "./Layouts/Mainlayout.vue";

const vuetify = createVuetify({
    components,
    directives,
});

putConfig({
    type: "modal",
    navigate: false,
    modal: {
        closeButton: true,
        closeExplicitly: false,
        maxWidth: "2xl",
        paddingClasses: "p-4 sm:p-6",
        panelClasses: "bg-white rounded",
        position: "center",
    },
    slideover: {
        closeButton: true,
        closeExplicitly: false,
        maxWidth: "md",
        paddingClasses: "p-4 sm:p-6",
        panelClasses: "bg-white min-h-screen",
        position: "right",
    },
});

createInertiaApp({
    title: (title) => `${title} - SR News`,
    resolve: async (name) => {
        const pages = import.meta.glob("./Pages/**/*.vue", { eager: true });
        const page = pages[`./Pages/${name}.vue`];
        if (!page) {
            throw new Error(`Page not found: ${name}`);
        }
        page.default.layout = name.startsWith("Admin/")
            ? AdminLayout
            : Mainlayout;
        return page;
    },
    setup({ el, App, props, plugin }) {
        const app = createApp({ render: renderApp(App, props) })
            .use(plugin)
            .use(vuetify)
            .use(ZiggyVue);

        app.component("DataTableServer", DataTableServer);
        app.component("ModalLink", ModalLink);
        app.component("Modal", Modal);

        app.mount(el);
    },
});
