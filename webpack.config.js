var Encore = require('@symfony/webpack-encore');

Encore
    .setOutputPath('public/build/')
    .setPublicPath('/build')
    .cleanupOutputBeforeBuild()

    .enableSassLoader()
    .autoProvidejQuery()
    .addEntry('js/app', './assets/js/app.js')
    .addEntry('js/home-page', './assets/js/home-page.js')
    .addEntry('js/owl-carousel', './node_modules/owl.carousel/src/js/owl.carousel.js')
    .addEntry('global/app', './assets/css/app.scss')
    .addEntry('global/style', './assets/css/style.css')
    .addEntry('global/global-custom', './assets/css/global-custom.css')
    .addEntry('global/back-to-top', './assets/js/back-to-top.js')

    .enableSourceMaps(!Encore.isProduction())
    .enableBuildNotifications()
    //.enableVersioning(false)
;

module.exports = Encore.getWebpackConfig();
