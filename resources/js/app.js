require('./bootstrap');

require('./twitter');

$(document).ready(function() {
    // Hide Flash Message
    $('div.alert').not('.alert-important').delay(5000).slideUp(350);
});
