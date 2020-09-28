FROM php:7.2-apache

COPY /code/app.php /var/www/html/app.php

EXPOSE 80

CMD ["/usr/sbin/apache2ctl", "-D", "FOREGROUND"]