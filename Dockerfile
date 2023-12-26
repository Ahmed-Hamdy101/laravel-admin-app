FROM php:8.2.0

# Install dependencies
USER root

RUN apt-get update \
    && apt-get install -y openssl zip unzip git libonig-dev \
    && docker-php-ext-install pdo_mysql mbstring pdo \
    && apt-get clean && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /app

# Copy the rest of the application files
COPY . .

# Run Composer
RUN php /usr/local/bin/composer install --no-interaction

# CMD should be specified with the full path to php and artisan
CMD php artisan serve --host=0.0.0.0

EXPOSE 8000
