FROM php:8.2-apache

# Instala extensões
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Ativa o módulo rewrite para rotas limpas
RUN a2enmod rewrite

# Define o diretório público como raiz do Apache
ENV APACHE_DOCUMENT_ROOT=/var/www/html/public

# Atualiza o arquivo de configuração do Apache
RUN sed -ri -e 's!/var/www/html!/var/www/html/public!g' /etc/apache2/sites-available/000-default.conf

# Copia tudo para dentro do container
COPY . /var/www/html

# Ajusta permissões
RUN chown -R www-data:www-data /var/www/html
