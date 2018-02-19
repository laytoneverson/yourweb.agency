
function BuildProduction($ver) {
    $env:VERSION=$ver
    docker-compose.exe -f docker-compose.yml -f docker-compose.prod.yml build php
    docker-compose.exe -f docker-compose.yml -f docker-compose.prod.yml build web

    docker tag yourweb-prod-php:$ver  registry-intl.us-west-1.aliyuncs.com/cryptocurrency-yourweb-online/php:$ver
    docker tag yourweb-prod-web:$ver  registry-intl.us-west-1.aliyuncs.com/cryptocurrency-yourweb-online/web:$ver
}

function pushProduction($ver) {
    docker push registry-intl.us-west-1.aliyuncs.com/cryptocurrency-yourweb-online/web:$ver
    docker push registry-intl.us-west-1.aliyuncs.com/cryptocurrency-yourweb-online/php:$ver
}
