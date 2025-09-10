import axios from 'axios';
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

// Auto-setup CSRF token untuk semua request axios
const token = document.head.querySelector('meta[name="csrf-token"]');
if (token) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
    console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}
