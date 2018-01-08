//JS
require('../../plugins/fancybox/source/jquery.fancybox.pack.js');
require('../../plugins/owl.carousel/owl.carousel.min.js');
require('../../corporate/scripts/layout.js');
require('../../pages/scripts/bs-carousel.js');
//CSS
require('../../pages/css/animate.css');
require('../../plugins/fancybox/source/jquery.fancybox.css');
require('../../plugins/owl.carousel/assets/owl.carousel.css');


jQuery(document).ready(function () {
    Layout.init();    
    Layout.initOWL();
    Layout.initTwitter();
    //Layout.initFixHeaderWithPreHeader(); /* Switch On Header Fixing (only if you have pre-header) */
    //Layout.initNavScrolling(); 
});
