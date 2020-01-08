/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

require('../css/main.css');

const $ = require('jquery');

// the bootstrap module doesn't export/return anything
require('bootstrap');

$(document).ready(function() {
    $('[data-toggle="popover"]').popover();
});