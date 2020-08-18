FROM ubuntu:18.04
MAINTAINER Kwanok Noh <cloq@kakao.com>

ENV DEBIAN_FRONTEND=noninteractive

## php nginx
RUN apt-get update
RUN apt-get -y install software-properties-common
RUN add-apt-repository ppa:ondrej/php
RUN apt-get update
RUN apt-get -y install nginx
RUN apt-get install -y php7.4
RUN apt-get -y install php7.4-fpm php7.4-gd php7.4-mysql mysql-client php7.4-curl php7.4-xml php-mbstring php-zip
RUN rm /etc/nginx/sites-available/default
ADD default /etc/nginx/sites-available/default

## composer
RUN apt-get -y install curl unzip && apt-get clean && curl -sS https://getcomposer.org/installer | php && mv composer.phar /usr/bin/composer
RUN composer global require laravel/installer
RUN echo 'export PATH="$PATH:$HOME/.composer/vendor/bin"' >> ~/.bashrc

## nodejs
RUN curl -sL https://deb.nodesource.com/setup_10.x | bash -
RUN apt-get -y install nodejs && apt clean

## timezone KST
WORKDIR /etc/php/7.4/fpm
RUN sed -i "s/;date.timezone =/date.timezone = Asia\/Seoul/g" php.ini

CMD ["/bin/bash", "-c", "/usr/sbin/service php7.4-fpm start && nginx -g 'daemon off;'"]

EXPOSE 80
EXPOSE 8080
EXPOSE 8081
EXPOSE 8082
EXPOSE 443
EXPOSE 6001
