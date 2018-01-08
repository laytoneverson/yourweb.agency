var Encore = require('@symfony/webpack-encore');

Encore
    .setOutputPath('public/build/')
    .setPublicPath('/build')

    .addEntry('js/app', './assets/js/app.js')
    .addEntry('js/digital-cash/home-page', './assets/js/digital-cash/home-page.js')
    .addEntry('theme/metronic', './assets/js/theme/metronic.js')

    .createSharedEntry('global/app-global', [
        './assets/plugins/jquery.min.js',
        './assets/plugins/jquery-migrate.min.js',
        './assets/plugins/bootstrap/js/bootstrap.min.js',
        './assets/corporate/scripts/back-to-top.js',
        './assets/plugins/bootstrap/css/bootstrap.min.css',
        './assets/plugins/font-awesome/css/font-awesome.min.css'
    ])

    .enableSassLoader()
    // .autoProvidejQuery()
    // .enableSourceMaps(!Encore.isProduction())
    .cleanupOutputBeforeBuild()
    .enableBuildNotifications()
    // .enableVersioning(Encore.isProduction())
;

module.exports = Encore.getWebpackConfig();
