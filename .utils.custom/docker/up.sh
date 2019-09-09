#!/bin/bash

echo -e "${gray}=================================================${reset}\n"

echo "${purple}▶${reset} Starting ${APP_NAME} docker containers ..."
# todo : customize this command
echo "${purple}→ docker-compose up -d ${arguments} workspace php-fpm nginx mysql redis php-worker laravel-horizon${reset}"
docker-compose up -d ${arguments} workspace php-fpm nginx mysql redis php-worker laravel-horizon
echo -e "${green}✔${reset} ${APP_NAME} docker containers started.\n"
