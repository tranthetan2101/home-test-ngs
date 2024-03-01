#!/bin/bash
cd `dirname $0`
set -a
. ./read-env.sh
cd ../

echo "up!"
docker compose down
docker compose up -d --build

docker exec -it app bash -c "composer install"
docker exec -it app bash -c "cp .env.example .env"
docker exec -it app bash -c "php artisan key:generate"
docker exec -it app bash -c "composer dump-autoload"

docker exec -it app bash -c "npm install"
echo "Done!"
