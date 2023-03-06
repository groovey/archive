FROM php:7.4-fpm

RUN apt-get update

RUN apt-get install vim -y && \
    apt-get install openssl -y && \
    apt-get install libssl-dev -y && \
    apt-get install wget -y && \
    apt-get install zip -y && \
    apt-get install unzip -y 

RUN cd /tmp && wget https://pecl.php.net/get/swoole-4.7.1.tgz && \
    tar zxvf swoole-4.7.1.tgz && \
    cd swoole-4.7.1  && \
    phpize  && \
    ./configure  --enable-openssl && \
    make && make install

RUN touch /usr/local/etc/php/conf.d/swoole.ini && \
    echo 'extension=swoole.so' > /usr/local/etc/php/conf.d/swoole.ini

# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

EXPOSE 8080
# CMD ["/usr/local/bin/php", "/var/www/html/server.php"]
CMD ["php-fpm"]