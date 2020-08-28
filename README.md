# Aboprecis-symfony
Symfony version of this Node.js project: https://www-apps.univ-lehavre.fr/forge/ti170577/aboprecis
## Setup (alpha):
```sh
$ composer install
$ yarn install
$ php bin/console doctrine:migrations:migrate
$ yarn encore dev
```
## Add a file named googleapi.json to the project root folder with this (using your own api key):
```json
{
    "key": "YOUR GOOGLE API KEY Y'KNOW?"
}
```
## Then start the server:
```sh
$ symfony server:start
```