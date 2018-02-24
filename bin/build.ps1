
function BuildProduction() {

    docker-compose.exe -f docker-compose.yml -f docker-compose.prod.yml build php
    docker-compose.exe -f docker-compose.yml -f docker-compose.prod.yml build web
}

function tagProduction($ver) {
    docker tag yourweb-prod-php:latest  registry-intl.us-west-1.aliyuncs.com/cryptocurrency-yourweb-online/php:$ver
    docker tag yourweb-prod-web:latest  registry-intl.us-west-1.aliyuncs.com/cryptocurrency-yourweb-online/web:$ver
}

function pushProduction($ver) {
    docker push registry-intl.us-west-1.aliyuncs.com/cryptocurrency-yourweb-online/web:$ver
    docker push registry-intl.us-west-1.aliyuncs.com/cryptocurrency-yourweb-online/php:$ver
}

function deploy($version)
{
    $env:VERSION=$version
    yarn encore production
    BuildProduction
    tagProduction($version)
    pushProduction($version)
}
