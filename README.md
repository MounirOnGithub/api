api
===

A Symfony project created on July 18, 2017, 8:11 pm.

### Install the project

- Create your database with the name you want to give to.
```
$ composer install
```

- Configure your `parameters.yml` file from the `parameters.yml.dist`
- Run your server 
```
$ php bin/console server:start 
```

Use it for generating ssh keys for jwt
```
$ openssl genrsa -out var/jwt/private.pem -aes256 4096
$ openssl rsa -pubout -in var/jwt/private.pem -out var/jwt/public.pem
```
