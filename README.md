


<p align="center">
  <a href="https://hitometer.databytedigital.com/">
    <img src="https://databytedigital.com/image/logo.png" alt="Screenshot" height="80"/>
  </a>
</p>

<h1 align="center">Hit-O-Meter</h1>

<p align="center">Tools for Counting Profile/Page/Visitor View Count.</p>


 [![Better Stack Badge](https://uptime.betterstack.com/status-badges/v3/monitor/z42l.svg)](https://uptime.betterstack.com/?utm_source=status_badge) 
 [![Push to the docker branch and image build test](https://github.com/madhuryadutta/Hit-O-Meter/actions/workflows/Docker.yml/badge.svg)](https://github.com/madhuryadutta/Hit-O-Meter/actions/workflows/Docker.yml)
[![Laravel Testing](https://github.com/madhuryadutta/Hit-O-Meter/actions/workflows/Testing.yml/badge.svg)](https://github.com/madhuryadutta/Hit-O-Meter/actions/workflows/Testing.yml)

##  Quick start

To get started using Hit-O-Meter, visit [our website](https://hitometer.databytedigital.com) today!

##  Visitors 
![Hit-O-Meter](https://hitometer.databytedigital.com/track/202401261704742917)

 <!-- php artisan make migration create_page_view_count_link_creation_table
 php artisan make:migration create_page_view_count_log_table
 https://laravel.com/docs/10.x/urls -->

##  Installation

**Method 1: Using Heroku Build pack (Can be used in Herkou and Koyeb)**

the default buildpack is "heroku-php-nginx" .You can find the following code in the Procfile

```
web: vendor/bin/heroku-php-nginx -C nginx_app.conf /public
```

You can change that to apache by replacing the Procfile with the following content

```
web: vendor/bin/heroku-php-apache2 public/
```

we need to make a change in the "app/Http/Middleware/TrustProxies.php"file by adding wildcard(*) to allow unsecured proxy connection

```
protected $proxies = '*';
```
