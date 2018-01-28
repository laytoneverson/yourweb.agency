var Encore = require('@symfony/webpack-encore');

Encore
    .setOutputPath('public/build/')
    .setPublicPath('/build')

    .addEntry('js/app', './assets/js/app.js')
    .addEntry('js/cryptocurrency/home-page', './assets/js/cryptocurrency/home-page.js')
    .addEntry('theme/metronic', './assets/js/cryptocurrency/theme/metronic.js')

    .createSharedEntry('global/app-global', [
        './assets/Metronic/plugins/jquery.min.js',
        './assets/Metronic/plugins/jquery-migrate.min.js',
        './assets/Metronic/plugins/bootstrap/js/bootstrap.min.js',
        './assets/Metronic/corporate/scripts/back-to-top.js',
        './assets/Metronic/plugins/bootstrap/css/bootstrap.min.css',
        './assets/Metronic/plugins/font-awesome/css/font-awesome.min.css'
    ])

    .enableSassLoader()
    // .autoProvidejQuery()
    // .enableSourceMaps(!Encore.isProduction())
    .cleanupOutputBeforeBuild()
    .enableBuildNotifications()
    // .enableVersioning(Encore.isProduction())
;

module.exports = Encore.getWebpackConfig();
