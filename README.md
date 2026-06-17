## primeira vez 

docker compose build --no-cache
docker compose up -d
docker compose ps
docker compose exec web composer install
docker compose exec web composer --version


## dia a dia
docker compose up -d
docker compose stop
docker compose down
docker compose exec web bash


## qnd adicionar uma nova classe
docker compose exec web composer dump-autoload


 docker compose up -d --build  
 docker compose exec web composer install  
 docker compose up -d