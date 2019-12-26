# Blog Challenge

## Description

Develop a blog with authentication and integrated with Twitter.

## Characteristics

* Auth process was generated with the Laravel/UI scaffolding based on Bootstrap.
* Responsive design using Bootstrap.

## Setup

### Env variables

Copy `.env.example` to `.env`.

Update values for these keys:

```
APP_URL=           // add the site url

DB_DATABASE=blog   // add database name
DB_USERNAME=       // add mysql/mariadb username
DB_PASSWORD=       // add mysql/mariadb password
```

Add these keys related to Twitter:

```
TWITTER_CONSUMER_KEY=
TWITTER_CONSUMER_SECRET=
TWITTER_ACCESS_TOKEN=
TWITTER_ACCESS_TOKEN_SECRET=
```

Notes:
* You need a developer Twitter account and generate an app on https://developer.twitter.com/en/apps.

### Install dependencies

Run `composer install` and `npm install`

### Database

Run migrations with `php artisan migrate`

Note:
* db can be seeded with dummy data by adding `--seed`. This will add 30 users and 300 entries assigned randomly.

## Database structure

Apart from the basic tables that Laravel generates for `password_resets` and `failed_jobs`, this project contains 3 tables:

### Table: Users

Field | Type
----- | ----
id | integer
username | string
email | string
password | string
twitter_username | string

### Table: Entries

Field | Type
----- | ----
id | integer
title | string
content | text
user_id | integer

### Table: Hidden Contents

Field | Type
----- | ----
id | integer
user_id | integer
type | enum [twitter
external_id | string
