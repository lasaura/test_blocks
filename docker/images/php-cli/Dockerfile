FROM php:8.1-cli

ENV GNAME=appgroup
ENV UNAME=appuser
ENV UID=1000
ENV GID=1000

    # installing symfony cli
RUN curl -1sLf 'https://dl.cloudsmith.io/public/symfony/stable/setup.deb.sh' | bash \
    && apt-get update && apt-get install libonig-dev libzip-dev  libyaml-dev zip symfony-cli -y \
    # installing symfony xdebug (phpunit need's it)
    && pecl install xdebug-3.1.6 \
    # installing composer
    && curl -sS https://getcomposer.org/installer | php \
    && mv composer.phar /usr/local/bin/composer \
    && chmod +x /usr/local/bin/composer \
    # installing and configuring some symfony required extensions
    && docker-php-ext-install mbstring pdo pdo_mysql \
    # avoid sudo issues between host and container mapped volumes
    && addgroup --gid $GID $GNAME \
    && useradd --password "*" --uid $UID --gid $GID $UNAME \
    && mkdir /home/$UNAME && chown $UNAME:$GNAME /usr/bin/symfony /home/$UNAME


USER $UNAME

# forcing container to be open
CMD  ["sleep","infinity"]

EXPOSE 80