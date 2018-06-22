# NAME

Simple Adddress App

# DESCRIPTION

This is the REST side of a simple address app, utilizing Google Maps. The REST side is coded with Mojolicious.

# SYNOPSIS

Run REST server

    php artisan serve


# GETTING A GOOGLE MAP API KEY

Get a [Google Map API key](https://developers.google.com/maps/documentation/javascript/get-api-key).

If you are running on a public web server, you need a google map API key with Key Restriction set to "IP Addresses"

If you are running on a localhost, you can generate your API key, and set Key restriction to "None".

# INSTALL

Open terminal

    composer install

    cp .env.example .env
    vi .env
      DB_DATABASE=simple_address_laravel
      DB_DATABASE=simple_address_laravel
      DB_PASSWORD=secret

      GMAP_API_SITE_KEY=[google_map_api_key]

    php artisan key:generate

Prepare the database

    mysql -h localhost -u root -p
    CREATE USER 'simple_address_laravel'@'localhost' IDENTIFIED BY '';
    CREATE DATABASE simple_address_laravel;
    use simple_address_laravel;
    GRANT ALL PRIVILEGES ON simple_address_laravel TO 'simple_address_laravel'@'localhost';
    GRANT ALL PRIVILEGES ON simple_address_laravel.* TO 'simple_address_laravel'@'localhost';
    exit;

    php artisan migrate

Run the test scripts,

    composer test


Now run the server

    php artisan serve

Connect to the REST server with the [client](https://github.com/emceelam/Simple-Address-Client)

# AUTHOR

Lambert Lum

![email address](http://sjsutech.com/small_email.png)

# COPYRIGHT AND LICENSE

This software is copyright (c) 2018 by Lambert Lum

This is free software; you can redistribute it and/or modify it under the same terms as the Perl 5 programming language system itself.
