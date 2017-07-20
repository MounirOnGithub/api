Api
===

A Symfony project created on July 18, 2017, 8:11 pm.

It's an example of REST API using Symfony 3, with a MySQL database.

## What's inside
- Symfony 3
- MySQL database
- FOSUserBundle to manage my users
- FOSRestBundle to write REST API
- NelmioCorsBundle to allow CORS
- LexitJWTAuthenticationBundle to secure access to the API

## Install the project

- Create your database with the name you want to give to.
- Install the dependencies with composer
```
$ composer install
```
- Configure your `parameters.yml` file from the `parameters.yml.dist` that is well commented for this project
- Launch it in your terminal for generating ssh keys for jwt
```
$ openssl genrsa -out var/jwt/private.pem -aes256 4096
$ openssl rsa -pubout -in var/jwt/private.pem -out var/jwt/public.pem
```
- Run your server 
```
$ php bin/console server:start 
```

## Create a User
To start using the api let's create a user with FOSUserBundle command
```
php bin/console fos:user:create
```
Follow the steps and your user for getting you ready to use the API, and add him a role

```
php bin/console fos:user:promote
```
The role I created are `ROLE_USER` and `ROLE_ADMIN`. If you need custom role add them to `app/config/security.yml`. Details on http://symfony.com/doc/current/security.html

## Endpoints
For endpoints that require a specific role Symfony provide an ACL system : https://symfony.com/doc/current/security/acl.html, in my case `api/admin/` endpoints require `ROLE_ADMIN`
### Login
Logging in a user
#### Request
- [POST] /login_check
Body
```json
{
    "mail": "mkhanouri555@gmail.com", 
    "password": "secretpassword"
}
```
#### Response
```json
{
    "token": "eyJhbGciOiJSUzI1NiJ9.eyJyb2xlcyI6WyJST0xFX1VTRVIiXSwidXNlcm5hbWUiOiJzaW1wbGV1c2VyIiwiaWF0IjoxNTAwNTUxMzI4LCJleHAiOjE1MDA1NTQ5Mjh9.dmdCzfYvTBtW87qzBri2XpqRSGx1Hs7NTZ7Ou0YYN0Kd5Bcl3K6kJFD6MN1F1eSD6aMLoAYhOuQRttAEz16FcM4xu3-U5jmB8tOhRFmR6occm89HXQcmmhV3zytu2CfCosIAaB4D_8_PUIh83b1svzOyoynAQQCwNncG9Vh4MaW6i6ib_fkQ8tYL2qK9kUzG8gF37NvUDXkVzneHmhc8L_GCr86d0nKERpUShSL67cRFwGVxI7WlJ510OJKeuJx8l-ezItdV4OYX7FDK0BJz2HKYjxRzBc4LKGRotbumq-bUTeK0Aaligr4XiNxNtAoC3_SyuBB-8Pir_oPfV5O_cf0lqwmT_N-ThRFa4lAd1zUVDT18fWqBh5rdFaBzmE-uY_Idj3dBzZ0YnJCOGcgQlYqHgNoP07DJqxI5NGWnauz_p5r25p1GLdsb_6PAuFbA8cauvbG58OLXEH3VQ6kXY2x8KyUV_lNkwhB_IumJ6Sil0FRitInBJFitsedWdjW3r-SmUlP-yPJst-7HjtQoKYG3lKzo-5Y0VQ400U-rAbQefAtyTdsHek47hV-AwXjU9-9CWVNXqRh8luwvJQ840lp73QggUhXFF74Dyw-U-mDw3MfwIKYdj8_POxV1vaQvFhGTf86NvtjbhccvnO_Sf43Ar4YQWppEz5JwKxcwm0c"
}
```
### Get Articles
Return all articles
#### Request
- [GET] /api/articles
Header: 
`Authorization Bearer {token}`
#### Response
Body
```json
[
    {
        "id": 1,
        "title": "Title of an article",
        "content": "Article content, lorem",
        "createdAt": "2017-07-18T08:56:33Z",
        "updatedAt": "2017-07-18T08:56:33Z",
    },
    ...
]
```

### Get Articles
Return one article
#### Request
- [GET] /api/article/{id}
Header: 
`Authorization Bearer {token}`
#### Response
Body
```json
{
    "id": 1,
    "title": "Title of an article",
    "content": "Article content, lorem",
    "createdAt": "2017-07-18T08:56:33Z",
    "updatedAt": "2017-07-18T08:56:33Z",
}
```
