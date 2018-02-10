echo "Logging In"
docker login --username=layton.everson@gmail.com registry-intl.us-west-1.aliyuncs.com

echo "Pushing Images"
docker push registry-intl.us-west-1.aliyuncs.com/cryptocurrency-yourweb-online/db:latest
docker push registry-intl.us-west-1.aliyuncs.com/cryptocurrency-yourweb-online/web:latest
docker push registry-intl.us-west-1.aliyuncs.com/cryptocurrency-yourweb-online/php:latest
docker push registry-intl.us-west-1.aliyuncs.com/cryptocurrency-yourweb-online/migration-util:latest
