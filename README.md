# Micro Service POC

Simple micro service proof of concept.

## Usage

Create the JWT keys `cd gateway && ./generate-keys.sh`.
This will generate `gateway/private.pem` and `gateway/public.pem`.

Build the docker images `docker-compose build`.

Start all containers `docker-compose up`.

Create the login-service database `./login-service-create-user.sh`.
Add a user `./login-service-setup.sh`.

Now you can navigate to `http://localhost:8000` and enter the user cretentials.

## Concept

![Sequence diagram](https://user-images.githubusercontent.com/339631/53551017-780f8080-3b38-11e9-9f22-66c665f132c9.png)
