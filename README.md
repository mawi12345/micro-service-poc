# Micro Service POC

Simple micro service proof of concept.

## Usage

Create the JWT keys `cd gateway && ./generate-keys.sh`.
This will generate `gateway/private.pem` and `gateway/public.pem`.

Build the docker images `docker-compose build`.

Start all containers `docker-compose up`.

Create the login-service database `./login-service-create-user.sh`.
Add a user `./login-service-setup.sh`.

Now you can navigate to `http://localhost` and enter the user cretentials.

## Concept

```sequence
User->Gateway: Request /demo
Note right of Gateway: /demo requires\nvalid JWT
Gateway-->>User: Redirect /auth\nSet redir cookie /demo
User->Gateway: Request /auth
Note right of Gateway: No JWT for\n/auth required
Gateway->Login:
Login-->>Gateway: Login Form
Gateway-->>User:
User->Gateway: Post cretentials
Gateway->Login:
Note right of Login: Redirect path\nis read from\n redir cookie
Login-->>Gateway: Redirect /demo\nSet JWT cookie
Gateway-->>User:
User->Gateway: Request /demo
Gateway->Demo:
Note right of Gateway: /demo JWT\nis valid
Demo-->>Gateway:
Gateway-->>User:
```
