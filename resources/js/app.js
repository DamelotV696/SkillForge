import "../css/app.css";
import "./bootstrap";
import { createI18nInstance } from "./i18n";
import axios from "axios";
window.axios = axios;
axios.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";

import { createInertiaApp } from "@inertiajs/vue3";
import { resolvePageComponent } from "laravel-vite-plugin/inertia-helpers";
import { createApp, h } from "vue";
import { ZiggyVue } from "../../vendor/tightenco/ziggy";

createInertiaApp({
    resolve: (name) =>
        resolvePageComponent(
            `./Pages/${name}.vue`,
            import.meta.glob("./Pages/**/*.vue"),
        ),
    setup({ el, App, props, plugin }) {
        const locale = props.initialPage.props.locale || "en";
        const i18n = createI18nInstance(locale);

        return createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(i18n)
            .use(ZiggyVue)
            .mount(el);
    },
    title: (title) => `${title}`,
    progress: { color: "#4B5563" },
});
