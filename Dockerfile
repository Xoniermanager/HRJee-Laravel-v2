FROM php:8.3-fpm

# Arguments defined for docker-composer.yml
ARG user
ARG uid

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip

RUN apt-get update && apt-get upgrade -y  && \
    apt-get install -y nodejs \
    npm

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install php extensions
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Get latest composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Create system user to run composer & artisan commands
RUN useradd -G www-data,root -u $uid -d /home/$user $user
RUN mkdir -p /home/$user/.composer && \
    chown -R $user:$user /home/$user

COPY . /var/www

# Set working directory
WORKDIR /var/www

# Run composer install
COPY composer.json composer.lock ./
RUN composer install --no-scripts --no-autoloader

# RUN mv .env.example .env
RUN php artisan route:clear
RUN php artisan config:clear
RUN php artisan cache:clear
RUN php artisan storage:link
RUN php artisan key:generate
# RUN php artisan migrate
# RUN php artisan db:seed

# RUN php artisan route:cache
RUN php artisan config:cache

USER $user

# To connect database externally ex: sequenl ace, use below credentials:
# Host: 0.0.0.0
# Username: hrjee_v2_user
# Database: hrjee_v2_db
# Port: 3310
# Password: password