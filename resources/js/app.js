
require('./bootstrap');


// Sweetalert
window.swal= require('sweetalert2')
window.swal = swal.mixin({
    confirmButtonColor: 'var(--primary)',
    cancelButtonColor: 'var(--secondary)',
});
const toast = swal.mixin({
    toast: true,
    position: 'top',
    icon: 'success',
    showConfirmButton: false,
    timer: 5000,
    timerProgressBar: true,
    onOpen: (toast) => {
        toast.addEventListener('mouseenter', swal.stopTimer);
        toast.addEventListener('mouseleave', swal.resumeTimer)
    }
});
window.toast = toast;



// Data tables
require('datatables.net-bs4');
require('datatables.net-buttons-bs4');

// select2
require('select2/dist/js/select2.full.min');

$('.select2').select2();

$('[data-toggle="tooltip"]').tooltip()




