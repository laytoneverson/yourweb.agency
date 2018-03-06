
var $ = require('jquery');

require('bootstrap-sass');

global.$ = global.jQuery = jQuery = $;

var Layout = require('./layout.js');

$(function(){
    Layout.init();
    Layout.initTwitter();
    Layout.initFixHeaderWithPreHeader(); /* Switch On Header Fixing (only if you have pre-header) */
    Layout.initNavScrolling();
});

