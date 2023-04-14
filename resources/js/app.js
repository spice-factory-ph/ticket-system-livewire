import './bootstrap';

import Alpine from 'alpinejs';
window.Alpine = Alpine;

import Swal from 'sweetalert2';
window.Swal = Swal;

import axios from 'axios';
window.axios = axios;

window.$ = require('jquery');

Alpine.start();