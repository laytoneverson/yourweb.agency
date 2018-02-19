
const $ = require('jquery');

// create global $ and jQuery variables
global.$ = global.jQuery = $;
global.Layout = _Layout;

var _Layout = require('./layout.js');

global.$.ready(function (e) {
    !function (d, s, id) { var js, fjs = d.getElementsByTagName(s)[0], p = /^http:/.test(d.location) ? 'http' : 'https'; if (!d.getElementById(id)) { js = d.createElement(s); js.id = id; js.src = p + "://platform.twitter.com/widgets.js"; fjs.parentNode.insertBefore(js, fjs); } }(document, "script", "twitter-wjs");
});

global.$(document).ready(function() {
    global.Layout.init();
    global.Layout.initTwitter();
    global.Layout.initFixHeaderWithPreHeader(); /* Switch On Header Fixing (only if you have pre-header) */
    global.Layout.initNavScrolling();
});
