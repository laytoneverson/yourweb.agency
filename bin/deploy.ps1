
function BuildProduction([parameter()]$imageName) {

    if (!$imageName) {
        docker-compose.exe -f docker-compose.yml -f docker-compose.prod.yml build php
        docker-compose.exe -f docker-compose.yml -f docker-compose.prod.yml build web
    } else {
        docker-compose.exe -f docker-compose.yml -f docker-compose.prod.yml build --build-args VERSION=latest $imageName
    }
}

function tagProduction([parameter()]$version, [parameter()]$imageName) {
    if (!$imageName) {
        docker tag yourweb-prod-php:latest  registry-intl.us-west-1.aliyuncs.com/cryptocurrency-yourweb-online/php:$version
        docker tag yourweb-prod-web:latest  registry-intl.us-west-1.aliyuncs.com/cryptocurrency-yourweb-online/web:$version
    } else {
        docker tag yourweb-prod-${imageName}:latest  registry-intl.us-west-1.aliyuncs.com/cryptocurrency-yourweb-online/${imageName}:$version
    }
}

function pushProduction([parameter()]$version, [parameter()]$imageName) {
    if (!$imageName) {
        docker push registry-intl.us-west-1.aliyuncs.com/cryptocurrency-yourweb-online/web:$version
        docker push registry-intl.us-west-1.aliyuncs.com/cryptocurrency-yourweb-online/php:$version
    } else {
        docker push registry-intl.us-west-1.aliyuncs.com/cryptocurrency-yourweb-online/${imageName}:$version
    }
}

function deploy([parameter()][string]$version, [parameter()][string]$imageName)
{
    $env:VERSION=$version
    Set-Content -Path ".\.version" -Value $version

    yarn encore production
    if (!$imageName) {
        BuildProduction
        tagProduction($version)
        pushProduction($version)
    } else {
        BuildProduction($imageName)
        tagProduction($version, $imageName)
        pushProduction($version, $imageName)
    }

}

function getCurrentVersion() {
    Get-Content -Path ".\.version"
}
