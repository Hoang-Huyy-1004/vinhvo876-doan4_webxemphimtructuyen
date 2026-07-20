# Stage 1: Biên dịch Frontend Assets (CSS/JS từ Vite)
FROM node:20-alpine AS frontend-builder
WORKDIR /app
COPY package*.json ./
RUN npm install
COPY . .
RUN npm run build

# Stage 2: Môi trường chạy PHP/Laravel ứng dụng
FROM php:8.2-apache

# Cài đặt các thư viện hệ thống và PHP Extensions cần thiết cho Laravel
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libzip-dev \
    unzip \
    zip \
    git \
    curl \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo_mysql gd zip bcmath

# Bật module rewrite của Apache (để chạy Laravel routing mượt mà)
RUN a2enmod rewrite

# Thay đổi cấu hình Apache Document Root sang thư mục public/ của Laravel
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Tải Composer phiên bản mới nhất
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Thiết lập thư mục làm việc chính
WORKDIR /var/www/html

# Copy toàn bộ mã nguồn dự án vào Container
COPY . .

# Copy thư mục build CSS/JS đã được tạo từ Stage 1
COPY --from=frontend-builder /app/public/build ./public/build

# Cài đặt các thư viện PHP cần thiết (loại bỏ dev dependencies và bỏ qua scripts để tránh lỗi kết nối DB lúc build)
RUN composer install --no-dev --optimize-autoloader --no-scripts


# Thiết lập quyền ghi thư mục cho Apache
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache \
    && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Cổng mạng 80 mặc định
EXPOSE 80

# Thực hiện chạy package:discover và khởi động Apache Web Server ở runtime
CMD ["sh", "-c", "php artisan package:discover --ansi && apache2-foreground"]
