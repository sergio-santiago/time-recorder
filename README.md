# Time Recorder

Web application to record the effective working time of a team, with per company
data separation and two levels of access.

Full documentation lives in
[README.pdf](https://github.com/sergio-santiago/time-recorder/blob/master/README.pdf).
This file summarises what the code actually does.

## Stack

- PHP 7.1+ and Laravel 5.8
- MySQL, provisioned through `docker-compose`
- Blade templates, with Laravel Mix and Webpack for assets

## What it does

Every route below `hasCompany` requires the user to belong to a company, and the
team management ones also require the admin role.

- **Authentication**: login, registration and password reset, plus a change
  password form for the signed in user
- **Time records**: list your own records, create new ones and remove them
- **Search**: a dedicated form to query recorded time
- **Team management**, admin only: view the company team, invite users by email,
  toggle a member between admin and regular user, and remove members

The data model is three tables: `companies`, `users` and `time_records`.

## Running it locally

```bash
cp .env.example .env
docker-compose up -d
composer install
php artisan key:generate
php artisan migrate
```

## Status

Archived. Kept as a reference of how I was building Laravel applications in 2019.
