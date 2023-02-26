# The Simple Task Tracker With Implementation of Clean Architecture

### ATTENTION!!! WIP, Any suggestions are welcome :-)

## I. Build project
### 1) Create .env.local
``` cp .env .env.local```
### 2) Create docker-compose.override.yml
```cp docker-compose.override.yml.dist docker-compose.override.yml```
### 3) Configure DB credentials, URLs and ports
Set any credentials and ports in docker-compose.override.yml. Don't forget set the same data in .env.local
### 4) Build the project
Run the ```make up``` command

## II. Structure
The app consists of 3 layers: Domain, Application and Infrastructure.

Domain is the independent layer, Application depends on Domain and Infrastructure depends on both upper layers. 

### III. Plans
 - Add the JWT Auth
 - Add a role model
 - Add a validation for requests
 - Add cs-fixer, phpstan
 - Add tests
 - Add functionality to API 

