import axios from "axios";

export const api = axios.create({
    baseURL: "/",
    withCredentials: true,
});

// Добавляем CSRF токен из cookie в заголовки
api.interceptors.request.use((config) => {
    const token = document
        .querySelector('meta[name="csrf-token"]')
        ?.getAttribute("content");
    if (token) {
        config.headers["X-CSRF-TOKEN"] = token;
    }

    // Также добавляем XSRF токен из cookie
    const xsrfToken = getCookie("XSRF-TOKEN");
    if (xsrfToken) {
        config.headers["X-XSRF-TOKEN"] = decodeURIComponent(xsrfToken);
    }

    return config;
});

function getCookie(name) {
    const value = `; ${document.cookie}`;
    const parts = value.split(`; ${name}=`);
    if (parts.length === 2) return parts.pop().split(";").shift();
    return null;
}
