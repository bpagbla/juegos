FROM ubuntu:24.04
# Install and run apache
RUN apt-get update && apt-get upgrade -y && apt-get install -y openssl && apt-get install -y apache2
RUN apt-get update && apt-get install -y php libapache2-mod-php php-mysql php8.3-curl php-zip

RUN openssl req -x509 -nodes -days 365 -newkey rsa:2048 -keyout /etc/ssl/private/apache.key -out /etc/ssl/certs/apache.crt -subj "/C=ES/ST=Madrid/L=Madrid/O=Example Inc./CN=example.com"
RUN a2enmod ssl
RUN a2ensite default-ssl.conf

#RUN rm /var/www/html/index.html
#COPY ./ /var/www/html/

RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
RUN php -r "if (hash_file('sha384', 'composer-setup.php') === 'dac665fdc30fdd8ec78b38b9800061b4150413ff2e3b6f88543c636f7cd84f6db9189d43a81e5503cda447da73c7e5b6') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
RUN php composer-setup.php
RUN php -r "unlink('composer-setup.php');"
RUN mv composer.phar /usr/local/bin/composer

CMD apachectl -D FOREGROUND