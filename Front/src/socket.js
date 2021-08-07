import Echo from 'laravel-echo'
import VueSocketIO from 'vue-3-socket.io'

window.io = VueSocketIO


window.Echo = new Echo({
    broadcaster: "vue-3-socket.io",
    host: 'http://0.0.0.0:6001',
    auth: {
        headers: {
            Authorization: "Bearer " + localStorage.getItem('api_token')
        }
    }
})
