import axios from 'axios';

// Set config defaults when creating the instance
const instance = axios.create({
    baseURL: 'http://0.0.0.0/api',
    timeout: 10000,
});
const accessToken = localStorage.getItem('api_token');
if (accessToken){
    instance.defaults.headers.common['Authorization'] = `Bearer ${accessToken}`;
}
instance.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
const token = document.head.querySelector('meta[name="csrf-token"]');
if (token) {
    instance.defaults.headers.common['X-CSRF-TOKEN'] = token.content
} else {
    console.error('CSRF token not');
}

export default instance
