#!/usr/bin/env bash

docker-compose run soa-login-php php bin/console cache:clear -e prod
docker-compose run soa-login-php php bin/console doctrine:database:create
docker-compose run soa-login-php php bin/console doctrine:schema:create
