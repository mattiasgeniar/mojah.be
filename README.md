# Getting Started

## View online

A demo version is available here: [bitcoin.mojah.be](http://bitcoin.mojah.be/).

## General

You'll need a webserver with support for PHP that adheres to the [Laravel 5.8 minimum requirements](https://laravel.com/docs/5.8/installation).

Installation itself is straight forward.

```
$ git clone git@github.com:mattiasgeniar/CommunityBitcoin.git
$ cd CommunityBitcoin
$ composer install
$ cp .env.example .env
$ php artisan key:generate
$ php artisan migrate --seed
```

In the `.env` file, you'll need to change the MySQL credentials to match your database.

## Mailing List Archives

To import a mailing list to the local database, run this command.

```
$ php artisan mailing-list:import bitcoin-dev resources/test-data/bitcoin-core-mailinglist-2016-april.txt
```

This will read the contents of that `mbox` file and import it into the `bitcoin-dev` tables.
