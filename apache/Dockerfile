FROM httpd:2.4

LABEL maintainer="richard@localhost.com"

# Enable required Apache modules
RUN sed -i \
    -e 's/^#\s*LoadModule proxy_module/LoadModule proxy_module/' \
    -e 's/^#\s*LoadModule proxy_fcgi_module/LoadModule proxy_fcgi_module/' \
    -e 's/^#\s*LoadModule rewrite_module/LoadModule rewrite_module/' \
    -e 's/^#\s*LoadModule setenvif_module/LoadModule setenvif_module/' \
    -e 's/^#\s*LoadModule ssl_module/LoadModule ssl_module/' \
    -e 's/^#\s*LoadModule alias_module/LoadModule alias_module/' \
    -e 's/^#\s*LoadModule negotiation_module/LoadModule negotiation_module/' \
    -e 's/^#\s*LoadModule headers_module/LoadModule headers_module/' \
    /usr/local/apache2/conf/httpd.conf

# Include all vhosts
RUN echo "Include conf/extra/apache.conf" >> /usr/local/apache2/conf/httpd.conf \
 && echo "Include conf/extra/vhost-ssl.conf" >> /usr/local/apache2/conf/httpd.conf
RUN rm -f /usr/local/apache2/conf/extra/httpd-ssl.conf

# Copy vhost configs
COPY ./apache.conf /usr/local/apache2/conf/extra/apache.conf
COPY ./vhost-ssl.conf /usr/local/apache2/conf/extra/vhost-ssl.conf

# SSL certificates
RUN mkdir -p /usr/local/apache2/conf/ssl
COPY ./ssl/server-chain.crt /usr/local/apache2/conf/ssl/server.crt
COPY ./ssl/server.key /usr/local/apache2/conf/ssl/server.key

# Create log directory
RUN mkdir -p /var/log/apache2

RUN rm -f /usr/local/apache2/conf/extra/httpd-dav.conf

WORKDIR /var/www/html
