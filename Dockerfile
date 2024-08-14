# Utiliser une image de base PHP 8.3 avec Apache
FROM php:8.3-apache

# Installer les dépendances nécessaires
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libicu-dev \
    libonig-dev \
    libzip-dev \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo pdo_mysql zip intl gd

# Installer Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copier les fichiers de l'application
COPY . /var/www/html

# Installer les dépendances PHP avec Composer
RUN composer install --no-scripts --no-interaction --optimize-autoloader

# Configurer les permissions
RUN chown -R www-data:www-data /var/www/html/var /var/www/html/vendor /var/www/html/public

# Activer le module Apache rewrite
RUN a2enmod rewrite

# Exposer le port 80
EXPOSE 80

# Définir le point d'entrée
CMD ["apache2-foreground"]