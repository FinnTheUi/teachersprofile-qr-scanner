import './bootstrap';

// Configure axios CSRF token
let token = document.head.querySelector('meta[name="csrf-token"]');

if (token) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
    console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}

// Add a response interceptor to handle expired tokens
window.axios.interceptors.response.use(
    response => response,
    error => {
        if (error.response && error.response.status === 419) {
            // Redirect to login page on CSRF token expiration
            window.location.reload();
        }
        return Promise.reject(error);
    }
);
