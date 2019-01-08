WandiToolsBundle

[![Build Status](https://travis-ci.org/WandiParis/ToolsBundle.svg?branch=master)](https://travis-ci.org/WandiParis/ToolsBundle)

```
cp phpunit.xml.dist phpunit.xml
docker-compose build
docker-compose up -d
docker-compose run --rm php composer install
docker-compose run --rm php phpunit
docker-compose run --rm php php-cs-fixer fix . --rules=@Symfony
```