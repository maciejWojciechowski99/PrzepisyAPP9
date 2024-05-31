FROM php:8.0-apache

# Instalacja narzędzi do generowania certyfikatów SSL
RUN apt-get update && apt-get install -y \
    openssl \
    && rm -rf /var/lib/apt/lists/*

# Ustawianie środowiska Apache do obsługi SSL
RUN a2enmod ssl
RUN a2ensite default-ssl

# Tworzenie katalogu na certyfikaty SSL
RUN mkdir /etc/apache2/ssl


# Generowanie certyfikatu SSL dla localhost
RUN openssl req -x509 -nodes -days 365 -newkey rsa:2048 \
    -keyout /etc/apache2/ssl/apache.key \
    -out /etc/apache2/ssl/apache.crt \
    -subj "/C=US/ST=State/L=City/O=Organization/CN=localhost"

# Konfiguracja VirtualHost Apache dla SSL
COPY project.conf /etc/apache2/sites-available/default.conf
COPY project.conf /etc/apache2/sites-available/default-ssl.conf
RUN a2ensite default
RUN a2ensite default-ssl

# instalacja modułu przekierowań
RUN a2enmod rewrite

# Kopiowanie pliku php.ini z odpowiednimi ustawieniami SMTP
COPY php.ini /usr/local/etc/php/php.ini

WORKDIR /var/www/html

RUN docker-php-ext-install pdo pdo_mysql

COPY public_html/index.php index.php
COPY public_html/config.php config.php
COPY public_html/Database.php Database.php
COPY public_html/draw.php draw.php
COPY public_html/favorite.php favorite.php
COPY public_html/Logger.php Logger.php
COPY public_html/login.php login.php
COPY public_html/logout.php logout.php
COPY public_html/registration.php registration.php
COPY public_html/sign.php sign.php
COPY public_html/todo.php todo.php
COPY public_html/bootstrap.min.css bootstrap.min.css
COPY public_html/style.css style.css
COPY public_html/todolist.css todolist.css
COPY public_html/bootstrap.min.js bootstrap.min.js
COPY public_html/popper.js popper.js
COPY public_html/script.js script.js
COPY public_html/todolist.js todolist.js 
COPY public_html/body.php body.php
COPY public_html/entries.php entries.php
COPY public_html/footer.php footer.php
COPY public_html/nav.php nav.php
COPY public_html/user.php user.php
COPY public_html/PHPMailer.php PHPMailer.php
COPY public_html/SMTP.php SMTP.php
COPY public_html/Exception.php Exception.php
COPY public_html/resetPassword.php resetPassword.php
COPY public_html/send_reset_email.php send_reset_email.php
COPY public_html/activate.php activate.php 
COPY public_html/404.php 404.php 
COPY public_html/.htaccess .htaccess 

EXPOSE 80
EXPOSE 443
