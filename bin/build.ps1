param (
    [string]$appEnv = "prod",
    [switch]$buildFrontEnd = $true
)


function build($appEnv, $buildFrontEnd) {
    if (!$appEnv) {
        $appEnv = "prod"
    }

    $env:APP_ENV=$appEnv
    if ($buildFrontEnd) {
        if ($appEnv -eq "prod") {
            yarn encore production
        } else {
            yarn encore dev
        }
    }

    docker-compose.exe build --build-arg APP_ENV=$appEnv builder
    docker tag yourweb-build yourweb-build:${appEnv}-latest
}

build $appEnv $buildFrontEnd
