import './bootstrap';

import Alpine from 'alpinejs';
window.Alpine = Alpine;

import Swal from 'sweetalert2';
window.Swal = Swal;

import axios from 'axios';
window.axios = axios;

window.$ = require('jquery');

Alpine.start();

require('./components/Search')
require('./components/Table')

$(".deleteButton").click((e) => {
    let ticket_id = e.target.id
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            $('form#delete-' + ticket_id).submit();
        }
    })
});