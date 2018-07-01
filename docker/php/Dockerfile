FROM php:7.1-fpm

RUN apt-get update && apt-get install -y libssl-dev && rm -rf /var/lib/apt/lists/*

RUN pecl install mongodb \
    && docker-php-ext-enable mongodb

RUN \
  curl -L https://download.newrelic.com/php_agent/release/newrelic-php5-8.1.0.209-linux.tar.gz | tar -C /tmp -zx && \
    NR_INSTALL_USE_CP_NOT_LN=1 NR_INSTALL_SILENT=1 /tmp/newrelic-php5-*/newrelic-install install && \
      rm -rf /tmp/newrelic-php5-* /tmp/nrinstall* && \
        sed -i -e 's/"REPLACE_WITH_REAL_KEY"/"c2e55fe0ea402fa10d3b286b0c35189e71e4e041"/' \
     -e 's/newrelic.appname = "PHP Application"/newrelic.appname = "encuesta_backend"/' \
         /usr/local/etc/php/conf.d/newrelic.ini

RUN cp /usr/local/etc/php/conf.d/newrelic.ini /usr/local/etc/php-fpm.d/newrelic.ini

# Permission fix
RUN usermod -u 1000 www-data
