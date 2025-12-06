Enter product service

``` 
    docker exec -it cinch-mailer-1 bash
```

Create and configure .env file

```
    cp .env.example .env
```

Update the following .env variables

``` 
DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=db_mailer
DB_USERNAME=root
DB_PASSWORD=root

DB_PRODUCT_CONNECTION=mysql
DB_PRODUCT_HOST=db
DB_PRODUCT_PORT=3306
DB_PRODUCT_DATABASE=db_product
DB_PRODUCT_USERNAME=root
DB_PRODUCT_PASSWORD=root

DB_CHECKOUT_CONNECTION=mysql
DB_CHECKOUT_HOST=db
DB_CHECKOUT_PORT=3306
DB_CHECKOUT_DATABASE=db_checkout
DB_CHECKOUT_USERNAME=root
DB_CHECKOUT_PASSWORD=root

REDIS_CLIENT=phpredis
REDIS_HOST=redis
REDIS_PASSWORD=null
REDIS_PORT=6379

MAIL_MAILER=smtp
MAIL_HOST=(provide your own config)
MAIL_PORT=(provide your own config)
MAIL_USERNAME=(provide your own config)
MAIL_ENCRYPTION=tls
MAIL_PASSWORD=(provide your own config)
MAIL_FROM_ADDRESS=(provide your own config)
MAIL_FROM_NAME="Cinch Checkout"
```

Proceed with the following scripts in order

``` 
    composer install
    php artisan key:generate
    php artisan migrate
    php artisan test
```


