
function build($appEnv, $buildFrontEnd) {
    if (!$appEnv) {
        $appEnv = "prod"
    }

    $env:APP_ENV=$appEnv

    if ($appEnv -eq "prod") {
        yarn encore production
    } else {
        yarn encore dev
    }

    docker-compose.exe build builder
    docker tag yourweb-build  yourweb-build:${appEnv}-latest

}
