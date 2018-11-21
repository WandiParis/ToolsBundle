WandiToolsBundle - 3.0.0

```
cp phpunit.xml.dist phpunit.xml
docker-compose build
docker-compose up -d
docker-compose run --rm php composer install
docker-compose run --rm php phpunit
docker-compose run --rm php php-cs-fixer fix . --rules=@Symfony
```