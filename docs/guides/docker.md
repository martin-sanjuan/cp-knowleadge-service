# About this

___Note: All the documentation it's based on Linux___

# Running docker with nginx

alias: `docker rm -f nginx-proxy && docker/nginx-proxy.sh && docker-compose up -d`

# DCLI

alias: `docker-compose -f docker-compose.cli.yml run --rm`


# Composer
## Composer Environment

### COMPOSER_HOME & COMPOSER_CACHE_DIR

#### How to know it

- Run `echo $COMPOSER_HOME` or `echo $COMPOSER_CACHE_DIR`. If it's not null you don't need to register it.
- Run `env | grep COMPOSER_HOME` or `env | grep COMPOSER_CACHE_DIR`
- Run `composer config -lg` and look for the variable `[home]` or `[cache-dir]`

#### How to

  On your ~/.bashrc file add the following line:

  `export COMPOSER_HOME="$HOME/.config/composer"`


# Mysql Problems

If you have some troubles to connect with your database with the right authentication data try to restart the mysql server like following 

```
docker-compose run mysql bash

/etc/init.d/mysql start
```

Without leave the container , check your connection from inside:  

```
mysql -u user -p 
```
