FROM httpd:2.4

LABEL maintainer="richard@example.com"

# Enable required Apache modules for PHP-FPM
RUN sed -i \
    -e 's/#LoadModule proxy_module/LoadModule proxy_module/' \
    -e 's/#LoadModule proxy_fcgi_module/LoadModule proxy_fcgi_module/' \
    -e 's/#LoadModule rewrite_module/LoadModule rewrite_module/' \
    -e 's/#LoadModule setenvif_module/LoadModule setenvif_module/' \
    -e 's/#LoadModule ssl_module/LoadModule ssl_module/' \
    /usr/local/apache2/conf/httpd.conf

# Copy your custom Apache vhost config
COPY ./apache.conf /usr/local/apache2/conf/extra/apache.conf

# Include it in the main Apache config
RUN echo "Include conf/extra/apache.conf" >> /usr/local/apache2/conf/httpd.conf

# Set correct document root
WORKDIR /var/www/html
