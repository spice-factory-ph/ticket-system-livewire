import './bootstrap';

import Swal from 'sweetalert2';
window.Swal = Swal;

import axios from 'axios';
window.axios = axios;

window.$ = require('jquery');

$(() => {
    if ($('#react-table').length) {
        require('./Components/Table')
    }
});
