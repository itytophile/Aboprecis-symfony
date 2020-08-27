# Aboprecis-symfony
Symfony version of this Node.js project: https://www-apps.univ-lehavre.fr/forge/ti170577/aboprecis

## Requirements (alpha):

Download the mercure binary file for your architecture from https://github.com/dunglas/mercure/releases (You can even use Docker)

## Setup (alpha):
```sh
$ composer install
$ yarn install
$ php bin/console doctrine:migrations:migrate
$ yarn encore dev
```
## Start the mercure hub:
```sh
$ ./mercure --jwt-key='secret' --addr=':3000' --debug --allow-anonymous --cors-allowed-origins='*' --publish-allowed-origins='http://localhost:3000'
```
## Then start the server:
```sh
$ symfony server:start
```