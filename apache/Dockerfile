FROM httpd:2.4

LABEL maintainer="richard@localhost.com"

# ---------------------------------------------------------
# Enable required Apache modules for PHP-FPM + SSL
# ---------------------------------------------------------
RUN sed -i \
    -e 's/#LoadModule proxy_module/LoadModule proxy_module/' \
    -e 's/#LoadModule proxy_fcgi_module/LoadModule proxy_fcgi_module/' \
    -e 's/#LoadModule rewrite_module/LoadModule rewrite_module/' \
    -e 's/#LoadModule setenvif_module/LoadModule setenvif_module/' \
    -e 's/#LoadModule ssl_module/LoadModule ssl_module/' \
    /usr/local/apache2/conf/httpd.conf

# ---------------------------------------------------------
# Copy HTTP vhost (port 80)
# ---------------------------------------------------------
COPY ./apache.conf /usr/local/apache2/conf/extra/apache.conf
RUN echo "Include conf/extra/apache.conf" >> /usr/local/apache2/conf/httpd.conf

# ---------------------------------------------------------
# Copy HTTPS vhost (port 443)
# ---------------------------------------------------------
COPY ./vhost-ssl.conf /usr/local/apache2/conf/extra/vhost-ssl.conf
RUN echo "Include conf/extra/vhost-ssl.conf" >> /usr/local/apache2/conf/httpd.conf

# ---------------------------------------------------------
# Copy SSL certificates
# ---------------------------------------------------------
RUN mkdir -p /usr/local/apache2/conf/ssl
COPY ./ssl/server.crt /usr/local/apache2/conf/ssl/server.crt
COPY ./ssl/server.key /usr/local/apache2/conf/ssl/server.key

# ---------------------------------------------------------
# Set correct document root
# ---------------------------------------------------------
WORKDIR /var/www/html
