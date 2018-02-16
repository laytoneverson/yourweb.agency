var Encore = require('@symfony/webpack-encore');

Encore
    .setOutputPath('public/build/')
    .setPublicPath('/build')

    .addEntry('js/app', './assets/js/app.js')
    .addEntry('js/home-page', './assets/js/home-page.js')
    .addEntry('global/app', './assets/css/app.scss')
    .addEntry('global/global-custom', './assets/css/global-custom.css')
    .addEntry('global/metronic', './assets/js/metronic.js')
    .addEntry('global/layout', './assets/js/layout.js')
    .addEntry('global/back-to-top', './assets/js/back-to-top.js')

    .enableSassLoader()
    .autoProvidejQuery()
    .enableSourceMaps(!Encore.isProduction())
    .cleanupOutputBeforeBuild()
    .enableBuildNotifications()
    .enableVersioning(Encore.isProduction())
;

module.exports = Encore.getWebpackConfig();
